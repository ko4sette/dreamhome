<?php

namespace App\Models;

use App\Models\Viewing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';
    protected $primaryKey = 'property_id';
    public $timestamps = false;

    protected $fillable = [
        'owner_id',
        'branch_id',
        'staff_id',
        'property_type',
        'street',
        'area',
        'city',
        'postcode',
        'num_rooms',
        'monthly_rent',
        'status',
        'date_added',
        'is_active',
    ];

    protected $casts = [
        'date_added' => 'date',
        'monthly_rent' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'owner_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function viewings()
    {
        return $this->hasMany(Viewing::class, 'property_id', 'property_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }
}