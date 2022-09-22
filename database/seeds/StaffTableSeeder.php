<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-23 00:15:42
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
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
        	\App\Models\Staff::create([
                'building_id' => $faker->numberBetween(1000, 9000),
                'user_id' => $faker->numberBetween(1000, 9000),
                'staff_position_id' => $faker->numberBetween(1000, 9000),
                'status' => $faker->numberBetween(1000, 9000),
                //{{SEEDER_NOT_DELETE_THIS_LINE}}
			]);
		}
    }
}
