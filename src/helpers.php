<?php

if (! function_exists('jargon')) {
    /**
     * Translate the given message.
     *
     * @param  string  $id
     * @param  array   $parameters
     * @param  string  $domain
     * @param  string  $jargon
     * @return \Symfony\Component\Translation\TranslatorInterface|string
     */
    function jargon($id = null, $parameters = [], $domain = 'messages', $jargon = null)
    {
        if (is_null($id)) {
            return app('jargon');
        }

        return app('jargon')->trans($id, $parameters, $domain, $jargon);
    }
}

if (! function_exists('jargon_choice')) {
    /**
     * Translates the given message based on a count.
     *
     * @param  string  $id
     * @param  int|array|\Countable  $number
     * @param  array   $parameters
     * @param  string  $domain
     * @param  string  $locale
     * @return string
     */
    function jargon_choice($id, $number, array $parameters = [], $domain = 'messages', $jargon = null)
    {
        return app('jargon')->transChoice($id, $number, $parameters, $domain, $jargon);
    }
}