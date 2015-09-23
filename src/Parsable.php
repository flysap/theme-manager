<?php

namespace Flysap\ThemeManager;

interface Parsable {

    /**
     * Parse .
     *
     * @param $contents
     * @return mixed
     */
    public function parse($contents);
}