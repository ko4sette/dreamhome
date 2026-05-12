<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewingFeedback extends Model
{
    protected $table = 'viewing_feedback';
    protected $primaryKey = 'feedback_id';

    protected $fillable = [
        'viewing_id',
        'feedback_comment',
        'rating',
        'interested',
    ];

    protected $casts = [
        'interested' => 'boolean',
    ];

    public function viewing()
    {
        return $this->belongsTo(Viewing::class, 'viewing_id', 'viewing_id');
    }
}