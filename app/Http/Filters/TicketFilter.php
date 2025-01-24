<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class TicketFilter extends AbstractFilter
{
    public const NAME = 'event';
    public const START_DATE = 'start_date';
    public const END_DATE = 'end_date';
    public const STATUS = 'status';

    protected function getCallbacks(): array {
        return [
            self::NAME => [$this, 'name'],
            self::START_DATE => [$this, 'startDate'],
            self::END_DATE => [$this, 'endDate'],
            self::STATUS => [$this, 'status'],
        ];
    }

    public function name(Builder $builder, $value) {
        $builder
            ->whereRaw(
                "EXISTS (SELECT 1 FROM events INNER JOIN prices ON events.id = prices.event_id 
                    WHERE tickets.price_id = prices.id AND name LIKE ?)", 
                ['%'.$value.'%']
            );
    }

    public function startDate(Builder $builder, $value) {
        $builder->where('created_at', '>=', $value);
    }

    public function endDate(Builder $builder, $value) {
        $builder->where('created_at', '<=', $value);
    }

    public function status(Builder $builder, $value) {
        $builder->where('status', $value);
    }
}