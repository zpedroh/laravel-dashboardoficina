<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemStock;
use DB;


class ItemController extends Controller
{    

    protected $item;

    public function __construct(Item $item,ItemStock $item_stock)
    {
        $this->item = $item;

        $this->item_stock = $item_stock; 
    }    

    public function index()
    {
        return view('admin.index');
    }

    public function itemsRegister()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.item.register', compact('brands', 'categories'));
    }

    public function itemsCreate(Request $request)
    {
        $dataStock = [
            'quantity' => $request->quantity
        ];

        $item_stock = $this->item_stock->create($dataStock);

        $dataItem = [
            'name'          => $request->name,
            'price'         => $request->price,
            'brand_id'      => $request->brand,
            'category_id'   => $request->category,
            'item_stock_id' => $item_stock->id
        ];

        $item = $this->item->create($dataItem);       
                
        return redirect()->route('items.home')->with('success', 'Information has been added');        
    }
           
    public function itemsGet()
    {
        $item = $this->item->all();

        //$brands = Brand::all();
        
        //->sortBy('name', 'asc');

        return view('admin.item.search', compact('item', 'brands'));        
    }


    /*

    public function itemsEdit($id)
    {        
        $category = \App\Models\Category::find($id);
        return view('admin.category.edit',compact('category','id'));        
    }

    public function items(Request $request, $id)
    {
        $category= \App\Models\Category::find($id);
        $category->name=$request->get('name');        
        $category->save();
        return redirect('admin/home');
    }

    public function itemsDestroy($id)
    {
        $category = \App\Models\Category::find($id);
        $category->delete();
        return redirect('admin/home')->with('success','Information has been  deleted');
    }
    */

}