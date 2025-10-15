<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Zstd\Zstd;
use Illuminate\Support\Facades\Log;

class UpdateHotelData extends Command
{
    protected $signature = 'update:hotels';
    protected $description = 'Fetch and update hotels from incremental ETG API dump daily';

    private $apiKey = "9681:e6e621e4-3c28-465b-9e08-d77c1c7c527c";
    private $apiUrl = "https://api.worldota.net/api/b2b/v3/hotel/info/incremental_dump/";

   public function handle()
{
    Log::info('[🔄] Starting daily hotel update...');

    $success = false; // Track if the update was successful
    $message = "";

    // 1️⃣ Get Incremental Dump URL
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
        'Authorization' => "Basic " . base64_encode($this->apiKey),
    ])->post($this->apiUrl, ['language' => 'en']);

    if (!$response->successful() || isset($response['error'])) {
        $message = "[❌] Failed to fetch hotel dump URL.";
        Log::error($message);
        $this->sendEmailNotification($message, false);
        return;
    }

    $dumpUrl = $response['data']['url'] ?? null;
    if (!$dumpUrl) {
        $message = "[❌] Hotel dump URL is missing in response.";
        Log::error($message);
        $this->sendEmailNotification($message, false);
        return;
    }

    Log::info("[🌍] Downloading hotel dump from: $dumpUrl");

    // 2️⃣ Download & Extract Dump File
    $dumpPath = storage_path('app/hotel_dump.zst');
    $jsonPath = storage_path('app/hotel_dump.json');

    if (!Http::timeout(600)->sink($dumpPath)->get($dumpUrl)->successful()) {
        $message = "[❌] Failed to download hotel dump.";
        Log::error($message);
        $this->sendEmailNotification($message, false);
        return;
    }

    Log::info("[✅] Hotel dump downloaded successfully.");

    // 3️⃣ Decompress .zst File to JSON
    if (!self::decompressZstFile($dumpPath, $jsonPath)) {
        $message = "[❌] Failed to decompress .zst file.";
        Log::error($message);
        $this->sendEmailNotification($message, false);
        return;
    }

    Log::info("[✅] Decompression complete. Processing JSON...");

    // 4️⃣ Process and Insert Data into DB
    self::processAndInsertData($jsonPath);

    $success = true;
    $message = "[✅] Hotel database updated successfully.";
    Log::info($message);

    // 5️⃣ Delete Old Files After Update
    self::deleteOldFiles($dumpPath, $jsonPath);

    // 6️⃣ Send Email Notification
    $this->sendEmailNotification($message, $success);
}

/**
 * Delete old dump files to save space.
 */
private static function deleteOldFiles($dumpPath, $jsonPath)
{
    try {
        if (File::exists($dumpPath)) {
            File::delete($dumpPath);
            Log::info("[🗑️] Deleted dump file: $dumpPath");
        }

        if (File::exists($jsonPath)) {
            File::delete($jsonPath);
            Log::info("[🗑️] Deleted JSON file: $jsonPath");
        }
    } catch (\Exception $e) {
        Log::error("[❌] Error deleting files: " . $e->getMessage());
    }
}


    private static function decompressZstFile($inputFile, $outputFile)
    {
        try {
            $zstd = new Zstd();
            $zstd->uncompressFile($inputFile, $outputFile);
            return true;
        } catch (\Exception $e) {
            Log::error("[❌] Error decompressing .zst file: " . $e->getMessage());
            return false;
        }
    }

    private static function processAndInsertData($jsonPath)
    {
        $batchSize = 200;
        $batch = [];
        $totalLines = count(file($jsonPath));

        $file = fopen($jsonPath, "r");
        while (($line = fgets($file)) !== false) {
            $hotel = json_decode($line, true);
            if (!$hotel) continue; // Skip invalid JSON lines

            $values = [
                'id' => $hotel['id'] ?? null,
                'name' => $hotel['data']['name'] ?? null,
                'address' => $hotel['data']['address'] ?? null,
                'amenities' => json_encode($hotel['data']['amenity_groups'] ?? []),
                'policies' => json_encode($hotel['data']['metapolicy_struct'] ?? []),
                'region' => $hotel['data']['region']['name'] ?? null,
                'country_code' => $hotel['data']['region']['country_code'] ?? null,
            ];

            $batch[] = $values;

            if (count($batch) >= $batchSize) {
                self::insertBatch($batch);
                $batch = []; // Reset batch
            }
        }
        fclose($file);

        // Insert any remaining records
        if (!empty($batch)) {
            self::insertBatch($batch);
        }
    }

    private static function insertBatch($batch)
    {
        try {
            DB::table('hotels')->upsert($batch, ['id'], [
                'name', 'address', 'amenities', 'policies', 'region', 'country_code'
            ]);
        } catch (\Exception $e) {
            Log::error("[❌] Database insert error: " . $e->getMessage());
        }
    }
}
