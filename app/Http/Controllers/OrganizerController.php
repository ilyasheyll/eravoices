<?php

namespace App\Http\Controllers;

use App\Actions\Organizer\CreateOrganizerAction;
use App\Http\Requests\OrganizersRequest;
use App\Models\OrganizationDetail;
use App\Models\Organizer;
use App\Models\PersonDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganizerController extends Controller
{
    public function index() {
        return view('organizer.index');
    }

    public function create() {
        return view('organizer.create');
    }

    public function store(OrganizersRequest $request, CreateOrganizerAction $createOrganizerAction): JsonResponse
    {
        $data = $request->validated();
        $organizer = $createOrganizerAction->handle($data);
        return response()->json(['success' => true]);
    }
}
