<?php

namespace App\Actions\Organizer;

use App\Models\OrganizationDetail;
use App\Models\Organizer;
use App\Models\PersonDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateOrganizerAction
{
    public function handle(array $organizerData): Organizer
    {
        try {
            DB::beginTransaction();
            $isUrPerson = $organizerData['type'] === Organizer::UR_PERSON;
            $userId = Auth::user()->id;
            $organizerData['inn'] = $isUrPerson ? $organizerData['ur_inn'] : $organizerData['fiz_inn'];
            $organizerData['user_id'] = $userId;
            $organizerData['deleted_at'] = null;
            $organizer = Organizer::updateOrCreate(
                ['user_id' => $userId],
                $organizerData
            );

            if ($isUrPerson) {
                $organizer->organizationDetail()->updateOrCreate(
                    ['organizer_id' => $organizer->id],
                    $organizerData
                );
            }

            DB::commit();
            return $organizer;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, $exception->getMessage());
        }
    }
}
