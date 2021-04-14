<?php

namespace App\Repositories;

use App\Model\Item;

class ItemsRepository {
    public function getAll()
    {
        return Item::all();
    }
}
