<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $primaryKey = 'branch_id';
    protected $fillable = [
        'branch_name', 'street', 'area', 'city',
        'postcode', 'telephone', 'fax_number'
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'branch_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'branch_id');
    }

    public function staffCount()
    {
        return $this->hasMany(Staff::class, 'branch_id')->count();
    }

    public function getAddressAttribute()
    {
        return "{$this->street}, {$this->area}, {$this->city}";
    }
}
