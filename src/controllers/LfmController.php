<?php namespace Tsawler\Laravelfilemanager\controllers;

use Tsawler\Laravelfilemanager\controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

/**
 * Class LfmController
 * @package Tsawler\Laravelfilemanager\controllers
 */
class LfmController extends Controller {

    /**
     * @var
     */
    protected $file_location;


    /**
     * Show the filemanager
     *
     * @return mixed
     */
    public function show()
    {
        if ((Session::has('lfm_type')) && (Session::get('lfm_type') == 'Files'))
        {
	    $this->file_location = Config::get('lfm.files_dir');
        } else
        {
	    $this->file_location = Config::get('lfm.images_dir');
	}

        if ((Input::has('type')) && (Input::get('type') == "Files"))
        {
            Session::put('lfm_type', 'Files');
            $this->file_location = Config::get('lfm.files_dir');
        } else
        {
            Session::put('lfm_type', 'Images');
            $this->file_location = Config::get('lfm.images_dir');
        }

        if (Input::has('base'))
        {
            $working_dir = Input::get('base');
            $base = $this->file_location . Input::get('base') . "/";
        } else
        {
            $working_dir = "/";
            $base = $this->file_location;
        }

        return View::make('laravel-filemanager::index')
            ->with('base', $base)
            ->with('working_dir', $working_dir);
    }

    /**
     * @return mixed
     */
    public function sampleCkeditorIntegration()
    {
        return \Illuminate\Support\Facades\View::make('editor');
    }
}
