<?php

namespace App\Http\Controllers\Panel\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    public function index() {
        $user = Auth::user();
        $organizer = $user->organizer;
        return view('panel.organizer.index', compact('user', 'organizer'));
    }
}
