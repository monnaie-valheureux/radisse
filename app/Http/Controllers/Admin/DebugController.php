<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Debug\Dumper;

class DebugController extends Controller
{
    /**
     * Display the data of a given partner.
     *
     * If provided with a number, it will try to load the partner with that ID.
     * If a string has been given, it will search for matching partner slugs,
     * list the results, and display data for the first result.
     *
     * @param  int|string  $id
     *
     * @return void
     */
    public function debug($id)
    {
        // Ensure the person reaching this URL has the permission to do so.
        if (auth()->user()->cannot('debug partners')) {
            abort(404);
        }

        try {
            if (is_numeric($id)) {
                // If a number was provided, try to find a partner by ID.
                $partner = Partner::findOrFail($id);
            } else {
                // Otherwise, try a search via slug.
                $id = mb_strtolower($id);
                $results = Partner::where('slug', 'like', "%$id%")->get();

                if ($results && count($results) > 1) {
                    // Case 1: the search gave multiple results.
                    echo 'Found '.count($results).' partners for search “'.$id.'”:<br>';
                    echo '<ol>';
                    foreach ($results as $result) {
                        echo '<li><a href="/gestion/debug/'.$result->slug.'">'.
                            $result->name.
                        '</a></li>';
                    }
                    echo '</ol>';
                    echo 'Displaying first result.<br>';

                    $partner = $results->first();
                } elseif ($results && count($results) === 1) {
                    // Case 2: the search returned a single result.
                    echo 'Found one partner for search “'.$id.'”.<br>';
                    $partner = $results->first();
                } else {
                    // Case 3: the search returned nothing.
                    throw new Exception;
                }
            }
        } catch (\Exception $e) {
            $partners = Partner::orderBy('name')->get();

            echo "No partner with id or slug matching [$id].<br><br>";
            echo "Here is the full list (".count($partners)." entries):";

            echo '<ul>';
            foreach ($partners as $partner) {
                echo "<li>";
                echo "<a href=\"./{$partner->id}\">{$partner->name}</a>";
                echo "</li>";
            }
            echo '</ul>';
            exit;
        }

        $dumper = new Dumper;
?>
<style>
    body {
        font-size: 12px;
    }
    h1, h2, h3, h4 {
        margin-top: 0;
    }
    .block, .vblock {
        margin-bottom: 1em;
        padding: 1em;
        overflow: auto;
    }
    .vblock {
        border: 1px solid gray;
    }
    .fblock {
        display: flex;
        flex-wrap: wrap;
    }
    .fblock .col {
        float: none;
    }
    .col {
        float: left;
        margin-right: 1em;
    }
    .partner-name {
        font-size: 2em;
    }
    .validated, .not-validated {
        display: inline-block;
        margin-bottom: 1em;
        font-weight: bold;
        text-transform: uppercase;
    }
    .validated {
        color: green;
    }
    .not-validated {
        color: #b67500;
    }
    .currency-exchange {
        text-transform: uppercase;
        color: blue;
    }
    .red {
        text-transform: uppercase;
        color: red;
    }
    .haxxor {
        position: absolute;
        top: 0;
        right: 0;
        color: hsl(<?php echo rand(0, 360);?>, 100%, 50%);
    }
</style>
<title><?php echo $partner->name;?> DEBUG</title>
<div class="haxxor">5UP3R 53CR57 H4XX0R M0D3</div>
<?php
        echo '<div class="partner-name">'.$partner->name.'</div>';


        // Display if the partner has been validated and, if yes and
        // if the info is available, who did the validation.

        if ($partner->isValidated()) {
            echo '<span class="validated">validé</span>';
            if ($partner->validator) {
                echo ' par '.$partner->validator->given_name.
                    ' '.$partner->validator->surname.
                    ' ('.$partner->validator->team->name.')';
            } else {
                echo ' (validateur inconnu)';
            }
        } else {
            echo '<span class="not-validated">non validé</span>';
        }

        echo '<br>';


        // Display the main attributes of the partner.

        echo '<div class="vblock fblock">';

        echo '<div class="col">';
        echo "<h2>Attributes</h2>";
        $dumper->dump($partner->getAttributes());
        echo '</div>';


        // Display the postal address of the partner.

        echo '<div class="col">';
        echo "<h4>Postal address</h4>";

        if (!$partner->postalAddress) {
            echo "— no postal address —<br><br>";
        } else {

            if ($partner->postalAddress->isPublic) {
                echo '✅ Adresse publique';
            } else {
                echo '⛔️ Adresse cachée';
            }

            echo '<pre>'.json_encode(json_decode(
                $partner->postalAddress->data
            ), JSON_PRETTY_PRINT).'</pre>';
        }
        echo '</div>';


        // Display the phone numbers of the partner.

        echo '<div class="col">';
        echo "<h4>Phones (".count($partner->phones).")</h4>";

        if ($partner->phones->isEmpty()) {
            echo "— no phone —<br><br>";
        } else {

            $phoneCount = 1;

            foreach ($partner->phones as $phone) {

                echo '<div class="vblock col">';
                echo "<h4>Phone {$phoneCount}</h4>";

                if ($phone->isPublic) {
                    echo '✅ Téléphone public';
                } else {
                    echo '⛔️ Téléphone caché';
                }

                echo '<pre>'.json_encode(json_decode(
                    $phone->data
                ), JSON_PRETTY_PRINT).'</pre>';

                echo '</div>';
                $phoneCount++;
            }
        }
        echo '</div>';


        // Display the e-mail addresses of the partner.

        echo '<div class="col">';
        echo "<h4>E-mails (".count($partner->emails).")</h4>";

        if ($partner->emails->isEmpty()) {
            echo "— no e-mail —<br><br>";
        } else {

            $emailCount = 1;

            foreach ($partner->emails as $email) {

                echo '<div class="vblock col">';
                echo "<h4>E-mail {$emailCount}</h4>";

                if ($email->isPublic) {
                    echo '✅ E-mail public';
                } else {
                    echo '⛔️ E-mail caché';
                }

                echo '<pre>'.json_encode(json_decode(
                    $email->data
                ), JSON_PRETTY_PRINT).'</pre>';

                echo '</div>';
                $emailCount++;
            }
        }
        echo '</div>';


        // Display the social networks of the partner.

        echo '<div class="col">';
        echo "<h4>Social networks (".count($partner->socialNetworks).")</h4>";

        if ($partner->socialNetworks->isEmpty()) {
            echo "— no social network —<br><br>";
        } else {

            $networkCount = 1;

            foreach ($partner->socialNetworks as $network) {

                echo '<div class="vblock col">';
                echo "<h4>Social network {$networkCount}</h4>";

                echo '<pre>'.json_encode(json_decode(
                    $network->data
                ), JSON_PRETTY_PRINT).'</pre>';

                echo '</div>';
                $networkCount++;
            }
        }
        echo '</div>';


        // Display the websites of the partner.

        echo '<div class="col">';
        echo "<h4>Websites (".count($partner->websites).")</h4>";

        if ($partner->websites->isEmpty()) {
            echo "— no website —<br><br>";
        } else {

            $websiteCount = 1;

            foreach ($partner->websites as $website) {

                echo '<div class="vblock col">';
                echo "<h4>Website {$websiteCount}</h4>";

                echo '<pre>'.json_encode(json_decode(
                    $website->data
                ), JSON_PRETTY_PRINT).'</pre>';

                echo '</div>';
                $websiteCount++;
            }
        }
        echo '</div>';

        echo '</div>';
        // End block main attributes + contact details.


        // Display the team that ‘owns’ this partner.

        echo "<h2>Team</h2>";
        if ($partner->team) {
            echo "<p>{$partner->team->name}</p>";
        } else {
            echo '<p class="red">Val inconnu</p>';
        }


        // Display the locations.

        echo "<h2>Locations (".count($partner->locations).")</h2>";
        echo '<div class="block">';

        if ($partner->locations->isEmpty()) {
            echo "— no location —<br><br>";
        } else {
            $locationCount = 1;

            foreach ($partner->locations as $location) {

                echo '<div class="vblock col">';


                // Display the main attributes of each location.

                echo "<h3>Location {$locationCount}</h3>";

                if ($location->currencyExchange) {
                    echo '<div class="currency-exchange">
                        💰 Ce lieu est comptoir de change
                    </div>';
                }

                echo '<div class="col">';
                echo "<h4>Attributes</h4>";
                $dumper->dump($location->getAttributes());
                echo '</div>';


                // Display the postal address of each location.

                echo '<div class="col">';
                echo "<h4>Postal address</h4>";

                if (!$location->postalAddress) {
                    echo "— no postal address —<br><br>";
                } else {

                    if ($location->postalAddress->isPublic) {
                        echo '✅ Adresse publique';
                    } else {
                        echo '⛔️ Adresse cachée';
                    }

                    // echo '<pre>'.$location->postalAddress->toString().'</pre>';
                    echo '<pre>'.json_encode(json_decode(
                        $location->postalAddress->data
                    ), JSON_PRETTY_PRINT).'</pre>';
                }
                echo '</div>';


                // Display the phone numbers of each location.

                echo '<div class="col">';
                echo "<h4>Phones (".count($location->phones).")</h4>";

                if ($location->phones->isEmpty()) {
                    echo "— no phone —<br><br>";
                } else {

                    $phoneCount = 1;

                    foreach ($location->phones as $phone) {

                        echo '<div class="vblock col">';
                        echo "<h4>Phone {$phoneCount}</h4>";

                        if ($phone->isPublic) {
                            echo '✅ Téléphone public';
                        } else {
                            echo '⛔️ Téléphone caché';
                        }

                        echo '<pre>'.json_encode(json_decode(
                            $phone->data
                        ), JSON_PRETTY_PRINT).'</pre>';

                        echo '</div>';
                        $phoneCount++;
                    }
                }
                echo '</div>';


                $locationCount++;

                echo '</div>';
            }
            // End foreach locations.
        }
        // End else locations.
        echo '</div>';


        // Display the representatives.

        echo "<h2>Representatives (".count($partner->representatives).")</h2>";
        echo '<div class="block">';

        if ($partner->representatives->isEmpty()) {
            echo "— no representative —<br><br>";
        } else {
            $repCount = 1;

            foreach ($partner->representatives as $rep) {

                echo '<div class="vblock col">';


                // Display the main attributes of each representative.

                echo "<h3>Representative {$repCount}</h3>";

                echo '<div class="col">';
                echo "<h4>Attributes</h4>";
                $dumper->dump($rep->getAttributes());
                echo '</div>';


                // Display the e-mail addresses of each representative.

                echo '<div class="col">';
                echo "<h4>E-mails (".count($rep->emails).")</h4>";

                if ($rep->emails->isEmpty()) {
                    echo "— no e-mail —<br><br>";
                } else {

                    $emailCount = 1;

                    foreach ($rep->emails as $email) {

                        echo '<div class="vblock col">';
                        echo "<h4>E-mail {$emailCount}</h4>";

                        if ($email->isPublic) {
                            echo '✅ E-mail public';
                        } else {
                            echo '⛔️ E-mail caché';
                        }

                        echo '<pre>'.json_encode(json_decode(
                            $email->data
                        ), JSON_PRETTY_PRINT).'</pre>';

                        echo '</div>';
                        $emailCount++;
                    }
                }
                echo '</div>';


                // Display the phone numbers of each representative.

                echo '<div class="col">';
                echo "<h4>Phones (".count($rep->phones).")</h4>";

                if ($rep->phones->isEmpty()) {
                    echo "— no phone —<br><br>";
                } else {

                    $phoneCount = 1;

                    foreach ($rep->phones as $phone) {

                        echo '<div class="vblock col">';
                        echo "<h4>Phone {$phoneCount}</h4>";

                        if ($phone->isPublic) {
                            echo '✅ Téléphone public';
                        } else {
                            echo '⛔️ Téléphone caché';
                        }

                        echo '<pre>'.json_encode(json_decode(
                            $phone->data
                        ), JSON_PRETTY_PRINT).'</pre>';

                        echo '</div>';
                        $phoneCount++;
                    }
                }
                echo '</div>';


                $repCount++;

                echo '</div>';
            }
            // End foreach representatives.
        }
        // End else representatives.

        echo '</div>';


        // Display the team member who made the partner
        // sign the official documents.

        echo "<h2>Endorser</h2>";
        if ($partner->teamMember) {
            echo '<p>'.$partner->teamMember->given_name.
                ' '.$partner->teamMember->surname.'</p>';
        } else {
            echo '<p class="red">Personne inconnue</p>';
        }

        echo '<hr>';
        dd($partner);
    }
}
