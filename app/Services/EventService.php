<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Price;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventService
{
    public function createEvent(array $data) : Event
    {
        try {
            DB::beginTransaction();
            $event = Event::create($data);
            foreach ($data['prices'] as $price) {
                $event->prices()->create($price);
            }
            DB::commit();

            return $event;
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }

    public function updateEvent(Event $event, array $data) : Event
    {
        try {
            DB::beginTransaction();
            $event->update($data);
            foreach ($data['prices'] as $priceId => $price) {
                $event->prices()->find($priceId)->update($price);
            }

            if (isset($data['percent'])) {
                $event->organizerPercent()->updateOrCreate(
                    ['event_id' => $event->id],
                    ['percent' => $data['percent']]
                );
            }

            DB::commit();

            return $event;
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }
}
