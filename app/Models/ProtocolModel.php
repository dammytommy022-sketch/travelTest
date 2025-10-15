<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProtocolModel extends Model
{
	protected $table = 'protocols';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'location', 
        'aiport', 
        'service', 
        'price1',
        'price2',
	];
}