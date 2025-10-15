<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceQuoteModel extends Model
{
    use HasFactory;
    protected $table = 'insurancequote';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'quoteRequestId', 'productVariantId', 'dob', 'email', 'phone_no', 'coverBegins', 'coverEnds',
        'countryId', 'countryId2', 'purposeOfTravel', 'travelPlanId', 'bookingTypeId', 'noOfPeople',
        'noOfChildren', 'multiTrip', 'amount', 'amountA', 'quoteId',  'requestdate',
	];
}
