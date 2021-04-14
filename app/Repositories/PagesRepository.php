<?php

namespace App\Repositories;

use App\Model\Page;

class PagesRepository {
    public function getAll()
    {
        return Page::all();
    }
}
