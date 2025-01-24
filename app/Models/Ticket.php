<?php

namespace App\Models;

use App\Events\Tickets\TicketCreatedEvent;
use App\Models\Traits\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, Filterable, SoftDeletes;

    protected static function booted()
    {
        static::created(function($ticket) {
            event(new TicketCreatedEvent($ticket));
        });
    }

    public const NEW_STATUS = 'Создан';
    public const PAID_STATUS = 'Оплачен';
    public const CANCELLED_STATUS = 'Отменён';
    protected $guarded = false;

    public function price() : BelongsTo {
        return $this->belongsTo(Price::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function seat() : BelongsTo {
        return $this->belongsTo(Seat::class);
    }

    public function order() : BelongsTo {
        return $this->belongsTo(Order::class);
    }

    public static function generateCode() : string {
        $ticketCode = '';
        while (true) {
            $ticketCode = bin2hex(random_bytes(32));
            $ticketByCode = self::query()->where('code', $ticketCode)->first();
            if (!$ticketByCode) break;
        }

        return $ticketCode;
    }

    public function isActiveTicket(): bool {
        return Carbon::now() < Carbon::parse($this->price->event->date)
            && $this->status === Ticket::PAID_STATUS
            && $this->used == 0;
    }

    public static function getTicketsForEvents(string $startDate, string $endDate) {
        return self::query()
            ->selectRaw('name, COUNT(*) as count_tickets, SUM(ticket_price) as price_sum')
            ->join('prices', 'prices.id', '=', 'tickets.price_id')
            ->join('events', 'events.id', '=', 'prices.event_id')
            ->where('status', Ticket::PAID_STATUS)
            ->where('tickets.created_at', '>=', $startDate)
            ->where('tickets.created_at', '<', $endDate)
            ->groupBy('name')
            ->get();
    }

    public static function getTicketsForDays(string $startDate, string $endDate) {
        return self::query()
            ->selectRaw('DATE_FORMAT(created_at, "%d.%m.%Y") as date, COUNT(*) as count_tickets, SUM(ticket_price) as price_sum')
            ->where('status', Ticket::PAID_STATUS)
            ->where('tickets.created_at', '>=', $startDate)
            ->where('tickets.created_at', '<', $endDate)
            ->groupBy('date')
            ->get();
    }

    public static function getTicketsForOrganizers(string $startDate, string $endDate) {
        return self::query()
            ->selectRaw('last_name, first_name, father_name, COUNT(*) as count_tickets, SUM(ticket_price) as price_sum')
            ->join('prices', 'prices.id', '=', 'tickets.price_id')
            ->join('events', 'events.id', '=', 'prices.event_id')
            ->join('organizers', 'organizers.id', '=', 'events.organizer_id')
            ->join('users', 'users.id', '=', 'organizers.user_id')
            ->where('status', Ticket::PAID_STATUS)
            ->where('tickets.created_at', '>=', $startDate)
            ->where('tickets.created_at', '<', $endDate)
            ->groupBy('last_name', 'first_name', 'father_name')
            ->get();
    }

    public static function getTicketsForReport(string $startDate, string $endDate)
    {
        return self::query()
            ->selectRaw('events.name AS event_name, COUNT(*) as count_tickets, SUM(ticket_price) as price_sum, last_name, first_name, father_name, events.organizer_id, percent, organizers.type, organization_details.name AS organization_name')
            ->join('prices', 'prices.id', '=', 'tickets.price_id')
            ->join('events', 'events.id', '=', 'prices.event_id')
            ->leftJoin('organizer_percents', 'events.id', '=', 'organizer_percents.event_id')
            ->leftJoin('organizers', 'organizers.id', '=', 'events.organizer_id')
            ->leftJoin('users', 'users.id', '=', 'organizers.user_id')
            ->leftJoin('organization_details', 'events.organizer_id', '=', 'organization_details.organizer_id')
            ->where('status', Ticket::PAID_STATUS)
            ->where('tickets.created_at', '>=', $startDate)
            ->where('tickets.created_at', '<', $endDate)
            ->groupBy('events.name', 'last_name', 'first_name', 'father_name', 'events.organizer_id', 'percent', 'organizers.type', 'organization_details.name')
            ->get();

//        return self::query()
//            ->selectRaw('tickets.id, price_id, event_id, events.name AS event_name, events.organizer_id, last_name, first_name, father_name, organization_details.name AS organization_name, price_value, tickets.created_at')
//            ->join('prices', 'prices.id', '=', 'tickets.price_id')
//            ->join('events', 'events.id', '=', 'prices.event_id')
//            ->leftJoin('organizers', 'organizers.id', '=', 'events.organizer_id')
//            ->leftJoin('users', 'users.id', '=', 'organizers.user_id')
//            ->leftJoin('organization_details', 'events.organizer_id', '=', 'organization_details.organizer_id')
//            ->where('status', 'Оплачен')
//            ->where('tickets.created_at', '>=', $startDate)
//            ->where('tickets.created_at', '<', $endDate)
//            ->get();

        // return self::query()
        //     ->selectRaw('name, COUNT(*) as count_tickets, SUM(price_value) as price_sum')
        //     ->join('prices', 'prices.id', '=', 'tickets.price_id')
        //     ->join('events', 'events.id', '=', 'prices.event_id')
        //     ->join('organizers', 'organizers.id', '=', 'events.organizer_id')
        //     ->join('users', 'users.id', '=', 'organizers.user_id')
        //     ->where('status', 'Оплачен')
        //     ->where('tickets.created_at', '>=', $startDate)
        //     ->where('tickets.created_at', '<', $endDate)
        //     ->groupBy('name')
        //     ->get();

        // return self::query()
        //     ->selectRaw('events.name AS event_name, events.organizer_id, last_name, first_name, father_name, organization_details.name AS organization_name, COUNT(*) as count_tickets, SUM(price_value) as price_sum')
        //     ->join('prices', 'prices.id', '=', 'tickets.price_id')
        //     ->join('events', 'events.id', '=', 'prices.event_id')
        //     ->join('organizers', 'organizers.id', '=', 'events.organizer_id')
        //     ->join('organization_details', 'organization_details.id', '=', 'organizers.id')
        //     ->join('users', 'users.id', '=', 'organizers.user_id')
        //     ->where('status', 'Оплачен')
        //     ->where('tickets.created_at', '>=', $startDate)
        //     ->where('tickets.created_at', '<', $endDate)
        //     ->groupBy('events.name, events.organizer_id, last_name, first_name, father_name, organization_details.name')
        //     ->get();
    }
}
