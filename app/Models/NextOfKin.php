<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    protected $primaryKey = 'next_of_kin_id';
    protected $fillable = [
        'staff_id', 'name', 'relationship', 'address', 'telephone'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
