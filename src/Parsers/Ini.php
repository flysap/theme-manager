<?php

namespace Flysap\ThemeManager\Parsers;

use Flysap\ThemeManager\Parsable;

class Ini implements Parsable {

    /**
     * Parse file ..
     *
     * @param $contents
     * @return array
     */
    public function parse($contents) {
        return parse_ini_string(
            $contents, true, INI_SCANNER_NORMAL
        );
    }
}