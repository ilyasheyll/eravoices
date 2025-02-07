<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'status',
        'youkassa_payment'
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
