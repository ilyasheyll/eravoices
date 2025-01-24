<?php

namespace App\Http\Controllers;

use App\Http\Filters\EventFilter;
use App\Http\Requests\Event\FilterRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventStatus;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\Zone;
use YooKassa\Client;

class EventController extends Controller
{
    public function index(FilterRequest $request) {
        $data = $request->validated();
        $categories = Category::all();
        $filter = app()->make(EventFilter::class, ['queryParams' => array_filter($data, 'strlen')]);
        $events = Event::filter($filter)
            ->with('prices')
            ->where('event_status_id', EventStatus::ACTIVE_STATUS)
            ->orderBy('date')
            ->paginate(15);
        return view('event.index', compact('events', 'categories'));
    }

    public function show(int $id) {
        $event = Event::query()
            ->where('id', $id)
            ->whereIn('event_status_id', [EventStatus::ACTIVE_STATUS, EventStatus::FINISHED_STATUS])
            ->with('prices.zone')
            ->firstOrFail();
        return view('event.show', compact('event'));
    }
}
