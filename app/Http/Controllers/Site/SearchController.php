<?php

namespace App\Http\Controllers\Site;

use App\Partner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Allow people to search for partners, cities, etc.
 */
class SearchController extends Controller
{
    /*
        NOTES

        Types of data for autocomplete/search:

        - partner names
        - city names
        - street names (might ‘pollute’ results, this would need good testing)

        Try to work on a generator-based version ?
     */

    public function show(Request $request)
    {
        return view('public.search');
    }

    public function search(Request $request)
    {
        $startTime = microtime(true);

        $pattern = 'mdbl';
        $pattern = $query = $request->get('query');


        $partners = Partner::with([
            'locations.postalAddress',
            'locations.currencyExchange',
        ])
        ->select('id', 'name', 'name_sort', 'slug')
        ->get();

        $entries = collect();
        $cityNames = collect();

        foreach ($partners as $partner) {
            foreach ($partner->locations as $location) {

                $cityNames[] = Str::lower($location->postalAddress->city);

                // $key = Str::lower($partner->name_sort ?? $partner->name);
                $key = $partner->name;
                // $key = Str::lower($partner->name);

                $entries[$key] = [
                    'type' => 'partner',
                    'id' => $partner->id,
                    'name' => $partner->name,
                    'name_sort' => $partner->name_sort,
                    'slug' => $partner->slug,
                    'url' => url('partenaires/'.$partner->slug),
                ];
            }
        }

        $cityNames = $cityNames->sort()->unique();

        foreach ($cityNames as $cityName) {
            $entries[$cityName] = [
                'type' => 'city',
                'city_name' => $cityName,
                'url' => url('partenaires-par-localite/'.$cityName),
            ];
        }

        $results = collect();

        // $entries = ['Greenburger' => 'foo'];

        foreach ($entries as $entry => $data) {
            // echo '<p>'.$pattern.' -> '.$entry.' : ';
            // // echo $this->fuzzyMatchSimple($pattern, $entry) ? 'true' : 'false';
            // // echo implode(', ', $this->fuzzyMatch($pattern, $entry));
            // var_dump($this->fuzzyMatch($pattern, $entry));

            $fuzzyMatchResult = $this->fuzzyMatch($pattern, $entry);

            $result = [
                'entry' => $entry,
                'entry_type' => $data['type'],
                'type' => ($data['type'] === 'partner') ? 'partenaire' : 'ville',
                'has_matched' => $fuzzyMatchResult[0],
                'score' => $fuzzyMatchResult[1],
                'formatted_str' => $fuzzyMatchResult[2],
                'url' => $data['url'],
            ];

            if ($request->get('mode') === 'a') {
                $result['text'] = $result['formatted_str'];
            } else {
                if ($data['type'] === 'partner') {
                    $result['text'] = $data['name'];
                } else {
                    $result['text'] = $data['city_name'];
                }
            }

            $results[] = $result;
        }

        $results = $results
            ->filter->has_matched
            ->sortByDesc->score;

        $i = 1;

        // echo "<p>Search for <strong>{$pattern}</strong></p>";
        // echo '<ul>';

        foreach ($results as $result) {
            if ($result['entry_type'] == 'partner') {
                $type = 'partenaire';
            } else {
                $type = 'ville';
            }

            // echo "<li>{$result['score']} — {$result['formatted_str']} ({$type})</li>";

            if ($i == 10) {
                // echo '<hr>';
            }

            $i++;
        }
        // echo '</ul>';


        $elapsedTime = round((microtime(true) - $startTime) * 1000).' ms';

        // dd($results);
        // dd($entries);

        // echo '<hr>';
        // var_dump('toto');
        // var_dump($request);

        $results = $results->take(15);

        return view('public.search', compact('results', 'query', 'elapsedTime'));
    }

    // TODO: docblock
    public function fuzzyMatchSimple($pattern, $str)
    {
        $patternIdx = 0;
        $patternLength = mb_strlen($pattern);
        $strIdx = 0;
        $strLength = mb_strlen($str);

        while ($patternIdx != $patternLength && $strIdx != $strLength) {

            $patternChar = Str::lower($pattern[$patternIdx]);
            $strChar = Str::lower($str[$strIdx]);

            if ($patternChar == $strChar){
                ++$patternIdx;
            }

            ++$strIdx;

            // echo "<p>\$patternChar: $patternChar — \$strChar: $strChar — \$patternIdx: $patternIdx — \$strIdx: $strIdx</p>";
        }

        if (
            $patternLength != 0 &&
            $strLength != 0 &&
            $patternIdx == $patternLength
        ) {
            return true;
        }

        return false;
    }

