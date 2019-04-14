<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use MailerLiteApi\MailerLite;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Allow people to subscribe to the newsletter.
 */
class NewsletterController extends Controller
{
    /**
     * Subscribe an e-mail address to the newsletter.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        // Instantiate a Guzzle client.
        $client = new GuzzleClient([
            'base_uri' => 'https://api.mailerlite.com/api/v2/',
            'headers' => [
                'X-MailerLite-ApiKey' => config('services.mailerlite.key'),
                'Content-Type' => 'application/json',
            ],
        ]);

        // Get the existing groups of subscribers.
        $groups = json_decode($client->get('groups')->getBody());

        // Get the ID of the group of e-mail addresses that
        // is dedicated to newsletter subscriptions.
        $newsletterGroupID = collect($groups)->firstWhere('name', 'Newsletter')->id;

        // Then, subscribe the address that was submitted.
        $response = $client->post("groups/{$newsletterGroupID}/subscribers", [
            'json' => ['email' => $email = $request->get('email')],
        ]);

        // Finally, return a view saying that everything is OK.
        return view('public.subscribed-to-newsletter', compact('email'));
    }
}
