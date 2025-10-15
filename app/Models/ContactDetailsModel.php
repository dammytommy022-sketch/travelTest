<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactDetailsModel extends Model
{
	protected $table = 'contactdetails';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'fullname', 
        'email', 
        'phone', 
		'product',  
		'request',  
	];
}