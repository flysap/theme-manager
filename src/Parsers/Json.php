<?php

namespace Flysap\ThemeManager\Parsers;

use Flysap\ThemeManager\Parsable;

class Json implements Parsable {

    /**
     * Parse file ..
     *
     * @param $contents
     * @return array
     */
    public function parse($contents) {
        return json_decode($contents, true);
    }
}