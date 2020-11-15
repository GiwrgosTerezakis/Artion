<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ApiFilter extends ModelFilter
{

    public function views($views)
    {

        return $this->where('views', $views);

    }

    public function year($year)
    {

        return $this->whereYear('date_posted', $year)->get();
    }

    public function numberPosts($numberPosts)
    {
        return $this->limit($numberPosts)->get();
    }
}
