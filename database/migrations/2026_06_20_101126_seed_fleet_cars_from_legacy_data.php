<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Seeds fleet_cars with every model that used to be hardcoded in
     * CarController, so the website keeps working after CarController
     * switches to reading from the database. Images are copied from
     * public/assets/image/... into storage/app/public/fleet/...
     *
     * Safe to run multiple times — skips any car_name+vehicle_type+service_type
     * combination that already exists.
     */
    public function up(): void
    {
        $carHireModels = [
            // type, category, name, image filename (in public/assets/image/)
            ['saloon','Regular','Toyota Corolla','saloon.jpg'],
            ['saloon','Regular','Nissan Sunny','saloon.jpg'],
            ['saloon','Regular','Hyundai Accent','saloon.jpg'],
            ['saloon','Regular','Toyota Yaris','saloon.jpg'],
            ['saloon','Standard','Toyota Camry','saloon.jpg'],
            ['saloon','Standard','Honda Accord','saloon.jpg'],
            ['saloon','Standard','Hyundai Elantra','saloon.jpg'],
            ['saloon','Standard','Kia Optima','saloon.jpg'],
            ['saloon','Executive','Toyota Avalon','saloon.jpg'],
            ['saloon','Executive','Toyota Camry XSE','saloon.jpg'],
            ['saloon','Executive','Honda Accord Sport','saloon.jpg'],
            ['saloon','Executive','Kia K5 GT','saloon.jpg'],

            ['suv','Regular','Honda CR-V','suv.jpg'],
            ['suv','Regular','Toyota RAV4','suv.jpg'],
            ['suv','Regular','Hyundai Tucson','suv.jpg'],
            ['suv','Regular','Nissan X-Trail','suv.jpg'],
            ['suv','Standard','Toyota Highlander','suv.jpg'],
            ['suv','Standard','Honda Pilot','suv.jpg'],
            ['suv','Standard','Nissan Pathfinder','suv.jpg'],
            ['suv','Standard','Ford Explorer','suv.jpg'],
            ['suv','Executive','Toyota Land Cruiser Prado','suv.jpg'],
            ['suv','Executive','Lexus RX 350','suv.jpg'],
            ['suv','Executive','Mercedes GLE','suv.jpg'],
            ['suv','Executive','BMW X5','suv.jpg'],

            ['van','Regular','Toyota HiAce (Old)','minivan.png'],
            ['van','Regular','Toyota Previa','minivan.png'],
            ['van','Regular','Hyundai H1','minivan.png'],
            ['van','Standard','Toyota HiAce','minivan.png'],
            ['van','Standard','Toyota Sienna','minivan.png'],
            ['van','Standard','Kia Carnival','minivan.png'],
            ['van','Executive','Mercedes Vito','minivan.png'],
            ['van','Executive','Mercedes V-Class','minivan.png'],
            ['van','Executive','Hyundai Staria','minivan.png'],

            ['bus','Regular','Toyota Coaster (Old)','coaster.jpg'],
            ['bus','Regular','Mitsubishi Rosa','coaster.jpg'],
            ['bus','Standard','Toyota Coaster','coaster.jpg'],
            ['bus','Standard','Mercedes Sprinter','coaster.jpg'],
            ['bus','Standard','Ford Transit','coaster.jpg'],
            ['bus','Executive','Mercedes Sprinter Exec','coaster.jpg'],
            ['bus','Executive','Hyundai County','coaster.jpg'],
            ['bus','Executive','Toyota Coaster Deluxe','coaster.jpg'],

            ['luxury','Regular','Chrysler 300C','limo.avif'],
            ['luxury','Regular','Genesis G80','limo.avif'],
            ['luxury','Regular','Lincoln MKZ','limo.avif'],
            ['luxury','Standard','Mercedes E-Class','limo.avif'],
            ['luxury','Standard','BMW 5 Series','limo.avif'],
            ['luxury','Standard','Lexus ES 350','limo.avif'],
            ['luxury','Executive','Mercedes S-Class','limo.avif'],
            ['luxury','Executive','BMW 7 Series','limo.avif'],
            ['luxury','Executive','Lexus LS 500','limo.avif'],
            ['luxury','Executive','Rolls-Royce Ghost','limo.avif'],
        ];

        $passengerLabels = [
            'saloon' => '1 – 3 Passengers',
            'suv'    => '1 – 3 Passengers',
            'van'    => 'Up to 5 Passengers',
            'bus'    => 'Up to 12 Passengers',
            'luxury' => '1 – 4 Passengers',
        ];

        foreach ($carHireModels as [$type, $category, $name, $imageFile]) {
            $exists = DB::table('fleet_cars')
                ->where('service_type', 'car_hire')
                ->where('vehicle_type', $type)
                ->whereRaw('LOWER(car_name) = ?', [strtolower($name)])
                ->exists();

            if ($exists) continue;

            $storedImage = $this->copyAssetImage($imageFile);

            DB::table('fleet_cars')->insert([
                'service_type' => 'car_hire',
                'vehicle_type' => $type,
                'category'     => $category,
                'car_name'     => $name,
                'passengers'   => $passengerLabels[$type] ?? null,
                'features'     => json_encode(['Air conditioning', 'Professional driver']),
                'images'       => $storedImage ? json_encode([$storedImage]) : json_encode([]),
                'is_active'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        $transferModels = [
            ['saloon','Toyota Camry','saloon.jpg'],
            ['saloon','Honda Accord','saloon.jpg'],
            ['saloon','Toyota Avalon','saloon.jpg'],
            ['suv','Toyota Highlander','suv.jpg'],
            ['suv','Lexus RX 350','suv.jpg'],
            ['suv','Ford Explorer','suv.jpg'],
            ['van','Toyota HiAce','minivan.png'],
            ['van','Mercedes Vito','minivan.png'],
            ['bus','Toyota Coaster','coaster.jpg'],
            ['bus','Mercedes Sprinter','coaster.jpg'],
            ['luxury','Mercedes S-Class','limo.avif'],
            ['luxury','BMW 7 Series','limo.avif'],
            ['luxury','Lexus LS 500','limo.avif'],
        ];

        foreach ($transferModels as [$type, $name, $imageFile]) {
            $exists = DB::table('fleet_cars')
                ->where('service_type', 'transfer')
                ->where('vehicle_type', $type)
                ->whereRaw('LOWER(car_name) = ?', [strtolower($name)])
                ->exists();

            if ($exists) continue;

            $storedImage = $this->copyAssetImage($imageFile);

            DB::table('fleet_cars')->insert([
                'service_type' => 'transfer',
                'vehicle_type' => $type,
                'category'     => null,
                'car_name'     => $name,
                'passengers'   => $passengerLabels[$type] ?? null,
                'features'     => json_encode(['Air conditioning', 'Professional driver']),
                'images'       => $storedImage ? json_encode([$storedImage]) : json_encode([]),
                'is_active'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }

    /**
     * Copies an image from public/assets/image/{file} into
     * storage/app/public/fleet/{file}, reusing the file if already copied.
     * Returns the relative path to store in fleet_cars.images, or null if
     * the source file doesn't exist.
     */
    private function copyAssetImage(string $filename): ?string
    {
        $sourcePath = public_path('assets/image/' . $filename);

        if (!file_exists($sourcePath)) {
            return null;
        }

        $destRelative = 'fleet/' . $filename;
        $destFullPath = storage_path('app/public/' . $destRelative);

        if (!file_exists($destFullPath)) {
            if (!is_dir(dirname($destFullPath))) {
                mkdir(dirname($destFullPath), 0755, true);
            }
            copy($sourcePath, $destFullPath);
        }

        return $destRelative;
    }

    public function down(): void
    {
        // Intentionally left empty — do not delete seeded fleet cars on rollback,
        // since admin may have edited them by then.
    }
};