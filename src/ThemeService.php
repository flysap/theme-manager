<?php

namespace Flysap\ThemeManager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ThemeService  {

    /**
     * @var repository
     */
    private $repository;

    /**
     * @var manager
     */
    private $manager;

    public function __construct(Repository $repository, Manager $manager) {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * Install module ..
     *
     * @param UploadedFile $module
     * @return mixed
     */
    public function install(UploadedFile $module) {
        if( $configuration = $this->manager
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
        $this->manager
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
}