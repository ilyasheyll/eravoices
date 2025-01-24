<?php

namespace App\Http\Controllers\Panel\Manager;

use App\Http\Controllers\Controller;
use App\Http\Filters\OrganizerFilter;
use App\Http\Requests\Organizer\FilterRequest;
use App\Models\Organizer;
use App\Models\User;
use App\Services\OrganizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(OrganizerFilter::class, ['queryParams' => array_filter($data, 'strlen')]);
        $organizers = Organizer::filter($filter)->paginate(15);
        $organizerTypes = Organizer::getTypes();
        return view('panel.manager.organizer.index', compact(
            'organizers',
            'organizerTypes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $organizerId)
    {
        $organizer = Organizer::query()->with('events')->where('id', $organizerId)->firstOrFail();
        $organizerTypes = Organizer::getTypes();
        return view('panel.manager.organizer.show', compact('organizer', 'organizerTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organizer $organizer)
    {
        $organizerTypes = Organizer::getTypes();
        return view('panel.manager.organizer.edit', compact('organizer', 'organizerTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organizer $organizer, OrganizerService $organizerService)
    {
        $organizerService->approveOrganizer($organizer);
        return redirect()->route('panel.organizers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizer $organizer, OrganizerService $organizerService)
    {
        $organizerService->deleteOrganizer($organizer);
        return redirect()->route('panel.organizers.index');
    }
}
