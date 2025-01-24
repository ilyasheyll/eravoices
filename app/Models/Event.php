<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use Filterable;
    use SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'category_id',
        'organizer_id',
        'name',
        'date',
        'descr',
        'image',
        'event_status_id',
    ];

    protected $cascadeDeletes = ['banners', 'favorites', 'prices', 'organizerPercent'];

    public function banners() {
        return $this->hasMany(Banner::class);
    }

    public function favorites() : HasMany {
        return $this->hasMany(Favorite::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function organizer() {
        return $this->belongsTo(Organizer::class);
    }

    public function prices() {
        return $this->hasMany(Price::class);
    }

    public function organizerPercent(): HasOne
    {
        return $this->hasOne(OrganizerPercent::class);
    }

    public function paidTickets(): Collection
    {
        return $this->hasManyThrough(
            Ticket::class,
            Price::class,
            'event_id',
            'price_id',
            'id',
            'id'
        )->where('status', Ticket::PAID_STATUS)->get();
    }

    public function status() {
        return $this->belongsTo(EventStatus::class, 'event_status_id', 'id');
    }

    public function organizerSumPercent(): float
    {
        $profit = $this->paidTickets()->sum('ticket_price');
        return $this->organizer_id ? ($profit * ((100 - $this->organizerPercent->percent) / 100)) : $profit;
    }

//    public function getCountTickets(): int {
//        $count = 0;
//
//        foreach ($this->prices as $price) {
//            $count += $price->tickets->where('status', 'Оплачен')->count();
//        }
//
//        return $count;
//    }
//
//    public function getTicketsProfit(): int {
//        $sum = 0;
//
//        foreach ($this->prices as $price) {
//            foreach ($price->tickets->where('status', 'Оплачен') as $ticket) {
//                $sum += $ticket->price->price_value;
//            }
//        }
//
//        return $sum;
//    }
}
