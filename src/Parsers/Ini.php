<?php

namespace Flysap\ThemeManager\Parsers;

use Flysap\ModuleManager\Contracts\ConfigParserContract;

class Ini implements ConfigParserContract {

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