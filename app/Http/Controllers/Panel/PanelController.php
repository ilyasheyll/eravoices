<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function index() {
        $this->authorize('view-panel');
        $user = Auth::user();
        if ($user->role === User::ROLE_ORGANIZER) {
            return redirect()->route('panel.organizer-info');
        }

        if ($user->role === User::ROLE_MANAGER) {
            return redirect()->route('panel.banners.index');
        }

        if ($user->role === User::ROLE_ADMIN) {
            return redirect()->route('panel.stats.index');
        }
    }
}
