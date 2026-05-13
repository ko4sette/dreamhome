<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalContract extends Model
{
    protected $table = 'rental_contract';
    protected $primaryKey = 'contract_id';

    protected $fillable = [
        'property_id',
        'client_id',
        'contract_start_date',
        'contract_end_date',
        'monthly_rent',
        'security_deposit',
        'contract_status',
        'terms_and_conditions',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }
}