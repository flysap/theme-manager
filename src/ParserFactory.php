<?php

namespace Flysap\ThemeManager;

class ParserFactory {

    /**
     * Parser factory .
     *
     * @param $slug
     * @return mixed
     */
    public static function factory($slug) {
        if( class_exists('Flysap\ThemeManager\Parsers\\' .ucfirst($slug)) ) {
            $class = 'Flysap\ThemeManager\Parsers\\' .ucfirst($slug);

            return new $class;
        }
    }
}
