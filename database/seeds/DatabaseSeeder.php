<?php

use Illuminate\Database\Seeder;

use App\model\User;
use App\model\Page;
use App\model\Group;
use App\model\Item;
use App\model\UserGroup;
use App\model\PageGroup;
use App\model\ItemGroup;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
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

        $users_model = User::all();
        $groups_model = Group::all();
        $items_model = Item::all();
        $pages_model = Page::all();

        for($i = 0; $i <= 250; $i++) {
            $rand_user = rand(0, $users_model->count() - 1);
            $rand_group = rand(0, $groups_model->count() - 1);
            $rand_item = rand(0, $items_model->count() - 1);
            $rand_page = rand(0, $pages_model->count() - 1);


            factory( UserGroup::class, 1)->create([
                'user_id' => $users_model[$rand_user],
                'group_id' => $groups_model[$rand_group],
            ]);

            factory( PageGroup::class, 1)->create([
                'page_id' => $pages_model[$rand_page],
                'group_id' => $groups_model[$rand_group],
            ]);

            factory( ItemGroup::class, 1)->create([
                'item_id' => $items_model[$rand_item],
                'group_id' => $groups_model[$rand_group],
            ]);
        }




    }
}
