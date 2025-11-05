<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Country;
use App\Models\ExchangeRate;
use App\Models\InsuranceOption;
use App\Models\Visa;
use App\Models\Voa;
use App\Models\VoaFee;
use App\Models\VisaForm;
use App\Models\VisaDocument;
use App\Models\StatusHistory;
use App\Models\DocumentRequest;
use App\Models\OtherCharge;
use App\Models\VisaConfirmation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SeerbitLaravel\Facades\Seerbit;
use Str;
use Symfony\Component\Intl\Countries;

class VisaController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('visa', compact('countries'));
    }
    
     public function requirements(Request $request)
    {
        $countries = Country::all();
        // Fallback popular destinations if API is unavailable
        $popularDestinations = Country::whereIn('name', ['United States', 'United Kingdom', 'Canada', 'Australia', 'France'])->get();
        // Alternatively, use: $popularDestinations = Country::where('is_popular', true)->get();
        return view('visa-requirements', compact('countries', 'popularDestinations'));
    }

    public function requirementsSearch(Request $request)
    {
        $request->validate([
            'from_country' => 'required',
            'to_country' => 'required',
            'date_range' => 'required',
        ]);

        $fromCountry = Country::where('name', $request->from_country)->first();
        $toCountry = Country::where('name', $request->to_country)->first();

        if (!$fromCountry || !$toCountry) {
            return back()->withErrors(['error' => 'One or both countries not found.']);
        }

        $visas = Visa::with(['visa_documents', 'other_charges', 'visa_forms'])
                     ->where('country_id', $toCountry->id)
                     ->get();
        $dateRange = $request->date_range;
        $countries = Country::all();
        $popularDestinations = Country::whereIn('name', ['United States', 'United Kingdom', 'Canada', 'Australia', 'France'])->get();

        session(['last_visa_search' => $request->all()]);
        return view('visa-requirements', compact('fromCountry', 'toCountry', 'visas', 'dateRange', 'countries', 'popularDestinations'));
    }

    public function initialSearch(Request $request)
    {
        $request->validate([
            'from_country' => 'required',
            'to_country' => 'required',
            'date_range' => 'required',
        ]);

        $toCountry = Country::where('name', $request->to_country)->first();
        if (!$toCountry) {
            return back()->withErrors(['error' => 'To country not found.']);
        }

        if ($toCountry->name === 'Nigeria') {
            return redirect()->route('voa.search', $request->all());
        } else {
            return redirect()->route('visa.search', $request->all());
        }
    }
public function details($id)
    {
        $visa = Visa::with(['visa_documents', 'charges', 'visa_forms'])->findOrFail($id);
        $insurance_options = InsuranceOption::all();
        $response = $visa->toArray();
        $response['insurance_options'] = $insurance_options->toArray();
        $response['charges'] = $visa->charges->toArray();
        $exchange_rates =(object)[
    'usd_rate' => 1500,
    'gbp_rate' => 2000,
    'eur_rate' => 1800,
];
        switch (strtoupper($visa->currency)) {
    case 'USD':
        $rate = $exchange_rates->usd_rate;
        break;
    case 'GBP':
        $rate = $exchange_rates->gbp_rate;
        break;
    case 'EURO':
    case 'EUR': // Just in case someone uses EUR instead of EURO, because humans
        $rate = $exchange_rates->eur_rate;
        break;
    default: // NGN or unknown? Assume local currency = rate of 1
        $rate = 1;
        break;
}
$response['rate'] = $rate;
        return response()->json($response);
    }
    public function search(Request $request)
    {
        $request->validate([
            'from_country' => 'required',
            'to_country' => 'required',
            'date_range' => 'required',
        ]);

        $fromCountry = Country::where('name', $request->from_country)->first();
        $toCountry = Country::where('name', $request->to_country)->first();

        if (!$fromCountry || !$toCountry) {
            return back()->withErrors(['error' => 'One or both countries not found.']);
        }

        $visas = Visa::where('country_id', $toCountry->id)->get();
        $dateRange = $request->date_range;
        
        $exchange_rates = ExchangeRate::first() ?? (object)[
            'usd_rate' => 1500,
            'gbp_rate' => 2000,
            'eur_rate' => 1800,
        ];
        $countries = Country::all();

        return view('visa-results', compact('fromCountry', 'toCountry', 'visas', 'dateRange', 'exchange_rates', 'countries'));
    }
    

