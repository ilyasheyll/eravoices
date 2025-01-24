<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show(string $code)
    {
        $ticket = Ticket::where('code', $code)->firstOrFail();
        return view('inspector.ticket.show', compact('ticket'));
    }

    public function update(Request $request, string $code)
    {
        $ticket = Ticket::where('code', $code)->firstOrFail();
        $this->authorize('inspector-update-ticket', $ticket);
        $ticket->update(['used' => (int)!$ticket->used]);
        return back();
    }
}
