<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visa;

class ApiVisaController extends Controller
{
    public function popularVisas(Request $request)
    {
        $visas = Visa::with('country')
            ->inRandomOrder()
            ->limit(8)
            ->get()
            ->map(function ($visa) {
                return [
                    'id' => $visa->id,
                    'country_name' => $visa->country ? $visa->country->name : '',
                    'country_code' => $visa->country ? $visa->country->code : '',
                    'visa_type' => $visa->visa_type,
                ];
            });
        return response()->json($visas);
    }
}
