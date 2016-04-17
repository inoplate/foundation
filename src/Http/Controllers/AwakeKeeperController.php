<?php

namespace Inoplate\Foundation\Http\Controllers;

class AwakeKeeperController extends Controller {

    /**
     * Ping site to keep app awake
     * 
     * @return Response
     */
    public function ping()
    {
        return response('', 204);
    }

}