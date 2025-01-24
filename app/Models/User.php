<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_USER = 'user';
    public const ROLE_ORGANIZER = 'organizer';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_ADMIN = 'administrator';
    public const ROLE_INSPECTOR = 'inspector';

    public static function getRoles(): array {
        return [
            self::ROLE_USER => 'Пользователь',
            self::ROLE_ORGANIZER => 'Организатор',
            self::ROLE_MANAGER => 'Менеджер',
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_INSPECTOR => 'Контролёр',
        ];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'father_name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tickets() : HasMany {
        return $this->hasMany(Ticket::class);
    }

    public function organizer() : HasOne {
        return $this->hasOne(Organizer::class);
    }

    public function favorites() : HasMany {
        return $this->hasMany(Favorite::class);
    }
}