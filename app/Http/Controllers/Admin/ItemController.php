<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemStock;
use App\Models\Moviment;
use DB;


class ItemController extends Controller
{    

    protected $item;
    protected $item_stock;
    protected $brands;
    protected $categories;
    protected $moviments;

    public function __construct(Item $item, ItemStock $item_stock, Category $categories, Brand $brands, Moviment $moviments)
    {
        $this->item       = $item;
        $this->item_stock = $item_stock; 
        $this->category   = $categories;
        $this->brand      = $brands;
        $this->moviment   = $moviments;
    }    

    public function index()
    {
        return view('admin.index');
    }

    public function itemsRegister()
    {
        $brands = $this->brand->orderBy('name', 'asc')->get();
        $categories = $this->category->orderBy('name', 'asc')->get();

        return view('admin.item.register', compact('brands', 'categories'));
    }

    public function itemsCreate(Request $request)
    {
        
        $dataItem = [
            'name'         => $request->name,
            'location'     => $request->location,
            'price'        => $request->price,
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

        return redirect()->route('items.search'); 
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

        return redirect('admin/item/search');
    }

    public function itemsDestroy($id)
    {
        $item = $this->item->find($id);

        $item->delete();
        return redirect()->route('items.home')->with('success','Information has been  deleted');
    }
}