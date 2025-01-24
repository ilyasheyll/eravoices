<?php

namespace App\Http\Controllers\Panel\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Filters\TicketFilter;
use App\Http\Requests\Ticket\FilterRequest;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
        $data = $request->validated();

        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->addMonth()->startOfMonth()->toDateString();
        $data['start_date'] = $data['start_date'] ?? $startDate;
        $data['end_date'] = $data['end_date'] ?? $endDate;

        $filter = app()->make(TicketFilter::class, ['queryParams' => array_filter($data, 'strlen')]);
        $tickets = Ticket::filter($filter)->orderBy('created_at', 'desc')->paginate(20);
//        $tickets = $ticketsBuilder->paginate(21);
//        $paidTickets = $ticketsBuilder->where('status', \App\Models\Ticket::PAID_STATUS)->get();

        return view('panel.administrator.tickets.index', compact(
            'tickets',
            'startDate',
            'endDate'
        ));
    }

    public function report(Request $request)
    {
        $data = Ticket::getTicketsForReport($request->start_date, $request->end_date);

        $resultOrganizerSum = 0;
        $resultHallSum = 0;
        foreach ($data as $item) {
            if ($item->organizer_id) {
                $resultOrganizerSum += $item->price_sum - ($item->price_sum * ((100 - $item->percent)) / 100);
                $resultHallSum += $item->price_sum - ($item->price_sum * ($item->percent / 100));
            } else {
                $resultHallSum += $item->price_sum;
            }
        }

        $pdf = Pdf::loadView(
            'pdf.report',
            [
                'data' => $data,
                'resultOrganizerSum' => $resultOrganizerSum,
                'resultHallSum' => $resultHallSum
            ],
            [],
            'UTF-8'
        );
        return $pdf->download('report.pdf');
    }
}
