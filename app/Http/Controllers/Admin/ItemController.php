<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClientRecord;
use App\Models\Parcel;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemStock;
use App\Models\Moviment;
use DB;
use Carbon\carbon;
use App\Models\Client;


class ItemController extends Controller
{    
    protected $item;
    protected $item_stock;
    protected $brands;
    protected $categories;
    protected $moviments;
    protected $clientrecords;
    protected $parcels;
    protected $clients;

    public function __construct(Item $item, ItemStock $item_stock, Category $categories, Brand $brands, Moviment $moviments, ClientRecord $clientrecords, Parcel $parcels, Client $clients)
    {
        $this->item          = $item;
        $this->item_stock    = $item_stock; 
        $this->category      = $categories;
        $this->brand         = $brands;
        $this->moviment      = $moviments;
        $this->clientrecord  = $clientrecords;
        $this->parcel        = $parcels;
        $this->client        = $clients;
    }    

    public function index()
    {
        $tdate = date('m-y');
        $begin = Carbon::now()->startOfMonth();
        $end   = Carbon::now()->endOfMonth();
        


        $parcels = $this->parcel->orderBy('id')->get()->where('parcel->status', '<', '3');

        $client_quantity = $this->client->whereBetween('created_at',[$begin,$end])->count();

        $record_quantity = $this->clientrecord->whereBetween('created_at',[$begin,$end])->count();

        $payed = $this->clientrecord->whereBetween('created_at',[$begin,$end])->get()->where('status', '=', '3')->count();

        $payedpercent = 0;

        if($record_quantity > 0)
        {
            if($payed > 0)
            {
                $payedpercent = ($payed / $record_quantity) * 100;
            }
        } 

        $item = $this->item->orderBy('name', 'asc')->get();

        $notification = array(
            'message' => 'I am a successful message!', 
            'alert-type' => 'success'
        );
        

        return view('admin.index', compact('item', 'parcels', 'tdate', 'record_quantity', 'client_quantity', 'payedpercent'))->with($notification);
    }

    public function itemsRegister()
    {
        $brands = $this->brand->orderBy('name', 'asc')->get();
        $categories = $this->category->orderBy('name', 'asc')->get();

        return view('admin.item.register', compact('brands', 'categories'));
    }

    public function itemsCreate(Request $request)
    {
        $price = str_replace('R$ ', '', $request->get('price'));
        
        $dataItem = [
            'name'         => $request->name,
            'location'     => $request->location,
            'price'        => $price,
            'brand_id'     => $request->brand,
            'category_id'  => $request->category
        ];

        $item = $this->item->create($dataItem);

        $dataStock = [
            'quantity'     => $request->quantity,
            'quantity_min' => $request->quantity_min,
            'item_id'      => $item->id
        ];

        $item_stock = $this->item_stock->create($dataStock);

        $movimentCreate = [
            'mov_type' => 1,
            'item_id'  => $item->id,
            'quantity' => $item_stock->quantity
        ];

        $moviments = $this->moviment->create($movimentCreate);

        $notification = array(
            'message' => 'Item Registrado!' , 
            'alert-type' => 'success'
        );

        return redirect()->route('items.search')->with($notification); 
        //->with('success', 'Information has been added')

    }
           
    public function itemsGet()
    {
        $brands = $this->brand->orderBy('name', 'asc')->get();
        $categories = $this->category->orderBy('name', 'asc')->get();


        $item = $this->item->all();

        return view('admin.item.search', compact('item', 'brands', 'categories'));        
    }

    public function itemsEdit($id)
    {   
        $brands = $this->brand->orderBy('name', 'asc')->get();
        $categories = $this->category->orderBy('name', 'asc')->get();
        
        $item = $this->item->find($id);   
        
        return view('admin.item.edit')->with(compact('brands'))->with(compact('categories'))->with(compact('item'));
    }

    public function itemsUpdate(Request $request, $id)
    {
        $item = $this->item->find($id);

        $itemUpdate = [
            'name'         => $request->name,
            'location'     => $request->location,
            'price'        => $request->price,
            'brand_id'     => $request->brand,
            'category_id'  => $request->category
        ];

        $stockUpdate = [
            'quantity'     => $request->quantity,
            'quantity_min' => $request->quantity_min
        ];
 
        $item->update($itemupdate);  
        $item->save();

        $item_stock = $this->item_stock->where('item_id', $item->id)->first();
        $item_stock->update($stockupdate);
        $item_stock->save();

        $notification = array(
            'message' => 'Item Atualizado!' , 
            'alert-type' => 'success'
        );

        return redirect('admin/item/search')->with($notification);
    }

    public function itemstockUpdate(Request $request, $id)
    {
        $item = $this->item->find($id);

        $item_stock = $this->item_stock->where('item_id', $item->id)->first();

        $stockUpdate = [
            'quantity' => $item_stock->quantity + $request->quantity,
        ];
 
        $item_stock->update($stockUpdate);
        $item_stock->save();

        $movimentCreate = [
            'mov_type' => 1,
            'item_id'  => $item->id,
            'quantity' => $request->quantity
        ];

        $moviments = $this->moviment->create($movimentCreate);

        $notification = array(
            'message' => 'Estoque Atualizado!' , 
            'alert-type' => 'success'
        );

        return redirect('admin/home')->with($notification);
    }

    public function itemsDestroy($id)
    {
        $item = $this->item->find($id);

        $item->delete();

        $notification = array(
            'message' => 'Item Deletado!' , 
            'alert-type' => 'success'
        );

        return redirect()->route('items.home')->with($notification);
    }
}