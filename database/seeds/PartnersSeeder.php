<?php

use App\Team;
use App\Email;
use App\Phone;
use App\Partner;
use App\Location;
use Carbon\Carbon;
use App\PostalAddress;
use App\SocialNetwork;
use App\CurrencyExchange;
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
        // Get the list of teams. It will be used to map the IDs from
        // the team names that are stored in the source JSON file.
        $teams = Team::all()->pluck('id', 'name');

        // The source file containing the data to seed.
        $sourceFile = database_path('/seeds/data/partners.json');

        // Loop on all the partners.
        foreach (JsonPartnerLoader::load($sourceFile) as $data) {

            // Create the partner
            // ------------------

            // Partners with a `joined_on` date before the launch
            // date are considered to have been validated the
            // same day the joined the network.
            if (
                !isset($data['validated_at']) &&
                Carbon::parse($data['joined_on'])->lessThanOrEqualTo(
                    Carbon::parse('2017-10-21')
                )
            ) {
                $data['validated_at'] = $data['joined_on'];
            }
            // If `joined_on` is null, we set the validation date to
            // on the launch date.
            elseif (
                !isset($data['validated_at']) &&
                !isset($data['joined_on'])
            ) {
                $data['validated_at'] = '2017-10-21';
            }

            $partner = Partner::create([
                'name' => $data['name'],
                'name_sort' => $data['name_sort'],
                'business_type' => $data['business_type'],
                'joined_on' => $data['joined_on'],
                'left_on' => $data['left_on'],
                'validated_at' => $data['validated_at'] ?? null,
                'team_id' => $teams[$data['region']] ?? null,
            ]);


            // Add private contact details of the partner
            // ------------------------------------------

            // E-mail.
            $this->addEmail($partner, array_get($data, 'contact_details.email'));

            // Phone number(s).
            if ($phone = array_get($data, 'contact_details.phone')) {

                // The partner has only one phone number.
                $partner->phones()->save(Phone::fromNumber($phone));

            } elseif ($phones = array_get($data, 'contact_details.phones')) {

                // The partner has multiple phone numbers.
                foreach ($phones as $phoneData) {
                    $partner->phones()->save(
                        Phone::fromNumber($phoneData['number'])
                            ->withLabel($phoneData['label'])
                    );
                }
            }

            // Postal address.
            // Ensure that the necessary address parts are present.
            if (
                ($address = array_get($data, 'contact_details.address')) &&
                $address['street'] && $address['street_number'] &&
                $address['postal_code'] && $address['city']
            ) {
                $partner->postalAddress()->save(
                    PostalAddress::fromArray([
                        'recipient' => $partner['name'],
                        'street' => $address['street'],
                        'street_number' => $address['street_number'],
                        // 'letter_box' => null,
                        'postal_code' => $address['postal_code'],
                        'city' => $address['city'],
                    ])
                );
            }


            // Add one or more location(s) for the partner
            // -------------------------------------------

            $addresses = array_get($data, 'public_contact_details.addresses');

            if (!$addresses) {
                $addresses = [array_get($data, 'public_contact_details.address')];
            }

            foreach ($addresses as $address) {

                // Skip incomplete addresses.
                if (
                    !$address ||
                    !$address['street'] || !$address['street_number'] ||
                    !$address['postal_code'] || !$address['city']
                ) {
                    continue;
                }

                // Create and save a location. The current address
                // will then be linked to this location.
                $location = new Location(['name' => $partner->name]);

                $partner->locations()->save($location);

                // Save the address of the location.
                $location->postalAddress()->save(
                    PostalAddress::fromArray([
                        'recipient' => $partner['name'],
                        'street' => $address['street'],
                        'street_number' => $address['street_number'],
                        // 'letter_box' => null,
                        'postal_code' => $address['postal_code'],
                        'city' => $address['city'],
                    ])
                    // The address of a public location is always public.
                    ->makePublic()
                );

                // If a phone number is associated to the address,
                // we add it to the location too.
                if (!empty($address['phone'])) {
                    $location->phones()->save(
                        Phone::fromNumber($address['phone'])->makePublic()
                    );
                }

                // Add (maybe) a currency exchange for the location
                // ------------------------------------------------
                if ($data['is_currency_exchange']) {
                    $location->currencyExchange()->save(new CurrencyExchange);
                }
            }


            // Add general public contact details of the partner
            // -------------------------------------------------

            // E-mail.
            $this->addEmail(
                $partner,
                array_get($data, 'public_contact_details.email'),
                $isPublic = true
            );

            // Phone number(s).
            if ($phone = array_get($data, 'public_contact_details.phone')) {

                // If there is only one phone number.
                $partner->phones()->save(Phone::fromNumber($phone)->makePublic());

            } elseif ($phones = array_get($data, 'public_contact_details.phones')) {

                // If there are multiple phone numbers.
                foreach ($phones as $phoneData) {
                    $partner->phones()->save(
                        Phone::fromNumber($phoneData['number'])
                            ->withLabel($phoneData['label'])
                            ->makePublic()
                    );
                }
            }

            // Social network(s).
            if ($networks = array_get($data, 'public_contact_details.social_networks')) {

                foreach ($networks as $networkData) {
                    $network = new SocialNetwork;
                    $network->name = $networkData['type'];
                    $network->handle = $networkData['handle'];
                    $network->label = $networkData['label'];
                    $network->makePublic();

                    $partner->socialNetworks()->save($network);
                }
            }

            // Create representatives for the partner
            // --------------------------------------
            $this->addRepresentatives($partner, $data['representatives']);
        }
    }

    /**
     * Create one or more representatives for a given partner.
     *
     * @param \App\Partner  $partner
     * @param array  $reps
     */
    protected function addRepresentatives(Partner $partner, $reps)
    {
        foreach ($reps as $rep) {

            // Skip empty representatives (without given name nor surname).
            if (!$rep['given_name'] && !$rep['surname']) {
                continue;
            }

            $representative = PartnerRepresentative::make([
                'given_name' => $rep['given_name'],
                'surname' => $rep['surname'],
                'role' => $rep['role']
            ]);

            $partner->representatives()->save($representative);

            // Add a phone number for the representative if there is one.
            if ($rep['contact_details']['phone']) {
                $representative->phones()->save(
                    Phone::fromNumber($rep['contact_details']['phone'])
                );
            }

            // Add an e-mail address for the representative if there is one.
            if (!empty($rep['contact_details']['email'])) {
                $this->addEmail($representative, $rep['contact_details']['email']);
            }
        }
    }

    /**
     * Associate an e-mail address with a given model.
     *
     * @param \Illuminate\Database\Eloquent\Model  $model
     * @param string  $address
     * @param bool    $isPublic
     */
    protected function addEmail($model, $address, $isPublic = false)
    {
        if (!$address) {
            return;
        }

        $email = Email::fromAddress($address);
        $email->isPublic = (bool) $isPublic;

        $model->emails()->save($email);
    }
}
