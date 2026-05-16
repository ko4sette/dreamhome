<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $primaryKey = 'property_id';
    protected $fillable = [
        'branch_id', 'staff_id', 'property_name', 'property_type',
        'street', 'area', 'city', 'postcode', 'num_rooms',
        'monthly_rent', 'status', 'date_added', 'is_active',
        'description', 'image'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function getFullAddressAttribute()
    {
        return "{$this->street}, {$this->area}, {$this->city}";
    }
}
