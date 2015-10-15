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
     * Show list of modules .
     *
     * @return mixed
     */
    public function themes() {
        $modules = $this->repository
            ->toArray();

        return $modules;
    }

    public function activate($theme) {
    }
}