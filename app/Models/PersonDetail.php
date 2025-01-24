<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersonDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'phone',
        'date_birth',
        'inn',
    ];
}
