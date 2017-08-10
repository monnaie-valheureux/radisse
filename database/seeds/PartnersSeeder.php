<?php

use App\Partner;
use App\JsonPartnerLoader;
use App\PartnerRepresentative;
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

        // Loop on all the partners.
        foreach (JsonPartnerLoader::load($sourceFile) as $partner) {

            $representatives = [];

            // Loop on all the representatives of each partner.
            foreach ($partner['representatives'] as $rep) {

                // Skip empty representatives.
                if (!$rep['given_name'] && !$rep['surname']) {
                    continue;
                }

                $representatives[] = PartnerRepresentative::make([
                    'given_name' => $rep['given_name'],
                    'surname' => $rep['surname'],
                    'role' => $rep['role'],
                    'phone' => $rep['contact_details']['phone'],
                ]);
            }

            // Create the partner in the database.
            $partner = Partner::create([
                'name' => $partner['name'],
                'name_sort' => $partner['name_sort'],
                'business_type' => $partner['business_type'],
            ])
            // Then, create its representative(s).
            ->representatives()->saveMany($representatives);
        }
    }
}
