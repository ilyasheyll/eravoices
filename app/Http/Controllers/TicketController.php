<?php

namespace App\Http\Controllers;

use App\Actions\CreatePayment;
use App\Actions\CreateRefund;
use App\Actions\Ticket\CancelTicketAction;
use App\Models\Order;
use App\Models\Price;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use chillerlan\QRCode\QRCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function show(Ticket $ticket) {
        $this->authorize('view-ticket', $ticket);

        $ticketUrl = route('tickets.show', [$ticket->code]);
        $qrCode = (new QRCode())->render("$ticketUrl");
        $ticketData = [
            'qrCode' => $qrCode,
            'ticket' => $ticket,
            'user' => Auth::user()
        ];

        $pdf = Pdf::loadView('pdf.ticket', $ticketData, [], 'UTF-8');
        return $pdf->setPaper('a6', 'landscape')->download('ticket.pdf');
    }

    public function update(Request $request, Ticket $ticket, CreateRefund $refundAction, CancelTicketAction $cancelTicketAction)
    {
        $this->authorize('cancel-ticket', $ticket);
        $status = $refundAction->handle($ticket);
        if ($status) {
            $cancelTicketAction->handle($ticket);
        }

        return redirect()->route('user.index');
    }
}
