<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';
    protected $primaryKey = 'staff_id';
    public $timestamps = false;

    protected $fillable = [
        'branch_id',
        'first_name',
        'last_name',
        'address',
        'phone',
        'sex',
        'date_of_birth',
        'nin',
        'position',
        'salary',
        'date_joined',
        'typing_speed',
        'manager_start_date',
        'car_allowance',
        'bonus',
    ];
}