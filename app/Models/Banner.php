<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'min_descr',
        'event_id',
        'image',
        'active',
        'link'
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
