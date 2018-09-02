<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Queries', 10)->create();
        factory('App\Contact',10)->create();
        factory('App\Courses', 10)
            ->create()
            ->each(function(App\Courses $course) {
                factory('App\Batches', 2)
                    ->create([
                        'course_id' => $course->id,
                    ]);
            });

    }
}
