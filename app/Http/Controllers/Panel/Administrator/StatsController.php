<?php

namespace App\Http\Controllers\Panel\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketsPerDay;
use App\Http\Resources\TicketsByEvent;
use App\Http\Resources\TicketsByOrganizer;
use App\Models\Ticket;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index() {
        return view('panel.administrator.stats.index');
    }

    public function statsPerDays(Request $request) {
        $tickets = Ticket::getTicketsForDays($request->start_date, $request->end_date);
        return TicketsPerDay::collection($tickets);
    }

    public function statsByEvents(Request $request) {
        $tickets = Ticket::getTicketsForEvents($request->start_date, $request->end_date);
        return TicketsByEvent::collection($tickets);
    }

    public function statsByOrganizers(Request $request) {
        $tickets = Ticket::getTicketsForOrganizers($request->start_date, $request->end_date);
        return TicketsByOrganizer::collection($tickets);
    }
}
