<?php

namespace App\Listeners\Tickets;

use App\Events\Tickets\TicketCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCountPurchasesListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketCreatedEvent $event): void
    {
        $event->ticket->price()->update([
            'count_purchases' => $event->ticket->price->count_purchases + 1
        ]);
    }
}