    public function fuzzyMatch($pattern, $str, $htmlTag = 'mark') {

        // $pattern = \Illuminate\Support\Str::ascii($pattern, 'fr');
        // $str = \Illuminate\Support\Str::ascii($str, 'fr');

        // Score constants.

        // Bonus for adjacent matches.
        $ADJACENCY_BONUS = 5;
        // Bonus if match occurs after a separator.
        $SEPARATOR_BONUS = 10;
        // Bonus if match is uppercase and prev is lower.
        $CAMEL_BONUS = 10;
        // Penalty applied for every letter in str before the first match.
        $LEADING_LETTER_PENALTY = -3;
        // Maximum penalty for leading letters.
        $MAX_LEADING_LETTER_PENALTY = -9;
        // Penalty for every letter that doesn't matter.
        $UNMATCHED_LETTER_PENALTY = -1;

        // Loop variables
        $score = 0;
        $patternIdx = 0;
        $patternLength = mb_strlen($pattern);
        $strIdx = 0;
        $strLength = mb_strlen($str);
        $prevMatched = false;
        $prevLower = false;
        // true so if first letter match gets separator bonus.
        $prevSeparator = true;

        // Use "best" matched letter if multiple string letters match the pattern
        $bestLetter = null;
        $bestLower = null;
        $bestLetterIdx = null;
        $bestLetterScore = 0;

        $matchedIndices = [];

        $formattedStr = '';

        // Loop over strings
        while ($strIdx != $strLength) {
            // $patternChar = $patternIdx != $patternLength ? $pattern[$patternIdx] : null;
            $patternChar = $patternIdx != $patternLength ? mb_substr($pattern, $patternIdx, 1, 'UTF-8') : null;
            // $strChar = $str[$strIdx];
            $strChar = mb_substr($str, $strIdx, 1, 'UTF-8');

            $patternLower = $patternChar != null ? mb_strtolower($patternChar, 'UTF-8') : null;
            $strLower = mb_strtolower($strChar, 'UTF-8');
            $strUpper = mb_strtoupper($strChar, 'UTF-8');

            $nextMatch = $patternChar && ($patternLower == $strLower);
            $rematch = $bestLetter && ($bestLower == $strLower);

            $advanced = $nextMatch && $bestLetter;
            $patternRepeat = $bestLetter && $patternChar && ($bestLower == $patternLower);

            if ($advanced || $patternRepeat) {
                $score += $bestLetterScore;
                $matchedIndices[] = $bestLetterIdx;
                $bestLetter = null;
                $bestLower = null;
                $bestLetterIdx = null;
                $bestLetterScore = 0;
            }

            if ($nextMatch || $rematch) {
                $newScore = 0;

                // Apply penalty for each letter before the first pattern match
                // Note: std::max because penalties are negative values. So max is smallest penalty.
                if ($patternIdx == 0) {
                    $penalty = max(
                        $strIdx * $LEADING_LETTER_PENALTY,
                        $MAX_LEADING_LETTER_PENALTY
                    );
                    $score += $penalty;
                }

                // Apply bonus for consecutive bonuses
                if ($prevMatched) {
                    $newScore += $ADJACENCY_BONUS;
                }

                // Apply bonus for matches after a separator
                if ($prevSeparator) {
                    $newScore += $SEPARATOR_BONUS;
                }

                // Apply bonus across camel case boundaries.
                // Includes "clever" isLetter check.
                if (
                    $prevLower &&
                    ($strChar == $strUpper) &&
                    ($strLower != $strUpper)
                ) {
                    $newScore += $CAMEL_BONUS;
                }

                // Update patter index IFF the next pattern letter was matched
                if ($nextMatch) {
                    ++$patternIdx;
                }

                // Update best letter in str which may be for a "next" letter or a "rematch"
                if ($newScore >= $bestLetterScore) {

                    // Apply penalty for now skipped letter
                    if ($bestLetter != null) {
                        $score += $UNMATCHED_LETTER_PENALTY;
                    }

                    $bestLetter = $strChar;
                    $bestLower = mb_strtolower($bestLetter, 'UTF-8');
                    $bestLetterIdx = $strIdx;
                    $bestLetterScore = $newScore;
                }

                $prevMatched = true;
            }
            else {
                // Append unmatch characters
                $formattedStr .= $strChar;

                $score += $UNMATCHED_LETTER_PENALTY;
                $prevMatched = false;
            }

            // Includes "clever" isLetter check.
            $prevLower = ($strChar == $strLower) && ($strLower != $strUpper);
            $prevSeparator = $strChar == '_' || $strChar == ' ';

            ++$strIdx;
        }

        // Apply score for last match
        if ($bestLetter) {
            $score += $bestLetterScore;
            $matchedIndices[] = $bestLetterIdx;
        }

        // Finish out formatted string after last pattern matched
        // Build formated string based on matched letters
        $formattedStr = '';
        $lastIdx = 0;

        $matchedIndicesCount = count($matchedIndices);
        for ($i = 0; $i < $matchedIndicesCount; ++$i) {
            $idx = $matchedIndices[$i];
            $formattedStr .=
                mb_substr($str, $lastIdx, $idx - $lastIdx).
                "<{$htmlTag}>".mb_substr($str, $idx, 1, 'UTF-8')."</{$htmlTag}>";

            $lastIdx = $idx + 1;
        }
        $formattedStr .= mb_substr($str, $lastIdx, mb_strlen($str) - $lastIdx);

        $matched = $patternIdx == $patternLength;
        return [$matched, $score, $formattedStr];
    }

}
