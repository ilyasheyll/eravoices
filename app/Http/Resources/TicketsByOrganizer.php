<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketsByOrganizer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'father_name' => $this->father_name,
            'count_tickets' => $this->count_tickets,
            'price_sum' => $this->price_sum
        ];
    }
}
