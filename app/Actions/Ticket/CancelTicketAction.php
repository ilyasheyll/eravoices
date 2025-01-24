<?php

namespace App\Actions\Ticket;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class CancelTicketAction
{
    public function handle(Ticket $ticket) {
        try {
            DB::beginTransaction();
            $ticket->update(['status' => Ticket::CANCELLED_STATUS]);
            $ticket->price()->update([
                'count_purchases' => $ticket->price->count_purchases - 1
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, $exception->getMessage());
        }
    }
}
