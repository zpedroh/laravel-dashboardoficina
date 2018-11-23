<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Client;
use App\Models\ClientRecord;
use App\Models\ClientRecordItem;
use App\Models\ClientRecordService;
use App\Models\PaymentMethod;
use App\Models\Parcel;
use App\Models\Item;
use App\Models\ItemStock;
use App\Models\Service;
use App\Models\Moviment;
use Carbon\carbon;

class ReportController extends Controller
{
    public function __construct(Moviment $moviments, Item $items)
    {
        $this->item     = $items;
        $this->moviment = $moviments;
    }

    public function bestsellerReport()
    {        
        return view('admin.report.bestseller');
    }

    public function bsGet(Request $request)
    {
        $items =  $this->item->all();

        $start = Carbon::createFromDate($request->date_start);
        $end   = Carbon::createFromDate($request->date_end);

        dd($start,$end);

        foreach($items as $item)
        {
            $quantity = $this->moviment->whereBetween('created_at',[$request->date_start,$request->date_end]); //where('item_id', '=', $item->id)->where('mov_type' , '=', 2)->sum('quantity');

            //->whereBetween('created_at',[$request->date_start,$request->date_end])
            dd($quantity, $request->all());
        }

        

        return view('admin.report.bestseller', compact('moviments'));
    }

    public function bestclientReport()
    {
        
        return view('admin.report.bestclient');
    }
}
