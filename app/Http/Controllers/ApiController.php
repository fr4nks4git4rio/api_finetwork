<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function recibirInfoFacebook(Request $request)
    {
        return response()->json($request->input());
    }
}
