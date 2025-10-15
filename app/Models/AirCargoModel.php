<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirCargoModel extends Model
{
	protected $table = 'aircargo';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'shipping_id', 
        'fullname', 
        'email',
        'phone',
        'shipping_to',
        'shipping_type',
        'shipment_preview',
        'shipment_details',
        'price',
        //'vat',
        'total_price',
        'payment_status',
        'transaction_id',
        'transaction_ref',
	];
}