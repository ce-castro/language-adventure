<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function index(){
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'desc_top' => 'required',
            'desc_bottom' => 'required',
        ]);

        $input = $request->except(['status']);

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        Category::create($input);

        session()->flash('message_green', 'Category successfully added!');
//        return redirect(route('categories.edit', [$data->id, 'tab_1'] ));
        return redirect(route('categories.index'));
    }


    public function edit(Category $category){
//        $photos = Photo::where('category_id', $category->id)->orderBy('title', 'asc')->get();
//        $faqs = Faq::where('category_id', $category->id)->get();
        return view('admin.categories.edit', compact('category'));
    }

    public function update($id, Request $request){
        $category = Category::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'desc_top' => 'required',
            'desc_bottom' => 'required',
        ]);

        //$input = $request->all();
        $input = $request->except(['status']);

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $category->update($input);

        session()->flash('message_green', 'Category successfully updated!');
        return redirect(route('categories.index'));
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('message_red', 'Category Deleted');
        return redirect(route('categories.index'));
    }

    public function  getCat($tour_id){
        $cats = Category::where('category_id', $category_id)->orderBy('title', 'asc')->get();
        $selectito = "";
        foreach ($subs as $sub){
            $selectito .= '$("#sub_category_id").append("<option value='.$sub->id.'>'.$sub->title.'</option>");';
        }
        return $selectito;
    }
}
