<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrganizerFilter extends AbstractFilter
{
    public const TYPE = 'type';
    public const APPROVED = 'approved';

    protected function getCallbacks(): array {
        return [
            self::TYPE => [$this, 'type'],
            self::APPROVED => [$this, 'approved'],
        ];
    }

    public function type(Builder $builder, $value) {
        $builder->where('type', $value);
    }

    public function approved(Builder $builder, $value) {
        $builder->where('approved', $value);
    }
}