<?php

// TODO: control access rights for each step.

namespace App\Http\Controllers\Admin;

use App\Email;
use App\Phone;
use App\Partner;
use App\Website;
use App\Location;
use DomainException;
use App\SocialNetwork;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\PartnerRepresentative;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Partner\StoreLocation;
use App\Http\Requests\Partner\StoreHeadOffice;
use App\Http\Requests\Partner\StoreRepresentatives;

/**
 * Handles registration of new partners of the currency.
 *
 * The flow goes like this:
 *
 * 1.  Introduction page.
 * 2.  Add the name (and optionally the type of business) of the partner.
 * 3.  Add the ‘sort name’.
 * 4.  Add contact details of the head office.
 * 5.  Choose whether a location should be linked to the partner.
 * ↳  IF TRUE and using the same address as for the head office:
 *     5a. Transparently create a location.
 * ↳  IF TRUE and using a different address:
 *     5b. Add contact details of a new location.
 * 6.  Add website(s) and social network(s).
 * 7.  Add a representative for the partner.
 * ↳  IF another representative has to be created, redirect to 7 ⤴
 * 8.  Upload official documents.
 * 9.  Summary of the data that has been added.
 */
class CreatePartnerController extends Controller
{
    protected $businessTypes = [
        'ASBL' => 'ASBL',
        'Indépendant·e en personne physique' => 'Indépendant·e en personne physique',
        'Indépendant·e complémentaire' => 'Indépendant·e complémentaire',
        'SA' => 'SA',
        'SASPJ' => 'SASPJ',
        'SCRL' => 'SCRL',
        'SCRLFS' => 'SCRLFS',
        'SNC' => 'SNC',
        'SPRL' => 'SPRL',
        'SPRLU' => 'SPRLU',
        'SMart' => 'Travail via SMart',
        'void' => 'Je ne sais pas',
    ];

