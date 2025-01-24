<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class EventFilter extends AbstractFilter
{
    public const NAME = 'name';
    public const START_DATE = 'start_date';
    public const END_DATE = 'end_date';
    public const MIN_PRICE = 'min_price';
    public const MAX_PRICE = 'max_price';
    public const CATEGORY_ID = 'category_id';
    public const EVENT_STATUS_ID = 'event_status_id';

    protected function getCallbacks(): array {
        return [
            self::NAME => [$this, 'name'],
            self::START_DATE => [$this, 'startDate'],
            self::END_DATE => [$this, 'endDate'],
            self::MIN_PRICE => [$this, 'minPrice'],
            self::MAX_PRICE => [$this, 'maxPrice'],
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::EVENT_STATUS_ID => [$this, 'eventStatusId'],
        ];
    }

    public function name(Builder $builder, $value) {
        $builder->where('name', 'like', "%$value%");
    }

    public function startDate(Builder $builder, $value) {
        $builder->where('date', '>=', "$value");
    }

    public function endDate(Builder $builder, $value) {
        $builder->where('date', '<=', "$value");
    }

    public function minPrice(Builder $builder, $value) {
        $builder->whereRaw("EXISTS (SELECT 1 FROM prices WHERE events.id = prices.event_id AND prices.price_value >= ?)", [$value]);
    }

    public function maxPrice(Builder $builder, $value) {
        $builder->whereRaw("EXISTS (SELECT 1 FROM prices WHERE events.id = prices.event_id AND prices.price_value <= ?)", [$value]);
    }

    public function categoryId(Builder $builder, $value) {
        $builder->where('category_id', $value);
    }

    public function eventStatusId(Builder $builder, $value) {
        $builder->where('event_status_id', $value);
    }
}
