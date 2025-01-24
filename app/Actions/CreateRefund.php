<?php

namespace App\Actions;

use App\Models\Ticket;
use Exception;
use YooKassa\Client;

class CreateRefund
{
    public function handle(Ticket $ticket) : bool {
        try {
            $client = new Client();
            $client->setAuth(config('youkassa.shop_id'), config('youkassa.secret_key'));
            $response = $client->createRefund(
                array(
                    'amount' => array(
                        'value' => $ticket->price->price_value,
                        'currency' => 'RUB',
                    ),
                    'payment_id' => $ticket->order->youkassa_payment
                ),
                uniqid('', true)
            );
            return $response->getStatus() === 'succeeded';
        } catch (Exception $e) {
            abort(500);
        }
    }
}
