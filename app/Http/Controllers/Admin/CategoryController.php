<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use DB;


class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function categoriesRegister()
    {
        return view('admin.category.register');
    }

    public function categoriesCreate(Request $request)
    {
        if($request->name != null)
        {
            $category = $this->category->create($request->all());
        }    
                
        return redirect()->route('categories.register')->with('success', 'Information has been added');        
    }
    
    public function categoriesGet()
    {
        $category = $this->category->all();

        return view('admin.category.search', compact('category'));        
    }

    public function categoriesEdit($id)
    {        
        $category = $this->category->find($id);
        return view('admin.category.edit',compact('category','id'));        
    }

    public function categoriesUpdate(Request $request, $id)
    {
        $category = $this->category->find($id);
        $category->name=$request->get('name');        
        $category->save();
        return redirect('admin/home');
    }

    public function categoriesDestroy($id)
    {
        $category = $this->category->find($id);
        $category->delete();
        return redirect('admin/home')->with('success','Information has been  deleted');
    }
}
