<?php

use App\Endroits;
use App\Media;
use App\Restaurants;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $reference = "RES-".$i."-RBT".$faker->buildingNumber;
            Endroits::create([
                'reference' => $reference,
                'name' => $faker->company,
                'description' => $faker->text(10),
                'adresse1' =>$faker->address,
                'adresse2' =>$faker->address,
                'email' => $faker->companyEmail,
                'telephone' => $faker->phoneNumber,
                'website' => $faker->url,
                'startTime' => $faker->time('H:i:s','now'),
                'endTime' => $faker->time('H:i:s','now'),
                'zipcode' => $faker->buildingNumber ,
                'longitude' => $faker->longitude,
                'latitude' => $faker->latitude,
                'categorie_id' =>2,
                'city_id' =>$faker->numberBetween(1,5),
                'user_id' => $faker->numberBetween(1,5),
            ]);
            Restaurants::create([
                'endroits_reference' => $reference,
                'type' => $faker->text(30),
                'specialite' => $faker->boolean(50),
                'prixCarte' => $faker->numberBetween(20,200),
                'prixMoyenne' => $faker->numberBetween(50,150)
            ]);

            for($j=0;$j<5;$j++){
                Media::create([
                    'endroits_reference' => $reference,
                    'path' => $faker->imageUrl(250, 250, 'cats', true, 'Faker', true),
                    'type' => 'image'
                ]);
            }
        }
    }
}
