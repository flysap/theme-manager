<?php

namespace Flysap\ThemeManager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ThemeService  {

    /**
     * @var repository
     */
    private $repository;

    /**
     * @var uploader
     */
    private $uploader;

    public function __construct(Repository $repository, Uploader $uploader) {
        $this->repository = $repository;
        $this->uploader = $uploader;
    }

    /**
     * Install module ..
     *
     * @param UploadedFile $module
     * @return mixed
     */
    public function install(UploadedFile $module) {
        if( $configuration = $this->uploader
            ->upload($module) ) {

            $this->repository
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
        $this->uploader
            ->remove($module);

        $this->repository
            ->flush();

        return redirect()
            ->back();
    }

    /**
     * Activate theme .
     *
     * @param $theme
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($theme) {
        if( ! $this->repository->activate($theme) )
            return back();

        app('view')->addLocation(
            app_path('../themes/' . $theme)
        );

        app('view')->addNamespace(
            'themes', app_path('../themes/' . $theme)
        );

        return back();
    }

    /**
     * Set default theme .
     *
     */
    public function setDefault() {
        if( ! $defaultTheme = $this->repository->getActivated() )
            $defaultTheme = config('theme-manager.default_theme');

        $this->activate($defaultTheme);
    }
}