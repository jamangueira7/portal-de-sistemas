<?php

namespace App\Repositories;

use App\Model\Page;

class PagesRepository {
    public function getAll()
    {
        return Page::paginate(10);
    }

    public function getById($id)
    {
        return Page::find($id);
    }

    public function update($id, $data)
    {

        $response = Page::find($id)->update([
            'description' => $data['description'],
        ]);

        return $response;
    }

    public function create($data)
    {

        $response = Page::create([
            'description' => $data['description']
        ]);

        return $response;
    }

    public function destroy($id)
    {
        $response = Page::find($id)->delete();

        return $response;
    }
}
