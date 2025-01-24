<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizer extends Model
{
    use HasFactory, Filterable, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['events', 'organizationDetail'];
    public const FIZ_PERSON = 'fiz';
    public const UR_PERSON = 'ur';
    protected $fillable = [
        'user_id',
        'phone',
        'date_birth',
        'inn',
        'type',
        'approved',
        'deleted_at'
    ];

    public static function getTypes(): array
    {
        return [
            self::FIZ_PERSON => 'Физическое лицо/самозанятый',
            self::UR_PERSON => 'Юридическое лицо'
        ];
    }

    public function organizationDetail() : HasOne {
        return $this->hasOne(OrganizationDetail::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }
}
