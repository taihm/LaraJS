<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-08-02 23:43:11
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataExcelTableSeeder extends Seeder
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
        	\App\Models\DataExcel::create([
                'name' => $faker->name,
                'content' => $faker->name,
                //{{SEEDER_NOT_DELETE_THIS_LINE}}
			]);
		}
    }
}
