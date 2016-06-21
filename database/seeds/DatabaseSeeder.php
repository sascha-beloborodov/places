<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 200000) as $index) {
            DB::table('places')->insert([
                'name' => $faker->text(mt_rand(5, 80)),
                'description' => $faker->text(mt_rand(50, 300)),
                'address' => $faker->text(mt_rand(20, 150)),
                'longitude' => $faker->randomFloat(6, -180, 180),
                'latitude' => $faker->randomFloat(6, -90, 90)
            ]);
        }
        
//        Model::unguard();

        // $this->call(UserTableSeeder::class);

//        Model::reguard();
    }
}
