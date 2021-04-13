<?php

use Illuminate\Database\Seeder;

use App\model\User;
use App\model\Page;
use App\model\Group;
use App\model\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $users = factory(User::class, 15)->create()->each(function ($u) {
            factory(Page::class, 1)->create()->each(function ($p) use ($u) {
                $groups = factory(Group::class, 5)->create();

                $u->groups()->saveMany($groups);
                $p->groups()->saveMany($groups);

                factory(Item::class, 5)->create([
                    'page_id' => $p->id,
                ]);

            });
        });




    }
}
