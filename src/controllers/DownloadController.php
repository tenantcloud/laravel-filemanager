<?php namespace Tsawler\Laravelfilemanager\controllers;

use Tsawler\Laravelfilemanager\controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

/**
 * Class DownloadController
 * @package Tsawler\Laravelfilemanager\controllers
 */
class DownloadController extends Controller {

    /**
     * @var
     */
    protected $file_location;


    /**
     * Download a file
     *
     * @return mixed
     */
    public function getDownload()
    {
    	if (Session::get('lfm_type') == "Images")
	    $this->file_location = Config::get('lfm.images_dir');
	else
	    $this->file_location = Config::get('lfm.files_dir');

        $file_to_download = Input::get('file');
        $dir = Input::get('dir');
        return Response::download(base_path()
            .  "/"
            . $this->file_location
            .  $dir
            . "/"
            . $file_to_download);
    }

}