public function processPaymentAndApply(Request $request)
{
    // Step 1: Parse passengers if provided as JSON
    $passengers = $request->input('passengers');
    Log::debug('Retrieved passengers input', ['passengers' => $passengers]);
    if (is_string($passengers)) {
        Log::debug('Passengers input is a string, attempting to decode JSON');
        $passengers = json_decode($passengers, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Invalid passengers JSON', ['error' => json_last_error_msg()]);
            return response()->json(['success' => false, 'error' => 'Invalid passengers JSON'], 400);
        }
        $request->merge(['passengers' => $passengers]);
        Log::debug('Merged decoded passengers into request', ['passengers' => $passengers]);
    }

    // Step 2: Fetch visa and check for forms
    $visa = Visa::with('visa_forms', 'visa_documents')->findOrFail($request->input('visa_id'));
    $hasForms = $visa->visa_forms->isNotEmpty();
    Log::debug('Fetched visa details', ['visa_id' => $visa->id, 'has_forms' => $hasForms]);

    // Step 3: Define validation rules
    $validationRules = [
        'visa_id' => 'required|exists:visas,id',
        'total_price' => 'required|numeric|min:0',
        'passenger_count' => 'required|integer|min:1',
        'email' => 'required|email',
        'full_name' => 'required|string',
        'documents.*.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'flight.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'hotel.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'insurance.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'forms.*.*' => 'nullable|file|mimes:pdf|max:2048',
    ];

    // Add required documents based on visa configuration
    if ($visa->visa_documents) {
        foreach ($visa->visa_documents as $doc) {
            if ($doc->required) {
                $validationRules["documents.*.{$doc->id}"] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
            }
        }
    }

    // Add required forms if present
    if ($hasForms) {
        foreach ($visa->visa_forms as $form) {
            $validationRules["forms.*.{$form->id}"] = 'required|file|mimes:pdf|max:2048';
        }
        // Simplified KYC for forms
        $validationRules['email'] = 'required|email';
        $validationRules['full_name'] = 'required|string';
    } else {
        // Full KYC validation
        $validationRules = array_merge($validationRules, [
            'passengers' => 'required|array',
            'passengers.*.surname' => 'required|string',
            'passengers.*.first_name' => 'required|string',
            'passengers.*.sex' => 'required|in:male,female',
            'passengers.*.date_of_birth' => 'required|date_format:m/d/Y',
            'passengers.*.current_nationality' => 'required|string',
            'passengers.*.place_of_birth' => 'required|string',
            'passengers.*.passport_number' => 'required|string',
            'passengers.*.passport_type' => 'required|in:standard,diplomatic,official,emergency',
            'passengers.*.passport_issuance_date' => 'required|date_format:m/d/Y|before:passengers.*.passport_expiry_date',
            'passengers.*.passport_expiry_date' => 'required|date_format:m/d/Y',
            'passengers.*.issued_by_country' => 'required|string',
            'passengers.*.email_address' => 'required|email',
            'passengers.*.telephone_number' => 'required|string',
            'passengers.*.home_address' => 'required|string',
            'passengers.*.purpose_of_journey' => 'required|in:tourism,business,visiting',
            'passengers.*.intended_arrival_date' => 'required|date_format:m/d/Y',
            'passengers.*.intended_departure_date' => 'required|date_format:m/d/Y',
            'passengers.*.guardian_surname' => 'nullable|string',
            'passengers.*.guardian_first_name' => 'nullable|string',
            'passengers.*.guardian_number' => 'nullable|string',
        ]);
    }

    // Add conditional requirements for flight, hotel, insurance
    if ($visa->requires_flight && !$request->input('handle_flight')) {
        $validationRules['flight.*'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
    }
    if ($visa->requires_hotel && !$request->input('handle_hotel')) {
        $validationRules['hotel.*'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
    }
    if ($visa->requires_insurance && !$request->input('handle_insurance')) {
        $validationRules['insurance.*'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
    }

    try {
        Log::debug('Attempting request validation', ['rules' => $validationRules]);
        $validated = $request->validate($validationRules);
        Log::debug('Validated request data', ['validated' => $validated]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation failed', ['errors' => $e->errors()]);
        return response()->json([
            'success' => false,
            'error' => 'Validation failed',
            'details' => $e->errors()
        ], 422);
    }

    try {
        // Step 4: Initialize Seerbit payment
        $transaction_ref = 'VISA_' . strtoupper(Str::random(9));
        $amount = $validated['total_price'];
        $payload = [
            'amount' => (string) $amount,
            'callbackUrl' => url('/visa/payment-callback'),
            'country' => 'NG',
            'currency' => 'NGN',
            'email' => $validated['email'],
            'paymentReference' => $transaction_ref,
            'productDescription' => 'Visa Application Payment',
            'productId' => 'VISA_' . $validated['visa_id'],
        ];
        Log::debug('Prepared Seerbit payload', ['payload' => $payload]);

        $trans = Seerbit::Standard()->Initialize($payload);
        Log::info('Seerbit Initialize Response:', (array) $trans);
        $redirectLink = $trans['data']['payments']['redirectLink'] ?? null;

        if (empty($redirectLink)) {
            Log::error('Seerbit Payment Initialization Failed:', (array) $trans);
            return response()->json([
                'success' => false,
                'error' => $trans['data']['message'] ?? 'Payment initialization failed.'
            ], 400);
        }

// Step 5: Store documents in temp_documents
$documentPaths = [];
$tempDir = public_path('temp_documents');
if (!file_exists($tempDir)) {
    mkdir($tempDir, 0755, true);
    Log::debug('Created temp_documents directory', ['path' => $tempDir]);
}

// Handle visa documents
$documents = $request->file('documents');

Log::debug('Raw documents payload', ['raw_docs' => $documents]);

if (is_array($documents) && !empty($documents)) {
    Log::debug('Processing documents', ['documents' => array_keys($documents[0] ?? [])]);
    foreach ($documents as $index => $docs) {
        Log::debug('Processing passenger documents', ['index' => $index, 'doc_ids' => array_keys($docs)]);
        $documentPaths['documents'][$index] = [];
        foreach ($docs as $docId => $file) {
            Log::debug('Checking file', ['doc_id' => $docId, 'index' => $index, 'file' => $file]);
            if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) {
                $doc = $visa->visa_documents->find($docId);
                if ($doc) {
                    $extension = $file->getClientOriginalExtension() ?: pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = "visa_doc_{$docId}_{$index}_" . Str::random(16) . ($extension ? '.' . $extension : '');
                    $destination = public_path("temp_documents/{$filename}");
                    Log::debug('Attempting to move document', [
                        'doc_id' => $docId,
                        'index' => $index,
                        'source' => $file->getPathname(),
                        'destination' => $destination,
                        'is_writable' => is_writable($tempDir),
                    ]);
                    if ($file->move($tempDir, $filename)) {
                        $documentPaths['documents'][$index][$docId] = "temp_documents/{$filename}";
                        Log::debug("Stored visa document for passenger {$index}", ['doc_id' => $docId, 'path' => $documentPaths['documents'][$index][$docId]]);
                    } else {
                        Log::error("Failed to move document {$docId} for passenger {$index}", [
                            'source' => $file->getPathname(),
                            'destination' => $destination,
                        ]);
                        throw new \Exception("Failed to move document {$docId} for passenger {$index}.");
                    }
                } else {
                    Log::warning("Document ID {$docId} not found in visa_documents for passenger {$index}");
                }
            } else {
                Log::warning("Invalid or missing file for doc_id {$docId} and passenger {$index}");
            }
        }
    }
}

// Log document paths after processing
Log::debug('Document paths after processing', ['documentPaths' => $documentPaths]);

$forms = $request->file('forms');

if (is_array($forms) && !empty($forms)) {
    foreach ($forms as $index => $forms) {
        $documentPaths['forms'][$index] = []; // Initialize the array for this passenger
        foreach ($forms as $formId => $file) {
            if ($file && $file->isValid()) {
                $form = $visa->visa_forms->find($formId);
                if ($form) {
                    $filename = "form_{$formId}_{$index}_" . Str::random(16) . '.' . $file->getClientOriginalExtension();
                    $destination = public_path("temp_documents/{$filename}");
                    if ($file->move($tempDir, $filename)) {
                        $documentPaths['forms'][$index][$formId] = "temp_documents/{$filename}";
                        Log::debug("Stored form for passenger {$index}", ['form_id' => $formId, 'path' => $documentPaths['forms'][$index][$formId]]);
                    } else {
                        Log::error("Failed to store form {$formId} for passenger {$index}.");
                        throw new \Exception("Failed to store form {$formId} for passenger {$index}.");
                    }
                } else {
                    Log::warning("Form ID {$formId} not found in visa_forms for passenger {$index}");
                }
            }
        }
    }
}

// Handle additional uploads (flight, hotel, insurance)
$additionalDocs = ['flight', 'hotel', 'insurance'];
foreach ($additionalDocs as $docType) {
    if ($request->hasFile($docType)) {
        foreach ($request->file($docType) as $index => $file) {
            if ($file && $file->isValid()) {
                $filename = "{$docType}_{$index}_" . Str::random(16) . '.' . $file->getClientOriginalExtension();
                $destination = public_path("temp_documents/{$filename}");
                if ($file->move($tempDir, $filename)) {
                    $documentPaths[$docType][$index] = "temp_documents/{$filename}";
                    Log::debug("Stored {$docType} for passenger {$index}", ['path' => $documentPaths[$docType][$index]]);
                } else {
                    Log::error("Failed to store {$docType} document for passenger {$index}.");
                    throw new \Exception("Failed to store {$docType} document for passenger {$index}.");
                }
            }
        }
    }
}

// Log document paths for debugging
Log::debug('Document paths before session storage', ['documentPaths' => $documentPaths]);

        // Step 6: Prepare application data
        $userDetails = [
            'fullName' => $validated['full_name'],
            'email' => $validated['email'],
        ];
        if (!$hasForms && isset($validated['passengers'][0])) {
            $userDetails = array_merge($userDetails, [
                'nationality' => $validated['passengers'][0]['current_nationality'],
                'passport_number' => $validated['passengers'][0]['passport_number'],
                'passport_expiry' => $validated['passengers'][0]['passport_expiry_date'],
            ]);
        }

        $passengerData = [];
        if (!$hasForms) {
            foreach ($validated['passengers'] as $index => $passenger) {
                $passengerDetails = [
                    'surname' => $passenger['surname'],
                    'first_name' => $passenger['first_name'],
                    'sex' => $passenger['sex'],
                    'date_of_birth' => $passenger['date_of_birth'],
                    'current_nationality' => $passenger['current_nationality'],
                    'place_of_birth' => $passenger['place_of_birth'],
                    'passport_number' => $passenger['passport_number'],
                    'passport_expiry_date' => $passenger['passport_expiry_date'],
                    'passport_issuance_date' => $passenger['passport_issuance_date'],
                    'passport_type' => $passenger['passport_type'],
                    'issued_by_country' => $passenger['issued_by_country'],
                    'email_address' => $passenger['email_address'],
                    'telephone_number' => $passenger['telephone_number'],
                    'home_address' => $passenger['home_address'],
                    'purpose_of_journey' => $passenger['purpose_of_journey'],
                    'intended_arrival_date' => $passenger['intended_arrival_date'],
                    'intended_departure_date' => $passenger['intended_departure_date'],
                ];
                if (isset($passenger['guardian_surname'])) {
                    $passengerDetails['guardian_surname'] = $passenger['guardian_surname'];
                    $passengerDetails['guardian_first_name'] = $passenger['guardian_first_name'];
                    $passengerDetails['guardian_number'] = $passenger['guardian_number'];
                }
                $passengerData[] = [
                    'details' => $passengerDetails,
                    'documents' => $documentPaths['documents'][$index] ?? [],
                    'forms' => $documentPaths['forms'][$index] ?? [],
                    'flight' => $documentPaths['flight'][$index] ?? null,
                    'hotel' => $documentPaths['hotel'][$index] ?? null,
                    'insurance' => $documentPaths['insurance'][$index] ?? null,
                ];
            }
        } else {
            $passengerData[] = [
                'details' => [
                    'full_name' => $validated['full_name'],
                    'email' => $validated['email'],
                ],
                'forms' => $documentPaths['forms'][0] ?? [],
                'flight' => $documentPaths['flight'][0] ?? null,
                'hotel' => $documentPaths['hotel'][0] ?? null,
                'insurance' => $documentPaths['insurance'][0] ?? null,
            ];
        }

        $applicationId = 'VISA_' . Str::random(10);
        session(['application_id' => $applicationId]);
        $applicationData = [
            'visa_id' => $validated['visa_id'],
            'total_price' => $validated['total_price'],
            'email' => $validated['email'],
            'user_details' => json_encode($userDetails),
            'form_data' => json_encode(['passengers' => $passengerData]),
            'transaction_ref' => $transaction_ref,
            'status' => 'pending',
            'application_id' => $applicationId,
            'payment_status' => 'pending',
        ];

        // Step 7: Create application record
        $application = Application::create($applicationData);
        Log::debug('Created application record', ['application_id' => $application->application_id]);

        // Step 8: Generate PDF receipt
        $pdf = Pdf::loadView('pdf.application', [
            'application' => $application,
            'visaId' => $visa->id,
            'passengerCount' => $validated['passenger_count'],
            'totalPrice' => $validated['total_price'],
            'userDetails' => $userDetails,
            'formData' => ['passengers' => $passengerData],
        ]);
        $pdfFileName = "application_receipt_{$applicationId}.pdf";
        $pdfPath = "temp_documents/{$pdfFileName}";
        $pdf->save(public_path($pdfPath));
        session(['pdf_path' => $pdfPath]);
        Log::debug('Saved PDF receipt', ['path' => $pdfPath]);

        // Step 9: Store session data for callback
        session([
            'payment_form_data' => [
                'visa_id' => $validated['visa_id'],
                'total_price' => $validated['total_price'],
                'email' => $validated['email'],
                'full_name' => $validated['full_name'],
                'passenger_count' => $validated['passenger_count'],
                'user_details' => $userDetails,
                'form_data' => ['passengers' => $passengerData],
                'documents' => $documentPaths, // Ensure documents are stored
                'transaction_ref' => $transaction_ref,
                'pdf_path' => $pdfPath,
            ]
        ]);
        Log::debug('Stored payment form data in session', ['session_data' => session('payment_form_data')]);

        // Step 10: Return redirect URL
        return response()->json([
            'success' => true,
            'transaction_ref' => $transaction_ref,
            'redirect_url' => $redirectLink,
        ]);
    } catch (\Exception $e) {
        Log::error('Visa Application Error:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        // Cleanup temporary files on error
        if (!empty($documentPaths)) {
            foreach (['documents', 'forms', 'flight', 'hotel', 'insurance'] as $type) {
                if (isset($documentPaths[$type])) {
                    foreach ($documentPaths[$type] as $index => $docs) {
                        if (is_array($docs)) {
                            foreach ($docs as $docId => $path) {
                                $filePath = public_path($path);
                                if (file_exists($filePath)) {
                                    unlink($filePath);
                                    Log::debug("Deleted temporary file on error: {$filePath}");
                                }
                            }
                        } else {
                            $filePath = public_path($docs);
                            if (file_exists($filePath)) {
                                unlink($filePath);
                                Log::debug("Deleted temporary file on error: {$filePath}");
                            }
                        }
                    }
                }
            }
        }

        return response()->json(['success' => false, 'error' => 'An error occurred during processing: ' . $e->getMessage()], 500);
    }
}

public function paymentCallback(Request $request)
{
    Log::info('Seerbit Payment Callback:', $request->all());
    $transaction_ref = $request->query('reference');
    $formData = session('payment_form_data');
    $application_id = session('application_id');
    $pdfPath = session('pdf_path');

    // Validate session data
    if (!$transaction_ref || !$formData || !$application_id || !$pdfPath) {
        Log::error('Invalid or incomplete payment callback data', [
            'transaction_ref' => $transaction_ref,
            'formData' => $formData,
            'application_id' => $application_id,
            'pdf_path' => $pdfPath,
        ]);
        return redirect()->route('visa.search', session('last_visa_search', []))
            ->with('error', 'Invalid payment callback data.');
    }

    // Ensure form_data.passengers is an array
    if (!isset($formData['form_data']['passengers']) || !is_array($formData['form_data']['passengers'])) {
        Log::warning('Session form_data.passengers invalid, attempting to fetch from application');
        $application = Application::where('application_id', $application_id)->first();
        if ($application) {
            $formData['form_data'] = json_decode($application->form_data, true);
            Log::debug('Fetched form_data from application', ['form_data' => $formData['form_data']]);
        }
        if (!isset($formData['form_data']['passengers']) || !is_array($formData['form_data']['passengers'])) {
            Log::error('Invalid passengers data in both session and application', ['formData' => $formData]);
            return redirect()->route('visa.search', session('last_visa_search', []))
                ->with('error', 'Invalid passenger data.');
        }
    }

    try {
        // Step 1: Verify payment status
        $client = new \GuzzleHttp\Client();
        $response = $client->get("https://seerbitapi.com/api/v2/payments/query/{$transaction_ref}", [
            'headers' => [
                'Authorization' => 'Bearer ' . env('SEERBIT_TOKEN'),
                'Accept' => 'application/json',
            ],
        ]);
        $transaction = json_decode($response->getBody(), true);
        Log::info('Seerbit Transaction Verification:', $transaction);

        if ($transaction['status'] !== 'SUCCESS') {
            Log::error('Payment verification failed', ['transaction_ref' => $transaction_ref]);
            Application::where('transaction_ref', $transaction_ref)->update([
                'status' => 'failed',
                'payment_status' => 'failed',
            ]);
            session()->forget(['payment_form_data', 'application_id', 'pdf_path']);
            return redirect()->route('visa.search', session('last_visa_search', []))
                ->with('error', 'Payment failed or was cancelled.');
        }

        // Step 2: Update application status
        $application = Application::where('application_id', $application_id)->first();
        if (!$application) {
            Log::error('Application not found', ['application_id' => $application_id]);
            return redirect()->route('visa.search', session('last_visa_search', []))
                ->with('error', 'Application not found.');
        }
        $application->update([
            'payment_status' => 'paid',
        ]);
        Log::debug('Updated application status', ['application_id' => $application_id]);

        // Step 3: Move documents to permanent storage and prepare download links
       // Step 3: Move documents to permanent storage and prepare download links
$documentPaths = $formData['documents'] ?? [];
Log::debug('Retrieved document paths from session', ['documentPaths' => $documentPaths]);
$finalDocumentPaths = [];
$downloadLinks = [];
$documentsDir = public_path('documents');
$additionalDir = public_path('additional');

// Ensure directories exist
if (!file_exists($documentsDir)) {
    mkdir($documentsDir, 0755, true);
    Log::debug('Created documents directory', ['path' => $documentsDir]);
}
if (!file_exists($additionalDir)) {
    mkdir($additionalDir, 0755, true);
    Log::debug('Created additional directory', ['path' => $additionalDir]);
}

        $visa = Visa::findOrFail($formData['visa_id']);
        $toCountry = Country::find($visa->country_id);

        foreach ($formData['form_data']['passengers'] as $index => $passenger) {
            if (isset($documentPaths['documents'][$index])) {
                foreach ($documentPaths['documents'][$index] as $docId => $path) {
                    $doc = $visa->visa_documents->find($docId);
                    if ($doc) {
                        $sourcePath = public_path($path);
                        Log::debug('Checking document path', ['index' => $index, 'doc_id' => $docId, 'source_path' => $sourcePath]);
                        if (file_exists($sourcePath) && is_readable($sourcePath)) {
                            $filename = "visa_doc_{$doc->document_name}_passenger{$index}_" . Str::random(8) . '.' . pathinfo($path, PATHINFO_EXTENSION);
                            $destinationPath = public_path("documents/{$filename}");
                            if (rename($sourcePath, $destinationPath)) {
                                $finalDocumentPaths['documents'][$index][$docId] = "documents/{$filename}";
                                $downloadLinks[] = [
                                    'name' => "{$doc->document_name} (Passenger " . ($index + 1) . ")",
                                    'url' => url("public/documents/{$filename}"),
                                    'type' => 'Document',
                                ];
                                Log::debug("Moved document for passenger {$index}", ['doc_id' => $docId, 'from' => $path, 'to' => $finalDocumentPaths['documents'][$index][$docId]]);
                            } else {
                                Log::warning('Failed to move document', ['doc_id' => $docId, 'from' => $sourcePath, 'to' => $destinationPath]);
                            }
                        } else {
                            Log::warning('Document file does not exist or is not readable', ['path' => $sourcePath]);
                        }
                    } else {
                        Log::warning('Document ID not found in visa_documents', ['doc_id' => $docId]);
                    }
                }
            }
            if (isset($documentPaths['forms'][$index])) {
                foreach ($documentPaths['forms'][$index] as $formId => $path) {
                    $form = $visa->visa_forms->find($formId);
                    if ($form) {
                        $sourcePath = public_path($path);
                        Log::debug('Checking form path', ['index' => $index, 'form_id' => $formId, 'source_path' => $sourcePath]);
                        if (file_exists($sourcePath) && is_readable($sourcePath)) {
                            $filename = "form_{$form->form_name}_passenger{$index}_" . Str::random(8) . '.pdf';
                            $destinationPath = public_path("documents/{$filename}");
                            if (rename($sourcePath, $destinationPath)) {
                                $finalDocumentPaths['forms'][$index][$formId] = "documents/{$filename}";
                                $downloadLinks[] = [
                                    'name' => "{$form->form_name} (Passenger " . ($index + 1) . ")",
                                    'url' => url("public/documents/{$filename}"),
                                    'type' => 'Form',
                                ];
                                Log::debug("Moved form for passenger {$index}", ['form_id' => $formId, 'from' => $path, 'to' => $finalDocumentPaths['forms'][$index][$formId]]);
                            } else {
                                Log::warning('Failed to move form', ['form_id' => $formId, 'from' => $sourcePath, 'to' => $destinationPath]);
                            }
                        } else {
                            Log::warning('Form file does not exist or is not readable', ['path' => $sourcePath]);
                        }
                    } else {
                        Log::warning('Form ID not found in visa_forms', ['form_id' => $formId]);
                    }
                }
            }
            foreach (['flight', 'hotel', 'insurance'] as $docType) {
                if (isset($documentPaths[$docType][$index])) {
                    $sourcePath = public_path($documentPaths[$docType][$index]);
                    Log::debug('Checking additional document path', ['doc_type' => $docType, 'index' => $index, 'source_path' => $sourcePath]);
                    if (file_exists($sourcePath) && is_readable($sourcePath)) {
                        $filename = "{$docType}_passenger{$index}_" . Str::random(8) . '.' . pathinfo($documentPaths[$docType][$index], PATHINFO_EXTENSION);
                        $destinationPath = public_path("additional/{$filename}");
                        if (rename($sourcePath, $destinationPath)) {
                            $finalDocumentPaths[$docType][$index] = "additional/{$filename}";
                            $downloadLinks[] = [
                                'name' => ucfirst($docType) . " (Passenger " . ($index + 1) . ")",
                                'url' => url("public/additional/{$filename}"),
                                'type' => ucfirst($docType),
                            ];
                            Log::debug("Moved {$docType} for passenger {$index}", ['from' => $documentPaths[$docType][$index], 'to' => $finalDocumentPaths[$docType][$index]]);
                        } else {
                            Log::warning('Failed to move additional document', ['doc_type' => $docType, 'from' => $sourcePath, 'to' => $destinationPath]);
                        }
                    } else {
                        Log::warning('Additional document file does not exist or is not readable', ['doc_type' => $docType, 'path' => $sourcePath]);
                    }
                }
            }
        }

        // Attach PDF receipt
       $pdfFileName = "application_receipt_{$application_id}.pdf";
$finalDocumentPath = "documents/{$pdfFileName}";
$sourcePath = public_path($pdfPath);
Log::debug('Checking PDF receipt path', ['source_path' => $sourcePath, 'destination_path' => public_path($finalDocumentPath)]);
if (file_exists($sourcePath) && is_readable($sourcePath)) {
    if (rename($sourcePath, public_path($finalDocumentPath))) { // Fix: Use public_path($finalDocumentPath)
     $downloadLinks[] = [
    'name' => "Application Receipt",
    'url' => url("public/{$finalDocumentPath}"),
    'type' => 'Receipt',
];
        Log::debug('Moved PDF receipt', ['from' => $pdfPath, 'to' => $finalDocumentPath]);
    } else {
        Log::warning('Failed to move PDF receipt', ['from' => $sourcePath, 'to' => public_path($finalDocumentPath)]);
    }
} else {
    Log::warning('PDF receipt file does not exist or is not readable', ['path' => $sourcePath]);
}

        // Step 4: Prepare email data
        $emailData = [
            'applicationId' => $application->application_id,
            'visa' => $visa,
            'toCountry' => $toCountry,
            'userDetails' => $formData['user_details'],
            'passengerCount' => $formData['passenger_count'],
            'totalPrice' => $formData['total_price'],
            'exchangeRate' => 1500,
            'downloadLinks' => $downloadLinks,
            'reference' => $transaction_ref,
        ];

        // Step 5: Send confirmation email with CC and only PDF receipt attachment
        try {
            Mail::send('emails.success', $emailData, function ($message) use ($formData, $finalDocumentPath) {
                $message->to($formData['email'])
                        ->cc('support@travelwheel.ng')
                        ->subject('Visa Application Confirmation');
                // Attach PDF receipt only
                if (file_exists(public_path($finalDocumentPath))) {
                    $message->attach(public_path($finalDocumentPath), [
                        'as' => "application_receipt.pdf",
                        'mime' => 'application/pdf',
                    ]);
                    Log::debug("Attached PDF receipt to email", ['path' => $finalDocumentPath]);
                } else {
                    Log::warning('PDF receipt not found for attachment', ['path' => $finalDocumentPath]);
                }
            });
            Log::info('Sent confirmation email', ['email' => $formData['email'], 'cc' => 'support@travelwheel.ng']);
        } catch (\Exception $e) {
            Log::error('Failed to send confirmation email', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            // Send admin notification for email failure
            try {
                Mail::raw("Failed to send visa application confirmation email for application ID: {$application->application_id}. Error: {$e->getMessage()}", function ($message) {
                    $message->to('support@travelwheel.ng')
                            ->subject('Visa Application Email Failure Notification');
                });
                Log::info('Sent admin notification for email failure', ['application_id' => $application->application_id]);
            } catch (\Exception $adminEmailException) {
                Log::error('Failed to send admin notification email', [
                    'message' => $adminEmailException->getMessage(),
                    'trace' => $adminEmailException->getTraceAsString(),
                ]);
            }
        }

        // Step 6: Clear session
        session()->forget(['payment_form_data', 'application_id', 'pdf_path']);
        Log::debug('Cleared session data');

        // Step 7: Redirect to success page
        return redirect()->route('visa.success')->with([
            'applicationId' => $application->application_id,
            'visa' => $visa,
            'userDetails' => $formData['user_details'],
            'totalPrice' => $formData['total_price'],
            'passengerCount' => $formData['passenger_count'],
            'toCountry' => $toCountry,
            'exchangeRate' => 1500,
        ]);
    } catch (\Exception $e) {
        Log::error('Payment Callback Error:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        // Cleanup on error
        if ($pdfPath && file_exists(public_path($pdfPath)) && is_writable(public_path($pdfPath))) {
            unlink(public_path($pdfPath));
            Log::debug('Deleted PDF on error', ['path' => $pdfPath]);
        }
        foreach (['documents', 'forms', 'flight', 'hotel', 'insurance'] as $type) {
            if (isset($documentPaths[$type])) {
                foreach ($documentPaths[$type] as $index => $docs) {
                    if (is_array($docs)) {
                        foreach ($docs as $docId => $path) {
                            $filePath = public_path($path);
                            if (file_exists($filePath) && is_writable($filePath)) {
                                unlink($filePath);
                                Log::debug("Deleted document on error: {$filePath}");
                            }
                        }
                    } else {
                        $filePath = public_path($docs);
                        if (file_exists($filePath) && is_writable($filePath)) {
                            unlink($filePath);
                            Log::debug("Deleted document on error: {$filePath}");
                        }
                    }
                }
            }
        }

        session()->forget(['payment_form_data', 'application_id', 'pdf_path']);
        return redirect()->route('visa.search', session('last_visa_search', []))
            ->with('error', 'Payment processing failed: ' . $e->getMessage());
    }
}

public function voaSearch(Request $request)
{
    $request->validate([
        'from_country' => 'required',
        'to_country' => 'required',
        'date_range' => 'required',
    ]);

    $fromCountry = Country::where('name', $request->from_country)->first();
    $toCountry = Country::where('name', $request->to_country)->first();

    if (!$fromCountry || !$toCountry) {
        return back()->withErrors(['error' => 'One or both countries not found.']);
    }

    if ($toCountry->name !== 'Nigeria') {
        return redirect()->route('visa.search', $request->all())->with('info', 'VOA is only available for Nigeria.');
    }

    $voa = Voa::with('country')->where('from_country_id', $fromCountry->id)->first();
    
    // Fetch all fees and prepare a structured array
    $rawFees = VoaFee::all()->keyBy('fee_type');
    $voaFees = [
        'biometrics' => [ // Changed from 'biometric' to 'biometrics' to match database
            'amount_african' => $rawFees->has('biometrics') ? $rawFees['biometrics']->amount_african : 0,
            'amount_non_african' => $rawFees->has('biometrics') ? $rawFees['biometrics']->amount_non_african : 0,
        ],
        'service' => [
            'amount_african' => $rawFees->has('service') ? $rawFees['service']->amount_african : 0,
            'amount_non_african' => $rawFees->has('service') ? $rawFees['service']->amount_non_african : 0,
        ],
        'payment' => [
            'amount_african' => $rawFees->has('payment') ? $rawFees['payment']->amount_african : 0,
            'amount_non_african' => $rawFees->has('payment') ? $rawFees['payment']->amount_non_african : 0,
        ],
        'processing_adult' => [
            'amount_african' => $rawFees->has('processing_adult') ? $rawFees['processing_adult']->amount_african : 0,
            'amount_non_african' => $rawFees->has('processing_adult') ? $rawFees['processing_adult']->amount_non_african : 0,
        ],
        'processing_fp' => [
            'amount_african' => $rawFees->has('processing_fp') ? $rawFees['processing_fp']->amount_african : 0,
            'amount_non_african' => $rawFees->has('processing_fp') ? $rawFees['processing_fp']->amount_non_african : 0,
        ],
        'processing_np' => [
            'amount_african' => $rawFees->has('processing_np') ? $rawFees['processing_np']->amount_african : 0,
            'amount_non_african' => $rawFees->has('processing_np') ? $rawFees['processing_np']->amount_non_african : 0,
        ],
    ];

    $dateRange = $request->date_range;
    $exchange_rate = 1500;
    $flight = 30; // Assuming flight fee is fixed at 30 USD
    $countries = Country::has('visas')->get();
    $nigeria = Country::where('name', 'Nigeria')->first();

    if ($nigeria && !$countries->contains('id', $nigeria->id)) {
        $countries->push($nigeria);
    }

    $message = $voa ? null : 'No Visa on Arrival is available for citizens of ' . $fromCountry->name . '.';

    return view('voa-results', compact('fromCountry', 'toCountry', 'voa', 'voaFees', 'dateRange', 'exchange_rate', 'flight', 'countries', 'message'));
}

public function voaProcessPaymentAndApply(Request $request)
{
    // Step 1: Parse passengers JSON if present
    $passengers = $request->input('passengers');
    Log::debug('Retrieved passengers input', ['passengers' => $passengers]);
    if (is_string($passengers)) {
        Log::debug('Passengers input is a string, attempting to decode JSON');
        $passengers = json_decode($passengers, true);
        Log::debug('Decoded passengers JSON', ['decoded' => $passengers]);
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Invalid passengers JSON', ['input' => $passengers]);
            Log::debug('JSON decoding failed', ['error' => json_last_error_msg()]);
            return response()->json(['success' => false, 'error' => 'Invalid passengers JSON'], 400);
        }
        $request->merge(['passengers' => $passengers]);
        Log::debug('Merged decoded passengers into request', ['passengers' => $passengers]);
    }

    // Step 2: Validate the incoming request
    $validationRules = [
        'voa_id' => 'required|exists:voas,id',
        'total_price' => 'required|numeric|min:0',
        'email' => 'required|email',
        'full_name' => 'required|string',
        'passenger_count' => 'required|integer|min:1',
        'travelwheel_flight' => 'required|in:0,1',
        'flight_fee' => 'required|numeric|min:0',
        'passengers' => 'required|array',
        'passengers.*.passenger_type' => 'required|in:adult,minor_fp,minor_np',
        'passengers.*.surname' => 'required|string',
        'passengers.*.first_name' => 'required|string',
        'passengers.*.sex' => 'required|in:male,female',
        'passengers.*.date_of_birth' => 'required|date_format:m/d/Y',
        'passengers.*.current_nationality' => 'required|string',
        'passengers.*.place_of_birth' => 'required|string',
        'passengers.*.passport_number' => 'required|string',
        'passengers.*.passport_expiry_date' => 'required|date_format:m/d/Y',
        'passengers.*.passport_issuance_date' => 'required|date_format:m/d/Y|before:passengers.*.passport_expiry_date',
        'passengers.*.passport_type' => 'required|in:standard,diplomatic,official,emergency',
        'passengers.*.issued_by_country' => 'required|string',
        'passengers.*.email_address' => 'required|email',
        'passengers.*.telephone_number' => 'required|string',
        'passengers.*.home_address' => 'required|string',
        'passengers.*.purpose_of_journey' => 'required|in:business',
        'passengers.*.intended_arrival_date' => 'required|date_format:m/d/Y',
        'passengers.*.intended_departure_date' => 'required|date_format:m/d/Y',
        'data_page.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'invitation_letter.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'cac.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'passport_photo.*' => 'required|file|mimes:jpg,jpeg,png|max:2048',
    ];

    if ($request->input('travelwheel_flight') === '0') {
        $validationRules['flight_itinerary.*'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
    } else {
        $validationRules['flight_itinerary.*'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048';
    }

    try {
        $validated = $request->validate($validationRules);
        Log::debug('Validated request data', ['validated' => $validated]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation failed', ['errors' => $e->errors()]);
        return response()->json([
            'success' => false,
            'error' => 'Validation failed',
            'details' => $e->errors()
        ], 422);
    }

    try {
        // Step 3: Initialize Seerbit payment
        $transaction_ref = 'VOA_' . strtoupper(Str::random(9));
        $amount = $validated['total_price'];

        $payload = [
            'amount' => (string) $amount,
            'callbackUrl' => url('/voa/payment-callback'),
            'country' => 'NG',
            'currency' => 'NGN',
            'email' => $validated['email'],
            'paymentReference' => $transaction_ref,
            'productDescription' => 'Visa on Arrival Payment',
            'productId' => 'VOA_' . $validated['voa_id'],
        ];

        $trans = Seerbit::Standard()->Initialize($payload);
        $redirectLink = $trans['data']['payments']['redirectLink'] ?? null;

        if (empty($redirectLink)) {
            return response()->json([
                'success' => false,
                'error' => $trans['data']['message'] ?? 'Payment initialization failed.',
                'seerbit_response' => (array) $trans
            ], 400);
        }

        // Step 4: Store documents
        $documentPaths = [];
        $tempDir = public_path('temp_documents');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $docTypes = ['data_page', 'invitation_letter', 'cac', 'flight_itinerary', 'passport_photo'];
        foreach ($docTypes as $docType) {
            if ($docType === 'flight_itinerary' && $validated['travelwheel_flight'] === '1') {
                continue;
            }
            if ($request->hasFile($docType)) {
                foreach ($request->file($docType) as $index => $file) {
                    $filename = "{$docType}_" . Str::random(16) . '.' . $file->getClientOriginalExtension();
                    $destination = public_path("temp_documents/{$filename}");
                    move_uploaded_file($file->getPathname(), $destination);
                    $documentPaths['documents'][$index][$docType] = "temp_documents/{$filename}";
                }
            }
        }

        // Step 5: Store data in session
        session([
            'payment_form_data' => [
                'voa_id' => $validated['voa_id'],
                'total_price' => $validated['total_price'],
                'email' => $validated['email'],
                'full_name' => $validated['full_name'],
                'nationality' => $validated['passengers'][0]['current_nationality'],
                'passportNumber' => $validated['passengers'][0]['passport_number'],
                'passportExpiry' => $validated['passengers'][0]['passport_expiry_date'],
                'passenger_count' => $validated['passenger_count'],
                'travelwheel_flight' => $validated['travelwheel_flight'],
                'flight_fee' => $validated['flight_fee'],
                'passengers' => $validated['passengers'],
                'documents' => $documentPaths,
                'transaction_ref' => $transaction_ref,
            ]
        ]);

        // Step 6: Return redirect URL
        return response()->json(['success' => true, 'redirect_url' => $redirectLink, 'transaction_ref' => $transaction_ref]);

    } catch (\Exception $e) {
        // Cleanup temporary files on error
        if (!empty($documentPaths)) {
            foreach (['documents'] as $type) {
                if (isset($documentPaths[$type])) {
                    foreach ($documentPaths[$type] as $index => $docs) {
                        foreach ($docs as $docId => $path) {
                            $filePath = public_path($path);
                            if (file_exists($filePath)) {
                                unlink($filePath);
                            }
                        }
                    }
                }
            }
        }

        Log::error('VOA Payment and Application Exception:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json(['success' => false, 'error' => 'Processing failed: ' . $e->getMessage()], 500);
    }
}

public function voaPaymentCallback(Request $request)
{
    Log::info('Seerbit VOA Payment Callback:', $request->all());

    // Step 1: Retrieve and validate session data
    $formData = session('payment_form_data');
    $transactionRef = $request->query('reference');

    if (!$formData || !$transactionRef) {
        Log::error('Invalid or incomplete payment callback data', [
            'transaction_ref' => $transactionRef,
            'formData' => $formData,
        ]);
        return redirect()->route('voa.search', session('last_voa_search', []))
            ->with('error', 'Invalid payment callback data.');
    }

    // Ensure form_data.passengers is an array
    if (!isset($formData['passengers']) || !is_array($formData['passengers'])) {
        Log::error('Invalid passengers data in session', ['formData' => $formData]);
        return redirect()->route('voa.search', session('last_voa_search', []))
            ->with('error', 'Invalid passenger data.');
    }

    try {
        // Step 2: Verify payment status
        $client = new \GuzzleHttp\Client();
        $response = $client->get("https://seerbitapi.com/api/v2/payments/query/{$transactionRef}", [
            'headers' => [
                'Authorization' => 'Bearer ' . env('SEERBIT_TOKEN'),
                'Accept' => 'application/json',
            ],
        ]);
        $transaction = json_decode($response->getBody(), true);
        Log::info('Seerbit Transaction Verification:', $transaction);

        if ($transaction['status'] !== 'SUCCESS') {
            Log::error('Payment verification failed', ['transaction_ref' => $transactionRef]);
            Application::where('transaction_ref', $transactionRef)->update([
                'status' => 'failed',
                'payment_status' => 'failed',
            ]);
            session()->forget(['payment_form_data', 'pdf_path']);
            return redirect()->route('voa.search', session('last_voa_search', []))
                ->with('error', 'Payment failed or was cancelled.');
        }

        // Step 3: Prepare application data
        $userDetails = [
            'fullName' => $formData['full_name'],
            'email' => $formData['email'],
            'nationality' => $formData['nationality'],
            'passportNumber' => $formData['passportNumber'],
            'passportExpiry' => $formData['passportExpiry'],
        ];

        $passengerData = [];
        $documentPaths = $formData['documents'] ?? [];
        $finalDocumentPaths = [];
        $downloadLinks = [];
        $documentsDir = public_path('documents');
        $additionalDir = public_path('additional');

        // Ensure directories exist
        if (!file_exists($documentsDir)) {
            mkdir($documentsDir, 0755, true);
            Log::debug('Created documents directory', ['path' => $documentsDir]);
        }
        if (!file_exists($additionalDir)) {
            mkdir($additionalDir, 0755, true);
            Log::debug('Created additional directory', ['path' => $additionalDir]);
        }

        $visa = Voa::findOrFail($formData['voa_id']);

        // Step 4: Move documents to permanent storage and prepare download links
        foreach ($formData['passengers'] as $index => $passenger) {
            $passengerDetails = [
                'surname' => $passenger['surname'],
                'first_name' => $passenger['first_name'],
                'sex' => $passenger['sex'],
                'date_of_birth' => $passenger['date_of_birth'],
                'current_nationality' => $passenger['current_nationality'],
                'place_of_birth' => $passenger['place_of_birth'],
                'passport_number' => $passenger['passport_number'],
                'passport_expiry_date' => $passenger['passport_expiry_date'],
                'passport_issuance_date' => $passenger['passport_issuance_date'],
                'passport_type' => $passenger['passport_type'],
                'issued_by_country' => $passenger['issued_by_country'],
                'email_address' => $passenger['email_address'],
                'telephone_number' => $passenger['telephone_number'],
                'home_address' => $passenger['home_address'],
                'purpose_of_journey' => $passenger['purpose_of_journey'],
                'intended_arrival_date' => $passenger['intended_arrival_date'],
                'intended_departure_date' => $passenger['intended_departure_date'],
                'travelwheel_flight' => $formData['travelwheel_flight'],
            ];

            if (isset($passenger['guardian_surname'])) {
                $passengerDetails['guardian_surname'] = $passenger['guardian_surname'];
                $passengerDetails['guardian_first_name'] = $passenger['guardian_first_name'];
                $passengerDetails['guardian_number'] = $passenger['guardian_number'];
            }

            $documents = [];
            if (isset($documentPaths['documents'][$index])) {
                foreach ($documentPaths['documents'][$index] as $docType => $path) {
                    $sourcePath = public_path($path);
                    Log::debug('Checking document path', ['index' => $index, 'doc_type' => $docType, 'source_path' => $sourcePath]);
                    if (file_exists($sourcePath) && is_readable($sourcePath)) {
                        $filename = "{$docType}_passenger{$index}_" . Str::random(8) . '.' . pathinfo($path, PATHINFO_EXTENSION);
                        $destinationPath = ($docType === 'passport_photo') ? public_path("additional/{$filename}") : public_path("documents/{$filename}");
                        if (rename($sourcePath, $destinationPath)) {
                            $finalDocumentPaths['documents'][$index][$docType] = ($docType === 'passport_photo') ? "additional/{$filename}" : "documents/{$filename}";
                            $downloadLinks[] = [
                                'name' => ucfirst(str_replace('_', ' ', $docType)) . " (Passenger " . ($index + 1) . ")",
                                'url' => url("public/" . ($docType === 'passport_photo' ? "additional/{$filename}" : "documents/{$filename}")),
                                'type' => ($docType === 'passport_photo') ? 'Passport Photo' : 'Document',
                            ];
                            Log::debug("Moved document for passenger {$index}", ['doc_type' => $docType, 'from' => $path, 'to' => $finalDocumentPaths['documents'][$index][$docType]]);
                        } else {
                            Log::warning('Failed to move document', ['doc_type' => $docType, 'from' => $sourcePath, 'to' => $destinationPath]);
                        }
                    } else {
                        Log::warning('Document file does not exist or is not readable', ['path' => $sourcePath]);
                    }
                }
                $documents = $finalDocumentPaths['documents'][$index] ?? [];
            }

            $passengerData[] = [
                'details' => $passengerDetails,
                'documents' => $documents,
            ];
        }

        $formDataForStorage = ['passengers' => $passengerData];

        // Step 5: Generate and save PDF
        $pdfDir = public_path('documents');
        if (!file_exists($pdfDir)) {
            mkdir($pdfDir, 0755, true);
            Log::debug('Created documents directory for PDF', ['path' => $pdfDir]);
        }

        $pdfFileName = "voa_receipt_{$transactionRef}.pdf";
        $pdfPath = "documents/{$pdfFileName}";
        $pdf = Pdf::loadView('pdf.voa-application', [
            'userDetails' => $userDetails,
            'formData' => $formDataForStorage,
            'voaId' => $formData['voa_id'],
            'passengerCount' => $formData['passenger_count'],
            'totalPrice' => $formData['total_price'],
        ]);
        Log::debug('Loaded PDF view', ['view' => 'pdf.voa-application']);
        $pdf->save(public_path($pdfPath));
        Log::debug('Saved PDF', ['path' => $pdfPath]);

        // Add PDF to download links
        if (file_exists(public_path($pdfPath))) {
            $downloadLinks[] = [
                'name' => "Application Receipt",
                'url' => url("public/{$pdfPath}"),
                'type' => 'Receipt',
            ];
            Log::debug('Added PDF receipt to download links', ['path' => $pdfPath]);
        } else {
            Log::warning('Failed to generate PDF receipt', ['path' => $pdfPath]);
        }

        // Step 6: Create application record
        $applicationId = 'VOA_' . Str::random(10);
        Application::create([
            'visa_id' => null,
            'voa_id' => $formData['voa_id'],
            'email' => $formData['email'],
            'user_details' => json_encode($userDetails),
            'form_data' => json_encode($formDataForStorage),
            'payment_status' => 'paid',
            'application_id' => $applicationId,
            'transaction_ref' => $transactionRef,
        ]);
        Log::debug('Created application record', ['application_id' => $applicationId]);

        // Step 7: Send confirmation email
        $emailData = [
            'applicationId' => $applicationId,
            'visa' => $visa,
            'toCountry' => 'Nigeria',
            'userDetails' => $userDetails,
            'passengerCount' => $formData['passenger_count'],
            'totalPrice' => $formData['total_price'],
            'exchangeRate' => 1500,
            'downloadLinks' => $downloadLinks,
            'reference' => $transactionRef,
        ];

        try {
            Mail::send('emails.voa-success', $emailData, function ($message) use ($formData, $pdfPath) {
                $message->to($formData['email'])
                        ->cc('support@travelwheel.ng')
                        ->subject('Visa on Arrival Application Successful');
                if (file_exists(public_path($pdfPath))) {
                    $message->attach(public_path($pdfPath), [
                        'as' => 'application_receipt.pdf',
                        'mime' => 'application/pdf',
                    ]);
                    Log::debug('Attached PDF receipt to email', ['path' => $pdfPath]);
                } else {
                    Log::warning('PDF receipt not found for attachment', ['path' => $pdfPath]);
                }
            });
            Log::info('Sent confirmation email', ['email' => $formData['email'], 'cc' => 'support@travelwheel.ng']);
        } catch (\Exception $e) {
            Log::error('Failed to send confirmation email', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            try {
                Mail::raw("Failed to send VOA confirmation email for application ID: {$applicationId}. Error: {$e->getMessage()}", function ($message) {
                    $message->to('support@travelwheel.ng')
                            ->subject('VOA Application Email Failure Notification');
                });
                Log::info('Sent admin notification for email failure', ['application_id' => $applicationId]);
            } catch (\Exception $adminEmailException) {
                Log::error('Failed to send admin notification email', [
                    'message' => $adminEmailException->getMessage(),
                    'trace' => $adminEmailException->getTraceAsString(),
                ]);
            }
        }

        // Step 8: Clear session
        session()->forget(['payment_form_data', 'pdf_path']);
        Log::debug('Cleared session data');

        // Step 9: Redirect to success page
        return redirect()->route('visa.success')->with([
            'applicationId' => $applicationId,
            'visa' => $visa,
            'userDetails' => $userDetails,
            'totalPrice' => $formData['total_price'],
            'passengerCount' => $formData['passenger_count'],
            'toCountry' => 'Nigeria',
            'exchangeRate' => 1500,
            'downloadLinks' => $downloadLinks,
        ]);

    } catch (\Exception $e) {
        Log::error('VOA Payment Callback Error:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        // Cleanup on error
        if (isset($pdfPath) && file_exists(public_path($pdfPath)) && is_writable(public_path($pdfPath))) {
            unlink(public_path($pdfPath));
            Log::debug('Deleted PDF on error', ['path' => $pdfPath]);
        }
        foreach (['documents'] as $type) {
            if (isset($documentPaths[$type])) {
                foreach ($documentPaths[$type] as $index => $docs) {
                    foreach ($docs as $docType => $path) {
                        $filePath = public_path($path);
                        if (file_exists($filePath) && is_writable($filePath)) {
                            unlink($filePath);
                            Log::debug("Deleted document on error: {$filePath}");
                        }
                    }
                }
            }
        }

        session()->forget(['payment_form_data', 'pdf_path']);
        return redirect()->route('voa.search', session('last_voa_search', []))
            ->with('error', 'Payment processing failed: ' . $e->getMessage());
    }
}
    public function success(Request $request)
    {
        // Check if required session data is available
        if (!$request->session()->has('applicationId')) {
            return redirect()->route('visa.search')->with('error', 'No application data found.');
        }

        // Retrieve session data
        $data = [
            'applicationId' => session('applicationId'),
            'visa' => session('visa'),
            'userDetails' => session('userDetails'),
            'totalPrice' => session('totalPrice'),
            'passengerCount' => session('passengerCount'),
            'toCountry' => session('toCountry'),
            'exchangeRate' => session('exchangeRate', 1500),
        ];

        // Clear session data to prevent reuse
        $request->session()->forget(['applicationId', 'visa', 'userDetails', 'totalPrice', 'passengerCount', 'toCountry', 'exchangeRate']);

        return view('success', $data);
    }
    
    
    
    //Admin side
       public function createVisa()
    {
        $countries = Country::all();
        $visaDocuments = VisaDocument::all();
        $currencies = ['USD', 'GBP', 'EUR', 'NGN'];
        return view('create', compact('countries', 'visaDocuments', 'currencies'));
    }


    public function storeVisa(Request $request)
    {
        $request->validate([
            'country_id' => 'required|string',
            'visa_type' => 'required|in:eVisa,Tourist,Business,Student,Work',
            'visa_category' => 'required|in:Single,Double, Multiple',
            'processing_type' => 'required|in:Standard,Express,Super Express', 'Prime time', 'Premium',
            'processing_days' => 'required|integer|between:1,90',
            'validity_days' => 'required|integer|between:1,365',
            'visa_fee_adult' => 'required|numeric|min:0',
            'visa_fee_child' => 'required|numeric|min:0',
            'visa_fee_infant' => 'required|numeric|min:0',
            'biometrics_fee_adult' => 'required|numeric|min:0',
            'biometrics_fee_child' => 'required|numeric|min:0',
            'biometrics_fee_infant' => 'required|numeric|min:0',
            'admin_fee' => 'required|numeric|min:0',
            'currency' => 'required|in:USD,GBP,EUR,NGN',
            'requires_flight' => 'boolean',
            'requires_hotel' => 'boolean',
            'requires_insurance' => 'boolean',
            'documents' => 'array',
            'documents.*.id' => 'nullable|integer',
            'documents.*.name' => 'required_with:documents|string',
            'documents.*.description' => 'nullable|string',
            'documents.*.category' => 'required_with:documents|string',
            'other_charges' => 'array',
            'other_charges.*.charge_name' => 'required|string',
            'other_charges.*.amount' => 'required|numeric|min:0',
            'other_charges.*.note' => 'nullable|string',
            'other_charges.*.pay_to_embassy' => 'boolean',
            'other_charges.*.traveler_type' => 'required|in:adult,child,infant,all',
            'form_type' => 'required|in:upload,custom',
            'form_file' => 'nullable|file|mimes:pdf|max:2048',
            'form_name' => 'required_if:form_type,custom|string',
            'form_fields' => 'required_if:form_type,custom|json',
            'note' => 'nullable',
        ]);

        try {
            // Check if country exists, create if not
            $country = Country::where('name', $request->country_id)->first();
            $code = array_search($request->country_id, Countries::getNames());
            if (!$country) {
                $country = Country::create([
                    'name' => $request->country_id,
                    'code' => $code
                ]);
            }

            $visa = Visa::create([
                'country_id' => $country->id,
                'currency' => $request->currency,
                'visa_type' => $request->visa_type,
                'visa_category' => $request->visa_category,
                'processing_type' => $request->processing_type,
                'processing_days' => $request->processing_days,
                'validity_days' => $request->validity_days,
                'visa_fee_adult' => $request->visa_fee_adult,
                'visa_fee_child' => $request->visa_fee_child,
                'visa_fee_infant' => $request->visa_fee_infant,
                'biometrics_fee_adult' => $request->biometrics_fee_adult,
                'biometrics_fee_child' => $request->biometrics_fee_child,
                'biometrics_fee_infant' => $request->biometrics_fee_infant,
                'admin_fee' => $request->admin_fee,
                'pay_visa_to_embassy' => $request->input('pay_fees', false),
                'pay_bio_to_embassy' => $request->input('pay_bio_fees', false),
                'requires_flight' => $request->input('requires_flight', false),
                'requires_hotel' => $request->input('requires_hotel', false),
                'requires_insurance' => $request->input('requires_insurance', false),
                'note' => $request->note
            ]);

            if ($request->documents) {
    foreach ($request->documents as $doc) {
        
            // Create new document
            VisaDocument::create([
                'document_name' => $doc['name'],
                'description' => $doc['description'] ?? null,
                'category' => $doc['category'],
                'visa_id' => $visa->id
            ]);
        
    }
}

            if ($request->other_charges) {
                foreach ($request->other_charges as $charge) {
                    $visa->other_charges()->create([
                        'charge_name' => $charge['charge_name'],
                        'amount' => $charge['amount'],
                        'note' => $charge['note'] ?? null,
                        'pay_to_embassy' => filter_var($charge['pay_to_embassy'] ?? false, FILTER_VALIDATE_BOOLEAN),
                        'traveler_type' => $charge['traveler_type'],
                    ]);
                }
            }

            // Handle fillable form
            if ($request->hasFile('form_file')) {
                $fileName = time() . '_' . $request->file('form_file')->getClientOriginalName();
                $filePath = $request->file('form_file')->move(public_path('visa_forms'), $fileName);
                VisaForm::create([
                    'visa_id' => $visa->id,
                    'form_name' => $fileName,
                    'form_type' => 'pdf',
                    'file_path' => 'visa_forms/' . $fileName,
                    'form_fields' => null,
                ]);
            } elseif ($request->form_type === 'custom') {
                VisaForm::create([
                    'visa_id' => $visa->id,
                    'form_name' => $request->form_name,
                    'form_type' => 'custom',
                    'file_path' => null,
                    'form_fields' => json_decode($request->form_fields, true),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Visa created successfully.',
                'redirect' => route('admin.visas.index'),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function editVisa($id)
    {
        $visa = Visa::with(['visa_documents', 'other_charges'])->findOrFail($id);
        $countries = Country::all();
        $currencies = ['USD', 'GBP', 'EUR', 'NGN'];
        return view('edit', compact('visa', 'countries', 'visaDocuments', 'currencies'));
    }

    // Add updateVisa method (to be implemented with edit functionality)
public function updateVisa(Request $request, $id)
{
    $visa = Visa::findOrFail($id);

    $request->validate([
        'country_id' => 'required|exists:countries,id',
        'currency' => 'required|in:USD,GBP,EUR,NGN',
        'visa_type' => 'required|in:eVisa,Tourist,Business,Student,Work',
         'visa_category' => 'required|in:Single,Double, Multiple',
        'processing_type' => 'required|in:Standard,Express,Super Express', 'Prime time', 'Premium',
        'processing_days' => 'required|integer|between:1,90',
        'validity_days' => 'required|integer|between:1,365',
        'visa_fee_adult' => 'required|numeric|min:0',
        'visa_fee_child' => 'required|numeric|min:0',
        'visa_fee_infant' => 'required|numeric|min:0',
        'biometrics_fee_adult' => 'required|numeric|min:0',
        'biometrics_fee_child' => 'required|numeric|min:0',
        'biometrics_fee_infant' => 'required|numeric|min:0',
        'admin_fee' => 'required|numeric|min:0',
        'requires_flight' => 'boolean',
        'requires_hotel' => 'boolean',
        'requires_insurance' => 'boolean',
        'pay_fees' => 'boolean',
         'pay_bio_fees' => 'boolean',
        'note' => 'nullable|string',

        'documents' => 'nullable|array',
        'documents.*.name' => 'required|string',
        'documents.*.description' => 'nullable|string',
        'documents.*.category' => 'required|string',

        'other_charges' => 'nullable|array',
        'other_charges.*.charge_name' => 'required|string',
        'other_charges.*.amount' => 'required|numeric|min:0',
        'other_charges.*.note' => 'nullable|string',
        'other_charges.*.pay_to_embassy' => 'boolean',
        'other_charges.*.traveler_type' => 'required|in:Adult,Child,Infant,All',

        'form_type' => 'nullable|in:upload,custom',
        'form_name' => 'required_if:form_type,custom|string',
        'form_fields' => 'required_if:form_type,custom|json',
        'form_file' => 'required_if:form_type,upload|file|mimes:pdf|max:2048',
    ]);
    

    try {
        // Update core visa details
        $visa->update([
            'country_id' => $request->country_id,
            'currency' => $request->currency,
            'visa_type' => $request->visa_type,
            'visa_category' => $request->visa_category,
            'processing_type' => $request->processing_type,
            'processing_days' => $request->processing_days,
            'validity_days' => $request->validity_days,
            'visa_fee_adult' => $request->visa_fee_adult,
            'visa_fee_child' => $request->visa_fee_child,
            'visa_fee_infant' => $request->visa_fee_infant,
            'biometrics_fee_adult' => $request->biometrics_fee_adult,
            'biometrics_fee_child' => $request->biometrics_fee_child,
            'biometrics_fee_infant' => $request->biometrics_fee_infant,
            'admin_fee' => $request->admin_fee,
            'pay_visa_to_embassy' => $request->pay_fees,
            'pay_bio_to_embassy' => $request->pay_bio_fees,
            'requires_flight' => $request->requires_flight,
            'requires_hotel' => $request->requires_hotel,
            'requires_insurance' => $request->requires_insurance,
            'note' => $request->note,
        ]);

        // 🔥 Delete and recreate visa documents
        $visa->visa_documents()->delete();
        if ($request->filled('documents')) {
            foreach ($request->documents as $doc) {
                $visa->visa_documents()->create([
                    'document_name' => $doc['name'],
                    'description' => $doc['description'] ?? null,
                    'category' => $doc['category'],
                ]);
            }
        }

        // 🔥 Delete and recreate other charges
        $visa->other_charges()->delete();
        if ($request->filled('other_charges')) {
            foreach ($request->other_charges as $charge) {
                $visa->other_charges()->create([
                    'charge_name' => $charge['charge_name'],
                    'amount' => $charge['amount'],
                    'note' => $charge['note'] ?? null,
                    'pay_to_embassy' => filter_var($charge['pay_to_embassy'] ?? false, FILTER_VALIDATE_BOOLEAN),
                    'traveler_type' => $charge['traveler_type'],
                ]);
            }
        }

$visa->forms()->delete();
       if ($request->hasFile('form_file')) {
    $file = $request->file('form_file');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('visa_forms'), $fileName);

    $visa->forms()->create([
        'form_name' => $fileName,
        'form_type' => 'pdf',
        'file_path' => 'visa_forms/' . $fileName,
        'form_fields' => null,
    ]);
}

        return response()->json([
            'success' => true,
            'message' => 'Visa updated',
            'redirect' => route('admin.visas.index'),
        ]);
    } catch (\Exception $e) {
        \Log::error($e);
        return response()->json([
            'success' => false,
            'message' => 'Visa update failed: ' . $e->getMessage(),
        ], 500);
    }
}

    public function indexVisa()
    {
        $visas = Visa::with('country')->get();
        return view('adminvisa', compact('visas'));
    }

    public function destroyVisa($id)
    {
        $visa = Visa::findOrFail($id);
        $visa->delete();

        return redirect()->route('admin.visas.index')->with('success', 'Visa deleted successfully.');
    }
    
    
    //admin-client feature
public function indexApplication()
{
    $applications = Application::with('document_requests')
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Paginate for performance
    return view('admin.applications.index', compact('applications'));
}
    
    public function editApplication($id)
{
    $application = Application::with(['visa', 'visa.documents', 'visa.forms', 'document_requests'])->findOrFail($id);
    return view('admin.applications.edit', compact('application'));
}

public function updateApplication(Request $request, $id)
{
    // dd($request->all());
    // 1. Validate request input
    $request->validate([
        'status' => 'required|in:pending,under_review,awaiting_documents,approved,rejected',
        'visa_document' => 'nullable|file|mimes:pdf|max:2048',
    ]);

    // 2. Get the application
    $application = Application::findOrFail($id);
    $application->status = $request->status;
    $application->status_updated_at = now();
    
   

    // 3. Handle file upload (to public/visas)
    if ($request->hasFile('visa_document')) {
        $file = $request->file('visa_document');

        // Define and ensure the destination folder exists
        $destinationPath = public_path('visas');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
            Log::info("Created visas directory: " . $destinationPath);
        }

        // Remove old visa document if it exists
        if ($application->visa_document_path && file_exists(public_path($application->visa_document_path))) {
            unlink(public_path($application->visa_document_path));
            Log::info("Deleted old visa document: " . $application->visa_document_path);
        }

        // Save new file
        $filename = uniqid('visa_') . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);

        // Store path relative to public folder
        $application->visa_document_path = 'visas/' . $filename;

        Log::info("Visa document uploaded: " . $application->visa_document_path);
    }

    // 4. Save application update
    $application->save();

    // 5. Record status history
    StatusHistory::create([
        'application_id' => $application->id,
        'status' => $request->status,
        'changed_by' => 'support@travelwheel.ng',
    ]);

    // 6. Prepare email notification
    $userDetails = json_decode($application->user_details, true);
    Log::info("Sending status update email to: " . $userDetails['email']);

    try {
        Mail::send('emails.status-update', [
            'application' => $application,
            'userDetails' => $userDetails,
        ], function ($message) use ($application, $userDetails) {
            $message->to($userDetails['email'])
                    ->cc('support@travelwheel.ng')
                    ->subject('Visa Application Status Update');

            $attachmentPath = public_path($application->visa_document_path);
            if (!empty($application->visa_document_path) && file_exists($attachmentPath)) {
                $message->attach($attachmentPath, [
                    'as' => 'visa_document.pdf',
                    'mime' => 'application/pdf',
                ]);
                Log::info("Attached visa document to email.");
            } else {
                Log::warning("Visa document not attached: file does not exist at " . $attachmentPath);
            }
        });

        Log::info("Status update email sent successfully.");
    } catch (\Exception $e) {
        Log::error("Failed to send status update email: " . $e->getMessage());
    }

    // 7. Redirect back with success
    return redirect()->route('admin.applications.index')->with('success', 'Application updated successfully.');
}


public function requestDocument(Request $request, $id)
{
    $request->validate([
        'document_name' => 'required|string',
        'description' => 'nullable|string',
        'category' => 'required|string',
        'deadline' => 'nullable|date',
    ]);

    $application = Application::findOrFail($id);
    $documentRequest = DocumentRequest::create([
        'application_id' => $id,
        'document_name' => $request->document_name,
        'description' => $request->description,
        'category' => $request->category,
        'deadline' => $request->deadline,
    ]);

    $userDetails = json_decode($application->user_details, true);
    Log::info("Sending document request email to: " . $userDetails['email']);

    try {
        Mail::send('emails.document-request', [
            'application' => $application,
            'documentRequest' => $documentRequest,
            'userDetails' => $userDetails,
        ], function ($message) use ($application, $userDetails) {
            $message->to($userDetails['email'])
                    ->cc('support@travelwheel.ng')
                    ->subject('Additional Document Required for Visa Application');
        });

        Log::info("Document request email sent successfully.");
    } catch (\Exception $e) {
        Log::error("Failed to send document request email: " . $e->getMessage());
    }

    return redirect()->route('admin.applications.edit', $id)->with('success', 'Document request sent successfully.');
}

//VISA TRACKING FEATURE
public function trackApplication(Request $request)
{
    $applications = null;
    if ($request->session()->has('validated_email')) {
        $applications = Application::where('email', $request->session()->get('validated_email'))
            ->with('document_requests')
            ->get();
    }
    return view('track', compact('applications'));
}

public function validateEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'application_id' => 'nullable|string',
    ]);

    $query = Application::where('email', $request->email);
    if ($request->application_id) {
        $query->where('application_id', $request->application_id);
    }

    $applications = $query->with('document_requests')->get();

    if ($applications->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No applications found for this email or application ID.',
        ], 404);
    }

    $request->session()->put('validated_email', $request->email);

    return response()->json([
        'success' => true,
        'applications' => $applications->map(function ($application) {
            return [
                'id' => $application->id,
                'application_id' => $application->application_id,
                'status' => ucfirst(str_replace('_', ' ', $application->status)),
                'visa_document_path' => $application->visa_document_path ?? null,
                'document_requests' => $application->document_requests->map(function ($request) {
                    return [
                        'id' => $request->id,
                        'document_name' => $request->document_name,
                        'category' => $request->category,
                        'description' => $request->description,
                        'status' => ucfirst($request->status),
                        'deadline' => $request->deadline ? \Carbon\Carbon::parse($request->deadline)->format('M d, Y') : null,
                        'uploaded_path' => $request->uploaded_path ?? null,
                    ];
                }),
            ];
        }),
    ]);
}

    public function uploadDocument(Request $request, $application_id)
{
    // 1. Validate the incoming request
    $request->validate([
        'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB max
        'document_request_id' => 'required|exists:document_requests,id',
    ]);

    // 2. Ensure email validation has occurred
    if (!$request->session()->has('validated_email')) {
        return response()->json([
            'success' => false,
            'message' => 'Please validate your email first.',
        ], 401);
    }

    // 3. Find the application
    $application = Application::where('email', $request->session()->get('validated_email'))
        ->where('id', $application_id)
        ->firstOrFail();

    // 4. Validate the document request
    $documentRequest = $application->document_requests()
        ->where('id', $request->document_request_id)
        ->where('status', 'requested')
        ->firstOrFail();

    // 5. Move the uploaded file to the public/documents folder
$file = $request->file('document');
$originalExtension = $file->getClientOriginalExtension();
$originalMime = $file->getMimeType(); 
$originalName = $file->getClientOriginalName();

$filename = uniqid('doc_') . '.' . $originalExtension;
$file->move(public_path('documents'), $filename);
$publicPath = 'documents/' . $filename;


    // 6. Update document request record
    $documentRequest->update([
        'status' => 'uploaded',
        'uploaded_path' => $publicPath,
    ]);

    // 7. Notify admin via email
    Mail::send('emails.document-uploaded', [
    'application' => $application,
    'documentRequest' => $documentRequest,
], function ($message) use ($application, $publicPath, $originalExtension, $originalMime) {
    $message->to('support@travelwheel.ng')
            ->cc($application->email)
            ->subject('Document Uploaded for Application ' . $application->application_id)
            ->attach(public_path($publicPath), [
                'as' => 'document.' . $originalExtension,
                'mime' => $originalMime,
            ]);
});


    // 8. Return a JSON success response
    return response()->json([
        'success' => true,
        'message' => 'Document uploaded successfully.',
        'file_name' => $request->file('document')->getClientOriginalName(),
        'public_url' => asset($publicPath),
    ]);
}

   public function visa_confirmation()
    {
        return view('visa.visa_confirmation');
    } 
    public function submit(Request $request)
{
    // ✅ Validate all input fields
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'required|string|max:20',
        'visa_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'payment_method' => 'required|string',
        'additional_info' => 'nullable|string',
    ]);

    // ✅ Handle file upload
    $filePath = $request->file('visa_file')->store('visa_uploads', 'public');

    // ✅ Save record to DB
    VisaConfirmation::create([
        'full_name' => $validated['full_name'],
        'email' => $validated['email'],
        'phone_number' => $validated['phone_number'],
        'visa_file' => $filePath,
        'payment_method' => $validated['payment_method'],
        'additional_info' => $validated['additional_info'] ?? null,
        'price' => 50000, // fixed service price
    ]);

    return back()->with('success', 'Visa confirmation submitted successfully!');
}
}