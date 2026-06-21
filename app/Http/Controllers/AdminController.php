<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminUser;
use App\Models\CarHire;
use App\Models\Transfer;
use App\Models\Driver;
use App\Models\DriverAssignment;
use App\Models\TransportRate;
use App\Models\FleetCar;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AUTH GUARD
    |--------------------------------------------------------------------------
    */
    private function guard()
    {
        if (!Session::get('admin_logged_in')) {
            // ── TEMPORARY DEBUG LOGGING — remove once the issue is found ──
            Log::warning('GUARD FAILED — admin_logged_in missing', [
                'session_id'        => Session::getId(),
                'all_session_data'  => Session::all(),
                'cookies_received'  => request()->cookies->all(),
                'is_ajax'           => request()->ajax(),
                'expects_json'      => request()->expectsJson(),
                'wants_json'        => request()->wantsJson(),
                'content_type'      => request()->header('Content-Type'),
                'accept_header'     => request()->header('Accept'),
                'url'               => request()->fullUrl(),
                'method'            => request()->method(),
            ]);
            // ── END DEBUG LOGGING ──

            if (request()->expectsJson() || request()->ajax() || request()->wantsJson()) {
                abort(response()->json([
                    'success' => false,
                    'message' => 'Your admin session has expired. Please refresh the page and log in again.',
                ], 401));
            }

            abort(redirect()->route('admin.login'));
        }
    }

    /*
    |==========================================================================
    | LOGIN
    |==========================================================================
    */
    public function loginPage()
    {
        if (Session::get('admin_logged_in')) {
            return redirect()->route('admin.ctdashboard');
        }
        return view('admin.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = AdminUser::where('username', $request->username)->first();

        if (!$admin || !$admin->verifyPassword($request->password)) {
            return back()->withErrors(['credentials' => 'Invalid username or password.'])->withInput();
        }

        Session::put('admin_logged_in', true);
        Session::put('admin_name', $admin->name);
        Session::put('admin_id', $admin->id);

        // ── TEMPORARY DEBUG LOGGING — remove once the issue is found ──
        Log::warning('LOGIN SUCCESS', [
            'session_id'       => Session::getId(),
            'all_session_data' => Session::all(),
        ]);
        // ── END DEBUG LOGGING ──

        return redirect()->route('admin.ctdashboard');
    }

    public function logout()
    {
        Session::forget(['admin_logged_in', 'admin_name', 'admin_id']);
        return redirect()->route('admin.login');
    }

    /*
    |==========================================================================
    | DASHBOARD
    |==========================================================================
    */
    public function dashboard(Request $request)
    {
        $this->guard();

        // ── TEMPORARY DEBUG LOGGING — remove once the issue is found ──
        Log::warning('DASHBOARD LOADED — guard passed', [
            'session_id' => Session::getId(),
        ]);
        // ── END DEBUG LOGGING ──

        $search = $request->get('search', '');
        $tab    = $request->get('tab', 'car_hire');

        // Car Hire query
        $chQuery = CarHire::query()->latest();
        if ($search) {
            $chQuery->where(function ($q) use ($search) {
                $q->where('full_name',          'like', "%{$search}%")
                  ->orWhere('email',             'like', "%{$search}%")
                  ->orWhere('payment_reference', 'like', "%{$search}%")
                  ->orWhere('phone_number',      'like', "%{$search}%");
            });
        }
        if ($request->filled('status')) {
            $chQuery->where('payment_status', $request->status);
        }
        $carHires = $chQuery->paginate(15, ['*'], 'ch_page')->withQueryString();

        // Transfer query
        $trQuery = Transfer::query()->latest();
        if ($search) {
            $trQuery->where(function ($q) use ($search) {
                $q->where('full_name',          'like', "%{$search}%")
                  ->orWhere('email',             'like', "%{$search}%")
                  ->orWhere('payment_reference', 'like', "%{$search}%")
                  ->orWhere('phone_number',      'like', "%{$search}%");
            });
        }
        if ($request->filled('status')) {
            $trQuery->where('payment_status', $request->status);
        }
        $transfers = $trQuery->paginate(15, ['*'], 'tr_page')->withQueryString();

        // Stats
        $stats = [
            'ch_total'   => CarHire::count(),
            'ch_paid'    => CarHire::where('payment_status', 'paid')->count(),
            'ch_pending' => CarHire::where('payment_status', 'pending')->count(),
            'tr_total'   => Transfer::count(),
            'tr_paid'    => Transfer::where('payment_status', 'paid')->count(),
            'tr_pending' => Transfer::where('payment_status', 'pending')->count(),
        ];

        $drivers   = Driver::active()->orderBy('name')->get();
        $rates     = TransportRate::orderBy('vehicle_type')->get();
        $fleetCars = FleetCar::orderBy('service_type')->orderBy('vehicle_type')->orderBy('car_name')->get();

        return view('admin.ctdashboard', compact(
            'carHires', 'transfers', 'stats', 'drivers', 'search', 'tab',
            'rates', 'fleetCars'
        ));
    }

    /*
    |==========================================================================
    | BOOKING DETAIL (modal — JSON)
    |==========================================================================
    */
    public function detail(Request $request)
    {
        $this->guard();

        $type = $request->type;
        $id   = $request->id;

        if ($type === 'car_hire') {
            $booking    = CarHire::findOrFail($id);
            $assignment = DriverAssignment::where('car_hire_id', $id)->with('driver')->latest()->first();
        } else {
            $booking    = Transfer::findOrFail($id);
            $assignment = DriverAssignment::where('transfer_id', $id)->with('driver')->latest()->first();
        }

        // Use toArray() so ALL database columns are included in JSON,
        // regardless of $hidden / $visible / $appends on the model.
        // This guarantees rental_hours, distance_km etc always reach the JS.
        $bookingData = $booking->toArray();

        return response()->json([
            'booking'    => $bookingData,
            'assignment' => $assignment,
            'type'       => $type,
        ]);
    }

    /*
    |==========================================================================
    | CHANGE BOOKING STATUS
    |==========================================================================
    */
    public function updateStatus(Request $request)
    {
        $this->guard();

        $request->validate([
            'type'   => 'required|in:car_hire,transfer',
            'id'     => 'required|integer',
            'status' => 'required|in:pending,paid,confirmed,cancelled,completed',
        ]);

        $model   = $request->type === 'car_hire' ? CarHire::class : Transfer::class;
        $booking = $model::findOrFail($request->id);
        $booking->update(['payment_status' => $request->status]);

        return response()->json(['success' => true, 'status' => $request->status]);
    }

    /*
    |==========================================================================
    | ASSIGN DRIVER  (FIX 4 & 5)
    | - driver_id removed in favour of driver_name (text search / free entry)
    | - car_model auto-populated from fleet (no text input needed)
    | - car_images now accepts real uploaded files, not asset paths
    |==========================================================================
    */
    public function assignDriver(Request $request)
    {
        $this->guard();

        $request->validate([
            'type'          => 'required|in:car_hire,transfer',
            'booking_id'    => 'required|integer',
            'driver_id'     => 'nullable|exists:drivers,id',
            'driver_name'   => 'nullable|string|max:100',
            'driver_phone'  => 'nullable|string|max:20',
            'car_model'     => 'required|string|max:100',
            'car_colour'    => 'required|string|max:60',
            'plate_number'  => 'required|string|max:20',
            'car_images.*'  => 'nullable|mimes:jpg,jpeg,png,webp,avif,gif|max:4096',
            'notes'         => 'nullable|string|max:500',
        ]);

        // Must have either an existing driver_id, or enough info to create a new one
        if (!$request->filled('driver_id') && !$request->filled('driver_name')) {
            return response()->json([
                'success' => false,
                'message' => 'Please select a driver or enter a driver name.',
            ], 422);
        }

        $driverCreated = false;

        try {
            if ($request->filled('driver_id')) {
                $driver = Driver::findOrFail($request->driver_id);
            } else {
                // No driver_id supplied — find an existing driver with the same name (case-insensitive),
                // otherwise create a brand-new driver record.
                $driver = Driver::whereRaw('LOWER(name) = ?', [strtolower(trim($request->driver_name))])->first();

                if (!$driver) {
                    if (!$request->filled('driver_phone')) {
                        return response()->json([
                            'success' => false,
                            'message' => 'This driver does not exist yet — please provide a phone number to add them.',
                        ], 422);
                    }

                    $driver = Driver::create([
                        'name'      => trim($request->driver_name),
                        'phone'     => trim($request->driver_phone),
                        'is_active' => true,
                    ]);
                    $driverCreated = true;
                }
            }

            // Handle image uploads
            $carImages = [];
            if ($request->hasFile('car_images')) {
                foreach ($request->file('car_images') as $file) {
                    $path = $file->store('fleet/assigned', 'public');
                    $carImages[] = $path;
                }
            }

            // Remove any previous assignment for this booking
            DriverAssignment::where(
                $request->type === 'car_hire' ? 'car_hire_id' : 'transfer_id',
                $request->booking_id
            )->delete();

            $assignment = DriverAssignment::create([
                'driver_id'    => $driver->id,
                'car_hire_id'  => $request->type === 'car_hire'  ? $request->booking_id : null,
                'transfer_id'  => $request->type === 'transfer'  ? $request->booking_id : null,
                'booking_type' => $request->type,
                'car_model'    => $request->car_model,
                'car_colour'   => $request->car_colour,
                'plate_number' => $request->plate_number,
                'car_images'   => $carImages,
                'notes'        => $request->notes,
                'assigned_at'  => now(),
            ]);

            $model   = $request->type === 'car_hire' ? CarHire::class : Transfer::class;
            $booking = $model::findOrFail($request->booking_id);
            $booking->update(['driver_assigned' => true, 'payment_status' => 'confirmed']);

            return response()->json([
                'success'        => true,
                'assignment_id'  => $assignment->id,
                'driver_id'      => $driver->id,
                'driver_created' => $driverCreated,
            ]);

        } catch (\Throwable $e) {
            Log::error('assignDriver failed', [
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to assign driver: ' . $e->getMessage(),
            ], 500);
        }
    }

    /*
    |==========================================================================
    | GET FLEET CARS FOR A BOOKING  (FIX 5)
    | Returns the car models available for the booking's vehicle type,
    | so the assign modal can show a dropdown instead of a free-text input.
    |==========================================================================
    */
    public function fleetForBooking(Request $request)
    {
        $this->guard();

        $request->validate([
            'type' => 'required|in:car_hire,transfer',
            'id'   => 'required|integer',
        ]);

        if ($request->type === 'car_hire') {
            $booking     = CarHire::findOrFail($request->id);
            $vehicleType = $booking->car_type;
            $cars        = FleetCar::active()->forHire()
                ->where('vehicle_type', $vehicleType)
                ->get(['id', 'car_name', 'vehicle_type', 'category']);
        } else {
            $booking     = Transfer::findOrFail($request->id);
            $vehicleType = $booking->vehicle_type;
            $cars        = FleetCar::active()->forTransfer()
                ->where('vehicle_type', $vehicleType)
                ->get(['id', 'car_name', 'vehicle_type']);
        }

        return response()->json([
            'cars'         => $cars,
            'vehicle_type' => $vehicleType,
            'booked_model' => $request->type === 'car_hire'
                ? ($booking->car_model ?? null)
                : ($booking->vehicle_name ?? null),
        ]);
    }

    /*
    |==========================================================================
    | SEND DRIVER ASSIGNMENT EMAIL
    |==========================================================================
    */
    public function sendDriverEmail(Request $request)
    {
        $this->guard();

        $request->validate([
            'assignment_id' => 'required|exists:driver_assignments,id',
        ]);

        $assignment = DriverAssignment::with('driver')->findOrFail($request->assignment_id);
        $booking    = $assignment->booking();

        if (!$booking) {
            return response()->json(['success' => false, 'message' => 'Booking not found.'], 404);
        }

        try {
            Mail::to($booking->email)
                ->send(new \App\Mail\DriverAssignedMail($assignment));

            $assignment->update(['email_sent_at' => now()]);

            return response()->json(['success' => true, 'message' => 'Email sent to ' . $booking->email]);

        } catch (\Exception $e) {
            Log::error('Driver assignment email failed', [
                'assignment_id' => $assignment->id,
                'error'         => $e->getMessage(),
            ]);
            return response()->json(['success' => false, 'message' => 'Failed to send email: ' . $e->getMessage()], 500);
        }
    }

    /*
    |==========================================================================
    | RATES MANAGEMENT  (FIX 1)
    |==========================================================================
    */
    public function updateRates(Request $request)
    {
        $this->guard();

        $request->validate([
            'rates'                          => 'required|array',
            'rates.*.vehicle_type'           => 'required|string|in:saloon,suv,van,bus,luxury',
            'rates.*.price_regular'          => 'required|integer|min:0',
            'rates.*.price_standard'         => 'required|integer|min:0',
            'rates.*.price_executive'        => 'required|integer|min:0',
            'rates.*.fuel_rate_per_km'       => 'required|integer|min:0',
            'rates.*.hourly_rate'            => 'required|integer|min:0',
            'rates.*.transfer_rate_per_km'   => 'required|integer|min:0',
        ]);

        foreach ($request->rates as $row) {
            TransportRate::where('vehicle_type', $row['vehicle_type'])->update([
                'price_regular'        => $row['price_regular'],
                'price_standard'       => $row['price_standard'],
                'price_executive'      => $row['price_executive'],
                'fuel_rate_per_km'     => $row['fuel_rate_per_km'],
                'hourly_rate'          => $row['hourly_rate'],
                'transfer_rate_per_km' => $row['transfer_rate_per_km'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Rates updated successfully.']);
    }

    /*
    |==========================================================================
    | FLEET CAR — POST  (FIX 2)
    |==========================================================================
    */
    public function storeCar(Request $request)
    {
        $this->guard();

        $request->validate([
            'service_type' => 'required|in:car_hire,transfer',
            'vehicle_type' => 'required|in:saloon,suv,van,bus,luxury',
            'category'     => 'nullable|in:Regular,Standard,Executive,',
            'car_name'     => 'required|string|max:100',
            'passengers'   => 'nullable|string|max:60',
            'features'     => 'nullable|string',          // newline-separated
            'images.*'     => 'nullable|mimes:jpg,jpeg,png,webp,avif,gif|max:4096',
        ]);

        // Treat empty string category as null (Transfer cars don't have a category)
        $category = $request->filled('category') ? $request->category : null;

        // Parse features
        $features = [];
        if ($request->filled('features')) {
            $features = array_values(array_filter(
                array_map('trim', explode("\n", $request->features))
            ));
        }

        try {
            // Handle image uploads
            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = $file->store('fleet', 'public');
                    $images[] = $filename;
                }
            }

            $car = FleetCar::create([
                'service_type' => $request->service_type,
                'vehicle_type' => $request->vehicle_type,
                'category'     => $category,
                'car_name'     => $request->car_name,
                'passengers'   => $request->passengers,
                'features'     => $features,
                'images'       => $images,
                'is_active'    => true,
            ]);

            return response()->json([
                'success' => true,
                'car'     => $car,
                'message' => $car->car_name . ' added to fleet.',
            ]);

        } catch (\Throwable $e) {
            Log::error('storeCar failed', [
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to save car: ' . $e->getMessage(),
            ], 500);
        }
    }

    /*
    |==========================================================================
    | FLEET CAR — DELETE
    |==========================================================================
    */
    public function deleteCar(Request $request)
    {
        $this->guard();

        $request->validate(['car_id' => 'required|exists:fleet_cars,id']);

        $car = FleetCar::findOrFail($request->car_id);

        // Delete stored images
        foreach ($car->images ?? [] as $img) {
            Storage::disk('public')->delete($img);
        }

        $car->delete();

        return response()->json(['success' => true, 'message' => 'Car removed from fleet.']);
    }

    /*
    |==========================================================================
    | FLEET CAR — TOGGLE ACTIVE
    |==========================================================================
    */
    public function toggleCar(Request $request)
    {
        $this->guard();

        $request->validate(['car_id' => 'required|exists:fleet_cars,id']);

        $car = FleetCar::findOrFail($request->car_id);
        $car->update(['is_active' => !$car->is_active]);

        return response()->json(['success' => true, 'is_active' => $car->is_active]);
    }
}