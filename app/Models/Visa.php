<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visa extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'currency',
        'visa_type',
        'visa_category',
        'processing_type',
        'processing_days',
        'validity_days',
        'visa_fee_adult',
        'visa_fee_child',
        'visa_fee_infant',
        'biometrics_fee_adult',
        'biometrics_fee_child',
        'biometrics_fee_infant',
        'admin_fee',
        'pay_visa_to_embassy',
        'pay_bio_to_embassy',
        'requires_flight',    
        'requires_hotel',     
        'requires_insurance',
        'note'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function documents()
    {
        return $this->hasMany(VisaDocument::class);
    }

    public function charges()
    {
        return $this->hasMany(OtherCharge::class);
    }
      public function other_charges()
    {
        return $this->hasMany(OtherCharge::class, 'visa_id');
    }

    public function forms()
    {
        return $this->hasMany(VisaForm::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function insurance_options()
    {
        return $this->hasMany(InsuranceOption::class);
    }

    public function visa_documents()
    {
        return $this->hasMany(VisaDocument::class, 'visa_id');
    }
    public function visa_forms()
    {
        return $this->hasMany(VisaForm::class, 'visa_id');
    }
}
