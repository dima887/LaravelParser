<?php


namespace App\Filters;


class ApartmentFilter extends QueryFilter
{
    public function apartment_filter($filter = null)
    {
        if ($filter == null) {
            return $this->builder->orderBy('id');
        }
        if ($filter == 'priceUp')
        {
            return $this->builder->orderByDesc('price');
        }
        if ($filter == 'roomUp')
        {
            return $this->builder->orderByDesc('room');
        }
        return $this->builder->orderBy($filter);
    }
}