    /**
     * Display the introduction to the tool.
     *
     * This is part of step 1.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function start()
    {
        // Ensure there is no draft partner stored in session.
        // session()->forget('draftPartner');

        return view('admin.partners.create.start');
    }

    /**
     * Get the form to set the name of the new partner.
     *
     * This is part of step 2.
     *
     * @param  \App\Partner|null  $partner
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function createPartnerName(Partner $partner = null)
    {
        // On the first time we access this page, no draft partner
        // will exist. But one will be there if we come back to
        // this page later. We try to retrieve a partner in
        // order to set correct values on form elements.
        $draftPartner = optional($partner);

        return view('admin.partners.create.partner-name', [
            'businessTypes' => $this->businessTypes,
            'draftPartner' => $draftPartner,
        ]);
    }

    /**
     * Save the name of the new partner.
     *
     * This is part of step 2.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePartnerName()
    {
        // Validate form data.
        $data = $this->validate(request(), [
            // Validation rules.
            'id' => 'nullable|integer',
            'name' => 'required|string',
            'business_type' => ['nullable', Rule::in(array_keys($this->businessTypes))]
        ], [
            // Errors messages.
            'name.required' => 'Vous devez indiquer le nom du partenaire.',
            // 'business_type.required' => 'Merci de choisir une catégorie.',
        ]);

        // If there is already a draft partner defined
        // update it. Otherwise create a new one.
        if ($data['id']) {
            $partner = Partner::find($data['id']);
            $partner->update($data);
        } else {
            $partner = (new Partner)->createAsDraft($data);

            // Once the partner is created, we assign it to
            // the team of the member who created it.
            $team = auth()->user()->team;
            $team->partners()->save($partner);
        }

        return redirect()->route('partners.add.sort-name', $partner);
    }

    /**
     * Get the form to set the ‘sort name’ of the new partner.
     *
     * This is part of step 3.
     *
     * @param  \App\Partner  $partner
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function createSortName(Partner $partner)
    {
        return view('admin.partners.create.sort-name', compact('partner'));
    }

    /**
     * Save the ‘sort name’ of the new partner.
     *
     * This is part of step 3.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSortName()
    {
        $partner = Partner::find(Input::get('id'));

        if (request()->has('submit')) {

            // Validate form data.
            $data = $this->validate(request(), [
                'name_sort' => 'required|string',
            ], [
                'name_sort.required' => 'Merci de choisir un nom de liste. Sinon, vous pouvez sauter cette étape et décider plus tard.',
            ]);

            $partner->update($data);
        }

        return redirect()->route('partners.add.head-office', $partner);
    }

    /**
     * Get the form to define the head office of the new partner.
     *
     * This is part of step 4.
     *
     * @param  \App\Partner  $partner
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function createHeadOffice(Partner $partner)
    {
        $address = $partner->postalAddress ?? optional();

        $phone = $partner->getHeadOfficePhone() ?? optional();
        $phone_is_public = $phone->isPublic;

        $email = $partner->getHeadOfficeEmail() ?? optional();
        $email_is_public = $email->isPublic;

        return view(
            'admin.partners.create.head-office',
            compact(
                'partner',
                'address',
                'phone', 'phone_is_public',
                'email', 'email_is_public'
            )
        );
    }

    /**
     * Save information on the head office of the new partner.
     *
     * This is part of step 4.
     *
     * @param  \App\Http\Requests\Partner\StoreHeadOffice  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeHeadOffice(StoreHeadOffice $request)
    {
        $partner = Partner::find(Input::get('id'));

        if ($request->has('submit')) {

            // Set the address of the head office.
            $partner->setHeadOfficeAddress($request->only([
                'street',
                'street_number',
                'postal_code',
                'city'
            ]));

            // $request->session()->flash(
            //     'foo.update-address',
            //     [
            //         'message' => 'L’adresse postale du siège social a été mise à jour.',
            //         'change' => 'update'
            //     ]
            // );

            // Set or remove a phone number for the head office.
            if ($request->filled('phone')) {
                $partner->setHeadOfficePhone(
                    $request->get('phone'),
                    $request->filled('phone_is_public')
                );

                // $request->session()->flash(
                //     'foo.update-phone',
                //     [
                //         'message' => 'Le numéro de téléphone du siège social a été mis à jour.',
                //         'change' => 'update'
                //     ]
                // );
            } else {
                $partner->removeHeadOfficePhone();

                // $request->session()->flash(
                //     'foo.delete-phone',
                //     [
                //         'message' => 'Le numéro de téléphone du siège social a été supprimé',
                //         'change' => 'delete'
                //     ]
                // );
            }

            // Set or remove an e-mail address for the head office.
            if ($request->filled('email')) {
                $partner->setHeadOfficeEmail(
                    $request->get('email'),
                    $request->filled('email_is_public')
                );

                // $request->session()->flash(
                //     'foo.update-email',
                //     [
                //         'message' => 'L’adresse e-mail du siège social a été mise à jour.',
                //         'change' => 'update'
                //     ]
                // );
            } else {
                $partner->removeHeadOfficeEmail();

                // $request->session()->flash(
                //     'foo.delete-phone',
                //     [
                //         'message' => 'L’adresse e-mail du siège social a été supprimée.',
                //         'change' => 'delete'
                //     ]
                // );
            }
        }

        return redirect()->route('partners.add.question-location', $partner);
    }

    public function askQuestionLocation(Partner $partner)
    {
        // If the partner already has a location, we will
        // redirect to the page of that location.
        if ($partner->locations->isNotEmpty()) {
            return redirect()->route('partners.add.location', $partner);
        }

        // Check if an address has been defined for the head office.
        $hasHeadOfficeAddress = !is_null($partner->getHeadOfficeAddress());

        return view(
            'admin.partners.create/question-location',
            compact('partner', 'hasHeadOfficeAddress')
        );
    }

    public function questionLocation(Partner $partner, Request $request)
    {
        if ($request->has('submit-location-in-head-office')) {
            dd('Oui, à la même adresse qu’au siège social');
        }

        return redirect()->route('partners.add.location', $partner);

        // return view(
            // 'admin.partners.create.location',
            // compact(
                // 'partner'//,
                // 'address',
                // 'phone', 'phone_is_public',
                // 'email', 'email_is_public'
            // )
        // );
    }

    /**
     * Get the form to add a location for the new partner.
     *
     * This is part of step 5.
     *
     * @param  \App\Partner  $partner
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function createLocation(Partner $partner)
    {
        $location = optional($partner->locations->last());

        $location_name = $location->name;

        $address = $location->postalAddress ?? optional();

        $phone = optional(optional($location->phones)->last());

        return view(
            'admin.partners.create.location',
            compact(
                'partner',
                'location_name',
                'address',
                'phone'
            )
        );
    }

    /**
     * Save information of a location of the new partner.
     *
     * This is part of step 5b.
     *
     * @param  \App\Http\Requests\Partner\StoreLocation  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLocation(StoreLocation $request)
    {
        $partner = Partner::find(Input::get('id'));

        if ($request->has('submit')) {

            $locationName = $request->get('location_name');

            // First, we need to get the location or create
            // a new one if it does not exist yet.
            $location = $partner->locations->first(
                function ($location) use ($locationName) {
                    return $location->name === $locationName;
                }
            );

            if (is_null($location)) {
                $location = new Location(['name' => $partner->name]);
                $partner->locations()->save($location);
            }

            // Set the address of the head office.
            $location->setPostalAddress(
                $locationName,
                $request->only([
                    'street',
                    'street_number',
                    'postal_code',
                    'city'
                ])
            );

            // Set or remove a phone number for the head office.
            if ($request->filled('phone')) {

                // First, we need to get a phone model or
                // create a new one if none exist yet.
                $phone = optional($location->phones)->last();

                if ($phone) {
                    $phone->number = $request->get('phone');
                    $phone->save();
                } else {
                    $phone = Phone::fromNumber($request->get('phone'))->makePublic();
                    $location->phones()->save($phone);
                }

            } else {
                // Retrieve the last phone number of the location, if one exists.
                $phone = optional($location->phones)->last();

                if ($phone) {
                    $phone->delete();
                }
            }
        }

        return redirect()->route('partners.add.site-and-social-networks', $partner);
    }

    /**
     * Get the form to add one or more websites and social networks.
     *
     * This is part of step 6.
     *
     * @param  \App\Partner  $partner
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function createSiteAndSocialNetworks(Partner $partner)
    {
        $socialNetworks = $partner->socialNetworks ?? collect();
        $websites = $partner->websites ?? collect();

        return view(
            'admin.partners.create.site-and-social-networks',
            compact(
                'partner',
                'socialNetworks',
                'websites'
            )
        );
    }

    /**
     * Save information of websites and social networks.
     *
     * This is part of step 6.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSiteAndSocialNetworks(Request $request)
    {
        $partner = Partner::find(Input::get('id'));

        if ($request->has('submit')) {

            // Validate form data.
            $data = $this->validate($request, [
                'websites.*.url' => 'nullable|string',
                'social_networks.*.url' => [
                    'nullable',
                    'string',
                    function($attribute, $value, $fail) {
                        try {
                            SocialNetwork::fromUrl($value);
                        } catch (DomainException $e) {
                            return $fail('Impossible de reconnaître ce réseau social…');
                        }
                    }
                ],
            ], [
                'websites.*.url' => 'Cette adresse semble incorrecte.',
                'social_networks.*.url' => 'Cette adresse semble incorrecte.',
            ]);

            // Do it the lazy way: delete everything and then rewrite
            // everything. Note that this ‘wastes’ IDs in the database.
            foreach ($partner->socialNetworks as $network) {
                $network->delete();
            }

            foreach ($request->get('social_networks') as $network) {
                if (!$network['url']) {
                    continue;
                }

                $network = SocialNetwork::fromUrl($network['url'])->makePublic();
                $partner->socialNetworks()->save($network);
            }

            // Do it the lazy way: delete everything and then rewrite
            // everything. Note that this ‘wastes’ IDs in the database.
            foreach ($partner->websites as $website) {
                $website->delete();
            }

            foreach ($request->get('websites') as $website) {
                if (!$website['url']) {
                    continue;
                }

                $website = Website::fromUrl($website['url'])->makePublic();
                $partner->websites()->save($website);
            }
        }

        return redirect()->route('partners.add.representative', $partner);
    }

    /**
     * Get the form to set representatives for the partner.
     *
     * This is part of step 7.
     *
     * @param  \App\Partner  $partner
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function createRepresentatives(Partner $partner)
    {
        $representatives = $partner->representatives;

        // Eager-load relationships of the representatives.
        $representatives->load('emails', 'phones');

        // Create ‘shortcuts’ for easy access in the Blade view.
        foreach ($representatives as $rep) {
            $rep->email = $rep->emails->last();
            $rep->phone = $rep->phones->last();
        }

        return view(
            'admin.partners.create.representatives',
            compact(
                'partner',
                'representatives'
            )
        );
    }

    /**
     * Save information of representatives of the partner.
     *
     * This is part of step 7.
     *
     * @param  \App\Http\Requests\Partner\StoreRepresentatives  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRepresentatives(StoreRepresentatives $request)
    {
        $partner = Partner::find(Input::get('id'));

        if ($request->has('submit')) {
            // Do it the lazy way: delete everything and then rewrite
            // everything. Note that this ‘wastes’ IDs in the database.
            foreach ($partner->representatives as $rep) {
                // First, we delete the emails and phones of the representative
                // and, once it’s done, we then remove the person itself.
                foreach ($rep->emails as $email) {
                    $email->delete();
                }
                foreach ($rep->phones as $phone) {
                    $phone->delete();
                }
                $rep->delete();
            }

            foreach ($request->get('representatives') as $i => $rep) {
                // If the current person has no given name, we skip it.
                // It should mean that all of her values are null.
                if (!$rep['given_name']) {
                    continue;
                }
                var_dump($rep);

                $representative = PartnerRepresentative::fromFullNameAndRole(
                    $rep['given_name'],
                    $rep['surname'],
                    $rep['role']
                );
                $partner->representatives()->save($representative);

                if ($rep['email']) {
                    $representative->emails()->save(Email::fromAddress($rep['email']));
                }
                if ($rep['phone']) {
                    $representative->phones()->save(Phone::fromNumber($rep['phone']));
                }
            }
        }

        return redirect()->route('partners.add.summary', $partner);
    }

    public function summary(Partner $partner)
    {
        $summary = [];

        // We gather all the important pieces of info we have about the partner.

        $summary['name'] = $partner->name;
        $summary['name_sort'] = $partner->name_sort;
        $summary['business_type'] = $partner->business_type;

        // Get head office info.
        $summary['head_office'] = [
            'address' => $partner->postalAddress,
            'phone' =>  $partner->getHeadOfficePhone(),
            'phone_is_public' => optional($partner->getHeadOfficePhone())->isPublic,
            'email' =>  $partner->getHeadOfficeEmail(),
            'email_is_public' => optional($partner->getHeadOfficeEmail())->isPublic,
        ];

        // Get public locations.
        $summary['locations'] = [];

        foreach ($partner->locations as $location) {
            $summary['locations'][] = [
                'name' => $location->name,
                'address' => $location->postalAddress,
                'phone' => optional($location->phones)->last(),
            ];
        }

        // Get websites.
        $summary['websites'] = $partner->websites;

        // Get social networks.
        $summary['social_networks'] = $partner->socialNetworks;

        // Get representatives.
        $representatives = $partner->representatives;
        $representatives->load('emails', 'phones');

        // Create ‘shortcuts’ for easy access in the Blade view.
        foreach ($representatives as $rep) {
            $rep->email = $rep->emails->last();
            $rep->phone = $rep->phones->last();
        }

        $summary['representatives'] = $representatives;

        return view(
            'admin.partners.create.summary',
            compact('partner', 'summary')
        );
    }


    public function validatePartner(Partner $partner)
    {
        $partner->validateBy(auth()->user());

        return redirect()->route('partner.add.end', $partner);
    }

    public function end(Partner $partner)
    {
        return view(
            'admin.partners.create.end',
            compact('partner')
        );
    }
}
