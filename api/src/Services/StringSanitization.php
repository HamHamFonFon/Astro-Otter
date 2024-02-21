<?php

namespace App\Services;

final class StringSanitization
{
    public const REGEX = '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z0-9]+)!';
    public const GLUE_DASH = ' - ';

    public function __invoke(string $string): string
    {
        $transliterator = \Transliterator::createFromRules(':: Any-Latin; :: Latin-ASCII; :: NFD; :: [:Nonspacing Mark:] Remove; :: NFC;', \Transliterator::FORWARD);
        if (is_null($transliterator)) {
            return $string;
        }

        preg_match_all(self::REGEX, $transliterator->transliterate($string), $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match === strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode(trim(self::GLUE_DASH), $ret);
    }
}
