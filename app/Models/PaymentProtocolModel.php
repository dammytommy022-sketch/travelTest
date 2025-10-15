<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentProtocolModel extends Model
{
	protected $table = 'protocol_bookings';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'paymentoption',
		'fullname', 
		'package', 
		'service', 
		'passenger', 
		'email', 
		'phone',
		'travel_date',
		'state',
		'airline',
		'airport',
		'd_time',
		'service_type',
		'status', 
		'amount', 
		'vat', 
		'optional_request',
		'optionalRequestOption',
		'optionalRequestAddress',
		'reservationCode',
		'eTicketNo',
		'noOfBags',
		'means_id',
		'trans_id', 
		'ref_id', 
	];

	protected $casts = [
		'reservationCode' => 'array',
		'fullname' => 'array',
		'eTicketNo' => 'array',
		'noOfBags' => 'array',
	];
	
}