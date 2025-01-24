<?php

namespace App\Http\Controllers;

use App\Actions\ConfirmPayment;
use App\Actions\CreatePayment;
use App\Actions\Order\CreateOrderAction;
use App\Actions\Ticket\CheckValidTicketAction;
use App\Http\Requests\Order\OrderRequest;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use YooKassa\Client;
use YooKassa\Model\Notification\NotificationFactory;

class OrderController extends Controller
{
    public function store(OrderRequest $request, CreatePayment $paymentAction, CreateOrderAction $createOrderAction, CheckValidTicketAction $validAction)
    {
        $orderData = $request->validated();
        $order = $createOrderAction->handle($orderData);
        $confirmationUrl = $paymentAction->handle($order);
        return response()->json(['success' => true, 'confirmationUrl' => $confirmationUrl]);
    }

    public function update(Request $request, ConfirmPayment $confirmAction) {
        $data = $request->toArray();
        return $confirmAction->handle($data);
    }
}
