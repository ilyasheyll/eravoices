<?php

namespace App\Actions;

use App\Models\Order;
use Exception;
use YooKassa\Client;

class CreatePayment
{
    public function handle(Order $order) : string {
        try {
            $client = new Client();
            $client->setAuth(config('youkassa.shop_id'), config('youkassa.secret_key'));
            $response = $client->createPayment(
                array(
                    'amount' => array(
                        'value' => $order->price,
                        'currency' => 'RUB',
                    ),
                    'confirmation' => array(
                        'type' => 'redirect',
                        'return_url' => route('user.index'),
                    ),
                    'capture' => true,
                    'description' => "Заказ №{$order->id}",
                    'metadata' => [
                        'orderNumber' => $order->id,
                    ],
                ),
                uniqid('', true)
            );

            $order->update(['youkassa_payment' => $response->getId()]);
            $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();
            return $confirmationUrl;
        } catch (Exception $e) {
            abort(500);
        }
    }
}
