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
        foreach (JsonPartnerLoader::load($sourceFile) as $data) {

            // Create the partner in the database.
            $partner = Partner::create([
                'name' => $data['name'],
                'name_sort' => $data['name_sort'],
                'business_type' => $data['business_type'],
            ]);

            $this->addRepresentatives($partner, $data['representatives']);
        }
    }

    protected function addRepresentatives(Partner $partner, $reps)
    {
        foreach ($reps as $rep) {

            // Skip empty representatives.
            if (!$rep['given_name'] && !$rep['surname']) {
                continue;
            }

            $representative = PartnerRepresentative::make([
                'given_name' => $rep['given_name'],
                'surname' => $rep['surname'],
                'role' => $rep['role'],
                'phone' => $rep['contact_details']['phone'],
            ]);

            $partner->representatives()->save($representative);
        }
    }
}
