<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View {
        $user = Auth::user();
        $tickets = $user->tickets()
            ->with([
                'price' => ['zone', 'event'],
                'seat'
            ])
            ->where('status', '!=', Ticket::NEW_STATUS)
            ->orderBy('created_at', 'desc')
            ->get();

        $favorites = $user->favorites()->with('event.prices')->get();

        return view('user.index', compact('tickets', 'user', 'favorites'));
    }
}
