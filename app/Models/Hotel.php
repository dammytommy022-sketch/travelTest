<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels'; // Ensure this is the correct table name
    protected $fillable = ['name','address' , 'amenities', 'policies']; // Add other fields as needed
}


?>