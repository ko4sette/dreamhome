<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $primaryKey = 'staff_id';
    protected $fillable = [
        'branch_id', 'name', 'surname', 'supervisor_id',
        'address', 'telephone', 'gender', 'date_of_birth',
        'nin', 'position', 'salary', 'date_started'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Staff::class, 'supervisor_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'staff_id');
    }

    public function nextOfKin()
    {
        return $this->hasMany(NextOfKin::class, 'staff_id');
    }

    // Custom accessor for full name
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }
    public function user()
    {
        return $this->hasOne(User::class, 'staff_id', 'staff_id');
    }
}
