<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use MailerLiteApi\MailerLite;
use App\Http\Controllers\Controller;

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
        // Instantiate a MailerLite client.
        $mailerLiteClient = new MailerLite(config('services.mailerlite.key'));

        // Get the ID of the group of e-mail addresses that
        // is dedicated to newsletter subscriptions.
        $groups = $mailerLiteClient->groups()->get();

        $newsletterGroupID = collect($groups)->firstWhere('name', 'Newsletter')->id;

        // Then, subscribe the address that was submitted.
        $return = $mailerLiteClient->groups()->addSubscriber(
            $newsletterGroupID,
            ['email' => $email = $request->get('email')]
        );

        // Finally, return a view saying that everything is OK.
        return view('public.subscribed-to-newsletter', compact('email'));
    }
}
