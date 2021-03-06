<?php

namespace Flysap\ThemeManager;

use Flysap\ThemeManager\Exceptions\ThemeUploaderException;
use Illuminate\Contracts\Support\Arrayable;
use Symfony\Component\Finder\Finder;
use Flysap\Support;

class Repository implements Arrayable {

    const CACHE_FILE = 'themes.json';

    const DEFAULT_THEME = 'default_theme.json';

    /**
     * @var
     */
    private $finder;

    public function __construct(Finder $finder) {

        $this->finder = $finder;
    }

    /**
     * Walk through module ini files parse and cache it ..
     */
    public function flush() {
        $modules = $this->findModulesConfig();

        $fullCachePath = $this->getCachePath();

        if(! Support\is_path_exists($fullCachePath))
            Support\mk_path($fullCachePath);

        Support\dump_file($fullCachePath . DIRECTORY_SEPARATOR . self::CACHE_FILE, json_encode($modules));

        return $this;
    }

    /**
     * Clear cache file .
     *
     * @return $this
     */
    public function clear() {
        $fullCachePath = $this->getCachePath();

        if( Support\is_path_exists($fullCachePath) )
            Support\remove_paths([
                $fullCachePath . DIRECTORY_SEPARATOR . self::CACHE_FILE
            ]);

        return $this;
    }


    /**
     * Get array cached ..
     *
     * @param array $modules
     * @return mixed
     */
    public function toArray(array $modules = array()) {
        $fullCachePath = $this->getCachePath(true);

        if( ! Support\is_path_exists($fullCachePath . DIRECTORY_SEPARATOR . self::CACHE_FILE))
            $this->flush();

        $cache = file_get_contents(
            $fullCachePath . DIRECTORY_SEPARATOR . self::CACHE_FILE
        );

        $cache = json_decode($cache, true);

        if( $modules )
            return array_intersect_key($cache, array_flip((array) $modules));

        return $cache;
    }

    /**
     * Find modules configuration files .
     *
     * @param array $keys
     * @return array
     */
    public function findModulesConfig($keys = array()) {
        $name     = '/theme.(\w{1,4})$/';

        $fullPath = $this->getStoragePath(true);

        $modules = [];
        $finder  = $this->finder;

        $finder->name($name)
            ->depth('< 3');

        foreach ($finder->in($fullPath) as $file) {

            $parser = ParserFactory::factory(
                $file->getExtension()
            );

            $module = $parser
                ->parse( $file->getContents() );

            if( isset($module['name']) )
                $modules[$module['name']] = $module;
        }

        if(! is_array($keys))
            $keys = (array)$keys;

        return array_only($modules, $keys ? $keys : array_keys($modules));
    }


    /**
     * Check if theme is installed .
     *
     * @param $theme
     * @return bool
     */
    public function isInstalled($theme) {
        #@todo temporary ...
        $this->flush();

        return in_array($theme, array_keys($this->toArray()));
    }


    /**
     * Get activated theme .
     *
     * @return mixed
     * @throws ThemeUploaderException
     */
    public function getActivated() {
        if( Support\is_path_exists( $this->getCachePath() . DIRECTORY_SEPARATOR . self::DEFAULT_THEME ) ) {
            $theme = file_get_contents( $this->getCachePath() . DIRECTORY_SEPARATOR . self::DEFAULT_THEME );

            return json_decode($theme);
        }
    }

    /**
     * Set default theme .
     *
     * @param $theme
     * @return bool
     * @throws ThemeUploaderException
     */
    public function activate($theme) {
        if( $this->isInstalled($theme) ) {

            Support\dump_file($this->getCachePath() . DIRECTORY_SEPARATOR . self::DEFAULT_THEME, json_encode($theme));

            return true;
        }
    }


    /**
     * Get storage path .
     *
     * @param bool $asFull
     * @return mixed
     * @throws ThemeUploaderException
     */
    protected function getStoragePath($asFull = true) {
        $path = config('theme-manager.theme_path');

        if (! $path || $path == '')
            throw new ThemeUploaderException(
                _("Cannot fine storage path for modules.")
            );

        if($asFull)
            $path = app_path('..' . DIRECTORY_SEPARATOR . $path);

        return $path;
    }

    /**
     * Get cache path .
     *
     * @param bool $asFull
     * @return mixed
     * @throws ThemeUploaderException
     */
    protected function getCachePath($asFull = true) {
        $path = config('theme-manager.cache_dir');

        if (! $path || $path == '')
            throw new ThemeUploaderException(
                _("Cannot fine cache path for modules.")
            );

        if( $asFull )
            $path = app_path(
                '..' . DIRECTORY_SEPARATOR . $path
            );

        return $path;
    }

}