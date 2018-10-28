<?php

namespace App\Filters;

class ClientFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['name', 'country', 'tag', 'sort'];

    /**
     * Filter the query by a given name.
     *
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($name)
    {
        return $this->builder->where('name', 'like', '%'.$name.'%');
    }

    /**
     * Filter the query by a given country.
     *
     * @param  string  $country
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function country($country)
    {
        return $this->builder->where('country', $country);
    }

    /**
     * Filter the query by a given tag name.
     *
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function tag($name)
    {
        return $this->builder->whereHas('tags', function ($query) use ($name) {
            $query->where('name', $name);
        });
    }

    /**
     * Sort the query by a given client field.
     *
     * @param  string  $field
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function sort($field)
    {
        $direction = $field[0] === '-' ? 'desc' : 'asc';

        $field = ltrim($field, '-');

        return $this->builder->orderBy($field, $direction);
    }
}
