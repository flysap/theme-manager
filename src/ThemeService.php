<?php

namespace Flysap\themeManager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ThemeService  {

    /**
     * @var ThemeCache
     */
    private $themeCache;

    /**
     * @var ThemeManager
     */
    private $themeManager;

    public function __construct(ThemeCache $themeCache, ThemeManager $themeManager) {
        $this->themeCache = $themeCache;
        $this->themeManager = $themeManager;
    }

    /**
     * Install module ..
     *
     * @param UploadedFile $module
     * @return mixed
     */
    public function install(UploadedFile $module) {
        if( $configuration = $this->themeManager
            ->upload($module) ) {

            $this->themeCache
                ->flush();

            return true;
        }
    }

    /**
     * Remove module ..
     *
     * @param $module
     * @return mixed
     */
    public function remove($module) {
        $this->themeManager
            ->remove($module);

        $this->themeCache
            ->flush();

        return redirect()
            ->back();
    }

    /**
     * Show list of modules .
     *
     * @return mixed
     */
    public function modules() {
        $modules = $this->themeCache
            ->toArray();

        return $modules;
    }
}