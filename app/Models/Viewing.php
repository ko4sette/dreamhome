<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viewing extends Model
{
    protected $table = 'viewing';
    protected $primaryKey = 'viewing_id';

    protected $fillable = [
        'property_id',
        'client_id',
        'viewing_date',
        'viewing_time',
        'status',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }

    public function feedback()
    {
        return $this->hasOne(ViewingFeedback::class, 'viewing_id', 'viewing_id');
    }
}