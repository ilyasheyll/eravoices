<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'event_id',
        'zone_id',
        'price_value',
    ];

    protected $cascadeDeletes = ['tickets'];

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function zone() : BelongsTo {
        return $this->belongsTo(Zone::class);
    }

    public function tickets() : HasMany {
        return $this->hasMany(Ticket::class);
    }
}
