<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\VisaController;
use App\Http\Controllers\SupportController;

Route::get('/', function () {return view('index');})->name('index');

Route::get('/pssc', function () {
    return view('pssc.index');
})->name('pssc');




Route::get('/visa', [VisaController::class, 'index'])->name('home');
Route::post('/search', [VisaController::class, 'initialSearch'])->name('initial.search');

Route::get('/visa/requirements', [VisaController::class, 'requirements'])->name('requirements');
Route::post('/visa/requirements', [VisaController::class, 'requirementsSearch'])->name('visa.requirements.search');

Route::get('/visa/search', [VisaController::class, 'search'])->name('visa.search');
Route::get('/visa/{id}/details', [VisaController::class, 'details'])->name('visa.details');
Route::post('/visa/apply', [VisaController::class, 'apply'])->name('visa.apply');
Route::post('/visa/initialize-payment', [VisaController::class, 'initializePayment'])->name('visa.initialize-payment');
Route::get('/visa/payment-callback', [VisaController::class, 'paymentCallback'])->name('visa.payment-callback');
Route::post('/visa/process-payment-and-apply', [VisaController::class, 'processPaymentAndApply'])->name('visa.process-payment-and-apply');
Route::get('/visa/payment-callback', [VisaController::class, 'paymentCallback'])->name('visa.payment-callback');
Route::get('/visa/success', [VisaController::class, 'success'])->name('visa.success');

Route::get('/voa/search', [VisaController::class, 'voaSearch'])->name('voa.search');
Route::post('/voa/initialize-payment', [VisaController::class, 'voaInitializePayment'])->name('voa.initialize-payment');
Route::post('/voa/apply', [VisaController::class, 'voaApply'])->name('voa.apply');
Route::get('/voa/payment-callback', [VisaController::class, 'voaPaymentCallback'])->name('voa.payment-callback');
Route::post('/voa/process-payment-and-apply', [VisaController::class, 'voaProcessPaymentAndApply'])->name('voa.process-payment-and-apply');
Route::get('/visas', [VisaController::class, 'indexVisa'])->name('admin.visas.index');
Route::get('/visas/create', [VisaController::class, 'createVisa'])->name('admin.visas.create');
Route::post('/admin/visas/store', [VisaController::class, 'storeVisa'])->name('admin.visas.store');
Route::get('/visas/{id}/edit', [VisaController::class, 'editVisa'])->name('admin.visas.edit');
Route::put('visas/{id}', [VisaController::class, 'updateVisa'])->name('admin.visas.update');
Route::delete('/visas/{id}', [VisaController::class, 'destroyVisa'])->name('admin.visas.destroy');
Route::get('admin/applicationsview', [VisaController::class, 'indexApplication'])->name('admin.applications.index');
Route::get('admin/applications', [VisaController::class, 'editApplication'])->name('admin.applications.edit');
Route::get('admin/applications/{id}/edit', [VisaController::class, 'editApplication'])->name('admin.applications.edit');
Route::post('admin/applications/{id}/update', [VisaController::class, 'updateApplication'])->name('admin.applications.update');
Route::post('admin/applications/{id}/request-document', [VisaController::class, 'requestDocument'])->name('admin.applications.request-document');
Route::get('track', [VisaController::class, 'trackApplication'])->name('track.application');
Route::post('track/validate', [VisaController::class, 'validateEmail'])->name('track.validate');
Route::post('track/upload/{application_id}', [VisaController::class, 'uploadDocument'])->name('track.upload');

//new Update
Route::get('/air/flight', [App\Http\Controllers\RequestController::class, 'flight'])->name('air.flight');
Route::post('/air/flightpost', [App\Http\Controllers\RequestController::class, 'flightpost'])->name('air.flightpost');
Route::post('/air/requestpost', [App\Http\Controllers\RequestController::class, 'requestpost'])->name('air.requestpost');
Route::get('/send-whatsapp', [App\Http\Controllers\RequestController::class, 'sendWhatsAppNotification']);
Route::get('/air/policy', [App\Http\Controllers\RequestController::class, 'policy'])->name('air.policy');


