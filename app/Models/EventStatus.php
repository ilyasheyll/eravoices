<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventStatus extends Model
{
    use HasFactory;

    public const CREATED_STATUS = 1;
    public const APPROVED_STATUS = 2;
    public const NOT_APPROVED_STATUS = 3;
    public const ACTIVE_STATUS = 4;
    public const FINISHED_STATUS = 5;

    public function events() : HasMany {
        return $this->hasMany(Event::class);
    }
}
