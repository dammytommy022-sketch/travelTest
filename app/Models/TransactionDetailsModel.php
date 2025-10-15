<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetailsModel extends Model
{
	protected $table = 'transactiondetails';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'fullname', 
        'email',  
		'product',  
		'paymentgateway',  
        'amount',  
		'vat',  
		'referenceID',  
        'transactionID',
	];
}