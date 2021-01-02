<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\stock_market;

class getDataController extends BaseController
{
    public function get(Request $request)
    {
        $data = stock_market::paginate(10);
        return response()->json($data);
    }

    public function getAll(Request $request)
    {
        $data = stock_market::orderBy('date','DESC')->get();
        return response()->json($data);
    }
}
