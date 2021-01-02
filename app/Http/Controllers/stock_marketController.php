<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
// use flash;
use Illuminate\Http\Request;
use App\Models\stock_market;
use Carbon\Carbon;
class stock_marketController extends Controller
{
    public function store(Request $request)
    {

        stock_market::create($request->all());
        return back();
        // Session::flash('flash_message', 'New entry added!');
    }

    public function destroy($id){
        
        stock_market::destroy($id);
        Session::flash('flash_message', 'Deleted!');
        return back();
    
    }

    public function update(Request $request, $id){
        $entry = stock_market::find($id);
        $entry->date = new Carbon($request->date);
        $entry->trade_code = $request->trade_code;
        $entry->high = $request->high;
        $entry->low = $request->low;
        $entry->open = $request->open;
        $entry->close = $request->close;
        $entry->volume = $request->volume;
        $entry->save();
        return back();
    }
}
