<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => ['required', 'numeric', 'exists:events,id']
        ]);

        $data['user_id'] = Auth::user()->id;
        Favorite::create($data);
        return back();
    }

    public function destroy(Favorite $favorite)
    {
        $this->authorize('destroy-favorite', $favorite);
        $favorite->delete();
        return back();
    }
}
