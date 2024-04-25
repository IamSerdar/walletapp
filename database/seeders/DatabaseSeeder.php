<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Garden\Entities\Garden;
use Modules\Group\Database\Seeders\GroupActivitiesSeeder;
use Modules\Group\Database\Seeders\GroupDatabaseSeeder;
use Modules\Group\Database\Seeders\GroupLessonsSeeder;
use Modules\Group\Database\Seeders\GroupMealsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
        ]);
    }
}
