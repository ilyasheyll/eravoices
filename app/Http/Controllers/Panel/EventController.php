<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Filters\EventFilter;
use App\Http\Requests\Event\EventRequest;
use App\Http\Requests\Event\FilterRequest;
use App\Models\Category;
use App\Models\DefaultPercent;
use App\Models\Event;
use App\Models\EventStatus;
use App\Models\Price;
use App\Models\Zone;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request) {
//        dd(Event::find(1)->organizerPercent);
        $data = $request->validated();
        $filter = app()->make(EventFilter::class, ['queryParams' => array_filter($data, 'strlen')]);
        $eventsBuilder = Event::filter($filter)->with('prices.tickets')->orderBy('updated_at', 'desc');
        if (Auth::user()->role == 'organizer') {
            $events = $eventsBuilder->where('organizer_id', Auth::user()->organizer->id)->get();
            return view('panel.organizer.event.index', compact('events'));
        }

        $events = $eventsBuilder->paginate(15);

        $eventStatuses = EventStatus::all();
        return view('panel.event.index', compact('events', 'eventStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $zones = Zone::all();
        $eventStatuses = EventStatus::all();
        return view('panel.event.create', compact('categories', 'zones', 'eventStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request, EventService $eventService)
    {
        $data = $request->validated();

        $data['date'] = $data['date'] . ' ' . $data['time'];
        $data['image'] = $request->file('image')->store('events', 'public');
        if (Auth::user()->role === 'organizer') {
            $data['organizer_id'] = Auth::user()->organizer->id;
        }

        $eventService->createEvent($data);
        return redirect()->route('panel.events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
//        $zones = Zone::all();
        return view('panel.organizer.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        $categories = Category::all();
        $eventStatuses = EventStatus::all();
        $defaultPercent = DefaultPercent::find(DefaultPercent::DEFAULT_PERCENT_ID)->value;
        return view('panel.event.edit', compact(
            'categories',
            'event',
            'eventStatuses',
            'defaultPercent'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event, EventService $eventService)
    {
        $this->authorize('update', $event);
        $data = $request->validated();
        if (
            (isset($data['event_status_id']) || isset($data['percent'])) &&
            !Gate::allows('set-manager-fields-for-events')
        ) {
            abort(403);
        }

        $data['date'] = $data['date'] . ' ' . $data['time'];
        if (isset($data['image'])) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $eventService->updateEvent($event, $data);
        return redirect()->route('panel.events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('update', $event);
//        if ($event->favorites->count() === 0 && $event->banners->count() === 0) {
//            foreach ($event->prices as $price) {
//                if ($price->tickets->count() > 0) {
//                    return redirect()->route('panel.events.index');
//                }
//            }
//
//            $event->delete();
//        }
        $event->delete();
        return redirect()->route('panel.events.index');
    }
}
