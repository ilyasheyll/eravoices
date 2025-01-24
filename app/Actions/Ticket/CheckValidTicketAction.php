<?php

namespace App\Actions\Ticket;

use App\Models\EventStatus;
use App\Models\Price;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\ZoneType;

class CheckValidTicketAction
{
    public function handle(array $ticketData): bool
    {
        $price = Price::with('zone')->where('id', $ticketData['priceId'])->firstOrFail();
        $seat = Seat::find($ticketData['seatId']);
        if ($price->zone_id !== $seat->zone_id || $price->event->event_status_id !== EventStatus::ACTIVE_STATUS) {
            return false;
        }

        if ($price->zone->zone_type_id === ZoneType::STANDING_ZONE) {
            return $price->zone->count_tickets > $price->count_purchases;
        } else {
            $boughtTicket = Ticket::query()
                ->where('price_id', $price->id)
                ->where('seat_id', $ticketData['seatId'])
                ->first();

            return $boughtTicket === null;
        }
    }
}
