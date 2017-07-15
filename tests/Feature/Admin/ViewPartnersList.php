<?php

namespace Tests\Feature\Admin;

use App\Partner;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewPartnersList extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function admins_can_see_the_list_of_partners()
    {
        // Create three partners.
        $partnerA = factory(Partner::class)->create(['name' => 'Boucherie Sanzot']);
        $partnerB = factory(Partner::class)->create(['name' => 'Du côté de chez Poje']);
        $partnerC = factory(Partner::class)->create(['name' => 'Poissonnerie Ordralfabétix']);

        $response = $this->get('/gestion/partners');

        // Check if the created partners are listed on the page.
        $response->assertSeeText($partnerA->name);
        $response->assertSeeText($partnerB->name);
        $response->assertSeeText($partnerC->name);
    }
}
