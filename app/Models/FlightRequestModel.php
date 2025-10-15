<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightRequestModel extends Model
{
	protected $table = 'flight_request';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'origin', 
        'destination', 
        'departure_date',
        'return_date',
        'passenger',
        'cabinType',
        'email', 
        'phone_no', 
        'fullname', 
	];
}