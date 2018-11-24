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
        DB::beginTransaction();

        if($request->name != null)
        {
            $category = $this->category->create($request->all());
        }    

        if($category)
        {
            $notification = array(
                'message' => 'Categoria Registrada!' , 
                'alert-type' => 'success'
            );

            DB::commit();
            
            return redirect()->route('categories.search')->with($notification);  
        }
        else
        {
            $notification = array(
                'message' => 'Categoria não Registrada!' , 
                'alert-type' => 'error'
            );

            DB::rollback();

            return redirect()->route('categories.search')->with($notification);
        }

              
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

        $notification = array(
            'message' => 'Categoria Atualizada!' , 
            'alert-type' => 'success'
        );

        return redirect('admin/category/search')->with($notification);
    }

    public function categoriesDestroy($id)
    {
        $category = $this->category->find($id);
        $category->delete();

        $notification = array(
            'message' => 'Categoria Deletada!' , 
            'alert-type' => 'success'
        );

        return redirect('admin/home')->with($notification);
    }
}
