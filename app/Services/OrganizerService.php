<?php

namespace App\Services;

use App\Models\Organizer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrganizerService
{
    public function approveOrganizer(Organizer $organizer)
    {
        try {
            DB::beginTransaction();
            User::find($organizer->user_id)->update(['role' => User::ROLE_ORGANIZER]);
            $organizer->update(['approved' => 1]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, $exception->getMessage());
        }
    }

    public function deleteOrganizer(Organizer $organizer)
    {
        try {
            DB::beginTransaction();
            User::find($organizer->user_id)->update(['role' => User::ROLE_USER]);
//            if ($organizer->type === Organizer::UR_PERSON) {
//                $organizer->organizationDetail->delete();
//            }
            $organizer->delete();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, $exception->getMessage());
        }
    }
}
