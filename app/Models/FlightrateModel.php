<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightrateModel extends Model
{
	protected $table = 'flightsrate';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'usd', 
        'pounds', 
        'euro', 
	];
}