//Hotel Booking
Route::get('/air/hotel', [App\Http\Controllers\HotelController::class, 'hotel'])->name('air.hotel');
Route::post('/air/hotelsearch', [App\Http\Controllers\HotelController::class, 'hotelpost'])->name('air.hotelpost');
Route::post('/autocomplete', [App\Http\Controllers\HotelController::class, 'hotelAutocomplete'])->name('autoComplete');
Route::get('/hotels-list', [App\Http\Controllers\HotelController::class, 'posthotelid'])->name('hotels-list');
Route::get('/hoteldetail', [App\Http\Controllers\HotelController::class, 'getHotelInfo'])->name('detail');
Route::get('/book-now/{id}', [App\Http\Controllers\HotelController::class, 'bookNow'])->name('book.now');
Route::get('/hotel/prebook', [App\Http\Controllers\HotelController::class, 'prebook'])->name('prebook');
Route::get('/hotel/book', [App\Http\Controllers\HotelController::class, 'bookhotel'])->name('prebook.submit')->middleware('check.required.sessions:requestData,hotel_info,payment_payload');;
Route::get('/filter-hotels', [App\Http\Controllers\HotelController::class, 'filterHotels'])->name('filter.hotels')->middleware('check.required.sessions:hotelList,requestData');;
Route::post('/hotel/checkout', [App\Http\Controllers\HotelController::class, 'checkout'])->name('hotel.checkout');
Route::post('/hotel/receipt', [App\Http\Controllers\HotelController::class, 'success'])->name('hotel.receipt');


//Air Cargo 
Route::get('/air/aircargo', [App\Http\Controllers\AirCargoController::class, 'air_cargo'])->name('air.aircargo');
Route::get('/air/aircargoInternational', [App\Http\Controllers\AirCargoController::class, 'air_cargoInternational'])->name('air.aircargoInternational');
Route::post('/air/aircargoPost', [App\Http\Controllers\AirCargoController::class, 'air_cargo_post'])->name('air.aircargoPost');
Route::get('/rave_a/callback', [App\Http\Controllers\AirCargoController::class, 'callbackFlutterwave'])->name('callbackrave.aircargo');
Route::get('/seerbit_a/callback', [App\Http\Controllers\AirCargoController::class, 'callbackSeerbit'])->name('seerbit.aircargo');
Route::get('/air/aircargo_success', [App\Http\Controllers\AirCargoController::class, 'air_cargo_success'])->name('air.aircargo_success');
Route::post('/get-shipping-price', [App\Http\Controllers\AirCargoController::class, 'getShippingPrice'])->name('getShippingPrice');


Route::get('/aboutus', [App\Http\Controllers\WebController::class, 'aboutus'])->name('aboutus');
Route::get('/faq', [App\Http\Controllers\WebController::class, 'faq'])->name('faq');
Route::get('/help', [App\Http\Controllers\WebController::class, 'help'])->name('help');


// Air transport travel Insurance
Route::get('/air/insurance', [App\Http\Controllers\InsuranceController::class, 'insurance'])->name('air.insurance');
Route::get('/air/insuranceAllianz', [App\Http\Controllers\InsuranceController::class, 'insuranceAllianz'])->name('air.insuranceAllianz');
Route::get('/air/getinsurance', [App\Http\Controllers\InsuranceController::class, 'getinsurance'])->name('air.insuranceQuote');
Route::post('/air/insuranceAllianzQuote', [App\Http\Controllers\InsuranceController::class, 'makeRequestQuote'])->name('air.travelInsuranceQuote');
Route::get('/air/insuranceRequest', [App\Http\Controllers\InsuranceController::class, 'insuranceRequest'])->name('air.travelInsuranceRequest');
Route::post('/air/insuranceAllianzPurchase', [App\Http\Controllers\InsuranceController::class, 'insurancePurchase'])->name('air.travelInsurancePurchase');
Route::post('/air/makeRequestPurchase', [App\Http\Controllers\InsuranceController::class, 'makeRequestPurchase'])->name('air.makeRequestPurchase');
Route::get('/rave/callback', [App\Http\Controllers\InsuranceController::class, 'callbackFlutterwave'])->name('callback.rave');
Route::get('/seerbit/callback', [App\Http\Controllers\InsuranceController::class, 'callbackSeerbit'])->name('callback.seerbit');

