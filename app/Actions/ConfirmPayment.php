<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use YooKassa\Client;
use YooKassa\Model\Notification\NotificationFactory;

class ConfirmPayment
{
    public function handle(array $data): bool
    {
        try {
            $factory = new NotificationFactory();
            $notificationObject = $factory->factory($data);
            $responseObject = $notificationObject->getObject();

            $client = new Client();

            if (!$client->isNotificationIPTrusted($_SERVER['REMOTE_ADDR'])) {
                abort(400);
            }

            if ($notificationObject->getEvent() === \YooKassa\Model\Notification\NotificationEventType::PAYMENT_SUCCEEDED) {
                $payment_status = $data['object']['status'] ?? '';
                $payment_id = $data['object']['id'] ?? '';
                $payment_paid = $data['object']['paid'] ?? '';
                $payment_amount = $data['object']['amount']['value'] ?? '';
                $payment_order_id = $data['object']['metadata']['orderNumber'] ?? '';

                if ($payment_status == 'succeeded' && $payment_paid) {
                    $order = Order::find($payment_order_id);
                    if ($order->price == $payment_amount) {
                        DB::beginTransaction();
                        $order->update(['status' => 1]);
                        foreach ($order->tickets as $ticket) {
                            $ticket->update('status', Ticket::PAID_STATUS);
                        }
                        DB::commit();
                    }
                }
            }

            return true;
        } catch (\Exception $err) {
            Log::error($err->getMessage());
            abort(500);
        }
    }
}
