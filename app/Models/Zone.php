<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Zone extends Model
{
    use HasFactory;

    public function seatsByEvent(Event $event) {
        return $this
            ->selectRaw('seats.id as seat_id, designation')
            ->join('seats', 'zones.id', '=', 'seats.zone_id')
            ->where('zone_id', $this->id)
            ->whereRaw('NOT EXISTS (SELECT 1 FROM prices INNER JOIN tickets on prices.id = tickets.price_id WHERE event_id = ? AND (seats.id = tickets.seat_id && tickets.status = "Оплачен"))', [$event->id])
            ->get();
    }

    public function seatForStandingZone()
    {
        return $this->hasOne(Seat::class)->where('zone_id', $this->id);
    }

    public function prices() : HasMany {
        return $this->hasMany(Price::class);
    }

    public function getCountTicketsForEvent(Event $event) {
        return $this->prices->where('event_id', $event->id)->first()->tickets->count();
    }

//    public static function getFreeZonesForStanding(Event $event)
//    {
//        return self::query()
//            ->selectRaw('zones.id, name, prices.id as price_id, seats.id as seat_id, price_value, count_tickets, COUNT(*) AS count_purchased_tickets')
//            ->join('seats', 'zones.id', '=', 'seats.zone_id')
//            ->join('prices', 'zones.id', '=', 'prices.zone_id')
//            ->leftJoin('tickets', 'seats.id', '=', 'tickets.seat_id')
//            ->where('event_id', $event->id)
//            ->where('zone_type_id', ZoneType::STANDING_ZONE)
//            ->groupBy('zones.id', 'name', 'prices.id', 'seats.id', 'price_value', 'count_tickets')
//            ->having('count_tickets', '>', 'count_purchased_tickets')
//            ->get();
//    }
//
//    public static function getFreeZonesForSeating(Event $event)
//    {
//        return self::query()
//            ->selectRaw('zones.id, name, prices.id AS price_id, price_value')
//            ->join('prices', 'zones.id', '=', 'prices.zone_id')
//            ->where('event_id', $event->id)
//            ->where('zone_type_id', ZoneType::SEATING_ZONE)
//            ->get();
//    }
}
