<?php

namespace Wotd\Services;

use App\Wotd;
use DiDom\Document;

final class WotdServiceUtils
{
    private const WOTD_URL = "http://dictionary.cambridge.org/dictionary/english";
    private const WOTD_HTML_CSS_CLASS = ".wotd-hw";

    /**
     * Get latest Cambridge Word of the day
     *
     * @return array Word of the day if success or an error
     */
    public static function getWordOfTheDay()
    {
        $ERROR_MSG = [
            'error' => 500,
            'message' => 'Could not get word of the day. Please contact ansidev@gmail.com for supporting.',
        ];
        $document = new Document(self::WOTD_URL, true);
        $html = $document->html();
        if (strlen($html) < 1) {
            return $ERROR_MSG;
        }
        // Find word of the day
        $wotd_html = $document->find(self::WOTD_HTML_CSS_CLASS)[0];
        $wotd = $wotd_html->firstChild()->nextSibling()->innerHtml();
        $wotd_link = self::WOTD_URL . '/' . $wotd;
        $wotd_meaning = $wotd_html->parent()->parent()->nextSibling()->nextSibling()->child(1)->text();

        // Build WOTD object
        $wotd = [
            'word' => $wotd,
            'meaning' => $wotd_meaning,
            'url' => $wotd_link,
            'date' => date("d.m.Y")
        ];

        return $wotd;
    }

    public static function getAllWords()
    {
        $words = Wotd::all();

        return json_decode($words, true);
    }
}
