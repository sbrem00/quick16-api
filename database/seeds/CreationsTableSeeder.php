<?php

use Illuminate\Database\Seeder;
use App\Creation;

class CreationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Creation::truncate();

        $faker = \Faker\Factory::create();


        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Creation::create([
                'title' => $faker->sentence,
                'body' => $faker->paragraph,
                'type' => 'bar',
                'user_id' => $faker->numberBetween(0, 10)
            ]);
        }
    }
}
