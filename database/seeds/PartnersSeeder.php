<?php

use App\Partner;
use App\JsonPartnerLoader;
use Illuminate\Database\Seeder;

class PartnersSeeder extends Seeder
{
    /**
     * Seed the database.
     *
     * @return void
     */
    public function run()
    {
        $sourceFile = database_path('/seeds/data/partners.json');

        foreach (JsonPartnerLoader::load($sourceFile) as $partner) {
            Partner::create([
                'name' => $partner['name'],
                'name_sort' => $partner['name_sort'],
                'business_type' => $partner['business_type'],
            ]);
        }
    }
}
