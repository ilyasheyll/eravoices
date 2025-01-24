<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    public function event() : BelongsTo {
        return $this->belongsTo(Event::class);
    }

    public function isFavoriteForActiveEvent(): bool
    {
        return Carbon::now() < Carbon::parse($this->event->date);
    }
}
