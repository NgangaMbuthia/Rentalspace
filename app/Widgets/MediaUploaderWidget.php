<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Backend\Entities\Upload;
use Auth;

class MediaUploaderWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */

    public function run()
    {
        //
        return view("widgets.media_uploader_widget", [
            'config' => $this->config
        ]);
    }
}