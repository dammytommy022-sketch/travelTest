<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsurancePurchaseModel extends Model
{
    use HasFactory;
    protected $table = 'insurancepurchase';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'qoute_id', 'cover_id', 'bookingtype_id', 'c_amount', 'vat', 't_amount', 'payment_option',  'surname', 'middlename', 'gender', 'dob', 
        'title', 'dob', 'email', 'phone_no', 'state', 'address', 'zipcode', 'passport_no', 'occupation',
        'nationalty', 'marital_status', 'noc', 'medicalCondition', 'nok_fullname', 'nok_addres', 'nok_phone', 
        'nok_relationship',
	];
}
