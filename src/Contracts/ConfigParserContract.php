<?php

namespace Flysap\ThemeManager\Contracts;

interface ConfigParserContract {

    /**
     * Parse file .
     *
     * @param $file
     * @return mixed
     */
    public function parse($file);
}