<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-23 01:00:48
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupportServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++){
        	\App\Models\SupportService::create([
                'name' => $faker->name,
                'description' => $faker->name,
                'fee' => $faker->randomFloat(2, 1000, 9000),
                //{{SEEDER_NOT_DELETE_THIS_LINE}}
			]);
		}
    }
}
