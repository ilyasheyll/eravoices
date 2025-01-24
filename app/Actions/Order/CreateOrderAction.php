<?php

namespace App\Actions\Order;

use App\Actions\Ticket\CheckValidTicketAction;
use App\Models\Order;
use App\Models\Price;
use App\Models\Ticket;
use App\Models\ZoneType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateOrderAction
{
    public function handle(array $orderData): Order {
        $validAction = new CheckValidTicketAction();
        try {
            DB::beginTransaction();
            $order = Order::create([
                'price' => $orderData['price'],
                'status' => 1
            ]);
            foreach ($orderData['tickets'] as $ticket) {
                if (!$validAction->handle($ticket)) {
                    throw new \Exception('Данный билет недоступен для покупки!');
                }

                $order->tickets()->create([
                    'code' => Ticket::generateCode(),
                    'user_id' => Auth::user()->id,
                    'seat_id' => $ticket['seatId'],
                    'price_id' => $ticket['priceId'],
                    'ticket_price' => $ticket['priceValue'],
                    'status' => Ticket::PAID_STATUS
                ]);
            }
            DB::commit();

            return $order;
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }
}