Route::get('/air/insuranceLeadways', [App\Http\Controllers\LeadwayController::class, 'authentication'])->name('air.leadway');
Route::get('/air/insuranceLeadway', [App\Http\Controllers\LeadwayController::class, 'insuranceLeadway'])->name('air.insuranceLeadway');
Route::get('/air/insuranceLeadwayP', [App\Http\Controllers\LeadwayController::class, 'insuranceLeadwayP'])->name('air.insuranceLeadwayP');
Route::post('/air/insuranceLeadwayQuote', [App\Http\Controllers\LeadwayController::class, 'insuranceLeadwayQ'])->name('air.insuranceLeadwayQ');
Route::post('/air/insuranceLeadwayPurchase', [App\Http\Controllers\LeadwayController::class, 'makePurchase'])->name('air.makePurchase');


//Protocol bookings
Route::get('/air/protocol', [App\Http\Controllers\ProtocolController::class, 'protocol'])->name('air.protocol');
Route::get('/air/protocolplans/{id}', [App\Http\Controllers\ProtocolController::class, 'protocolPlans'])->name('air.protocolplans');
Route::get('/air/protocolplansI/{id}', [App\Http\Controllers\ProtocolController::class, 'protocolPlansI'])->name('air.protocolplansI');
Route::post('/air/protocolplan', [App\Http\Controllers\ProtocolController::class, 'protocolPlan'])->name('air.protocolplan');
Route::get('/air/protocolR', [App\Http\Controllers\ProtocolController::class, 'protocolR'])->name('air.protocolR');
Route::get('/air/protocolForm/{plan}', [App\Http\Controllers\ProtocolController::class, 'protocolForm'])->name('air.protocolForm');
Route::get('/air/protocolV', [App\Http\Controllers\ProtocolController::class, 'protocolV'])->name('air.protocolV');
Route::post('/air/protocolcheckout', [App\Http\Controllers\ProtocolController::class, 'protocol_checkout'])->name('air.protocol_checkout');
Route::post('/air/makePurchase', [App\Http\Controllers\ProtocolController::class, 'makePurchase'])->name('air.protocolmakePurchase');
//Route::get('/air/protocolpayment/{tran_id}', [App\Http\Controllers\ProtocolController::class, 'protocol_payment'])->name('air.protocol_payment');
Route::get('/air/protocolpayment/{trans_id}', [App\Http\Controllers\ProtocolController::class, 'protocol_payment'])->name('air.protocol_payment');

Route::get('/air/protocolsuccess', [App\Http\Controllers\ProtocolController::class, 'protocol_success'])->name('air.protocol_success');
Route::get('/rave_p/callback', [App\Http\Controllers\ProtocolController::class, 'callbackFlutterwaveP'])->name('callbackrave.protocol');
Route::get('/seerbit_p/callback', [App\Http\Controllers\ProtocolController::class, 'callbackSeerbitP'])->name('seerbit.protocol');
Route::get('/air/protocol_generate1/{trans_id}', [App\Http\Controllers\ProtocolController::class, 'callbackSeerbitP1'])->name('air.protocol_generateS');
Route::get('/air/protocol_generate2', [App\Http\Controllers\ProtocolController::class, 'callbackFlutterwaveP1'])->name('air.protocol_generateF');


//Support Product
Route::get('/air/support_ticket', [SupportController::class, 'ticketAssit'])->name('air.support_ticket');
Route::post('/air/support_ticketSave', [SupportController::class, 'ticketSave'])->name('air.support_ticketSave');
Route::get('/callback/budpay', [SupportController::class, 'budpayCallback'])->name('callback.budpay');
Route::get('/air/support_success', [SupportController::class, 'supportSuccess'])->name('air.support_success');

//admin
Route::get('/admin', function () {
        return view('admin.dashboard');
})->name('admin'); 
Route::get('/lounge', function () {
    return view('admin.addlounge');
})->name('lounge');
Route::get('/mainlounge', function () {
    return view('admin.lounges');
})->name('lounge');

Route::get('/link', function () {
Artisan::call('storage:link');
});

