<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Event;
use App\Models\EventStatus;
use App\Models\Price;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use chillerlan\QRCode\QRCode;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $banners = Banner::query()
            ->where('active', 1)
            ->orderBy('created_at', 'asc')
            ->get();
        $events = Event::query()
            ->with('prices')
            ->where('event_status_id', EventStatus::ACTIVE_STATUS)
            ->orderBy('date', 'asc')
            ->paginate(16);

        return view('index', compact('events', 'banners'));
    }
}
