<?php

namespace App\Http\Controllers;

use Log;
use Session;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class BaseWebController extends Controller
{
    public function generalSuccess($message = null)
    {
        Session::flush('success', $message);
    }

    public function generalError($message = null)
    {
        Log::error($message);
        Session::flush('error', $message);
    }
}
