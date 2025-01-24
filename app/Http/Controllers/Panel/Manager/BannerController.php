<?php

namespace App\Http\Controllers\Panel\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::query()->orderBy('updated_at', 'desc')->paginate(20);
        return view('panel.manager.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nextEvents = Event::query()->where('date', '>', Carbon::now())->get();
        return view('panel.manager.banners.create', compact('nextEvents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }
        $data['active'] = isset($data['active']);
        Banner::create($data);
        return redirect()->route('panel.banners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        $nextEvents = Event::query()->where('date', '>', Carbon::now())->get();
        return view('panel.manager.banners.edit', compact( 'nextEvents', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }
        $data['event_id'] = $data['event_id'] ?? null;
        $data['active'] = isset($data['active']);
        $banner->update($data);
        return redirect()->route('panel.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('panel.banners.index');
    }
}
