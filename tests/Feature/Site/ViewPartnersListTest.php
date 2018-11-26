<?php

namespace Tests\Feature\Site;

use App\Partner;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ViewPartnersListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function dummy()
    {
        // Since all test cases in this class are currently disabled,
        // this dummy test is there only to prevent PHPUnit to issue
        // a warning about the class containing no test.
        $this->assertTrue(true);
    }

    /**
     * DISABLED TEST.
     */
    public function can_see_the_list_of_partners()
    {
        // Create three partners.
        $partnerA = factory(Partner::class)->create([
            'name_sort' => 'Sanzot (boucherie)',
        ]);
        $partnerB = factory(Partner::class)->create([
            'name_sort' => 'Du côté de chez Poje',
        ]);
        $partnerC = factory(Partner::class)->create([
            'name_sort' => 'Ordralfabétix (poissonnerie)',
        ]);

        $response = $this->get('/partenaires');

        // Check if the created partners are listed on the page.
        $response->assertSeeText($partnerA->name_sort);
        $response->assertSeeText($partnerB->name_sort);
        $response->assertSeeText($partnerC->name_sort);
    }

    /**
     * DISABLED TEST.
     */
    public function the_list_of_partners_contains_only_active_partners()
    {
        // Create two active partners.
        $activePartnerA = factory(Partner::class)->create([
            'name_sort' => 'Sanzot (boucherie)',
        ]);
        $activePartnerB = factory(Partner::class)->create([
            'name_sort' => 'Du côté de chez Poje',
        ]);
        // Then, create one former partner.
        $formerPartner = factory(Partner::class)->states('former')->create([
            'name_sort' => 'Ordralfabétix (poissonnerie)',
        ]);

        $response = $this->get('/partenaires');

        // Ensure that the active partners are listed on the page.
        $response->assertSeeText($activePartnerA->name_sort);
        $response->assertSeeText($activePartnerB->name_sort);

        // Ensure that the former partner is NOT listed on the page.
        $response->assertDontSeeText($formerPartner->name_sort);
    }

    /**
     * DISABLED TEST.
     */
    public function the_list_of_partners_contains_only_validated_partners()
    {
        // Create two validated partners.
        $validatedPartnerA = factory(Partner::class)->create([
            'name_sort' => 'Sanzot (boucherie)',
        ]);
        $validatedPartnerB = factory(Partner::class)->create([
            'name_sort' => 'Du côté de chez Poje',
        ]);
        // Then, create one partner that has not been validated.
        $nonvalidatedPartner = factory(Partner::class)->states('nonvalidated')->create([
            'name_sort' => 'Ordralfabétix (poissonnerie)',
        ]);

        $response = $this->get('/partenaires');

        // Ensure that the validated partners are listed on the page.
        $response->assertSeeText($validatedPartnerA->name_sort);
        $response->assertSeeText($validatedPartnerB->name_sort);

        // Ensure that the former partner is NOT listed on the page.
        $response->assertDontSeeText($nonvalidatedPartner->name_sort);
    }
}
