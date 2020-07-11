<?php

namespace App\Http\Controllers;

use App\Tour;
use App\TourPrice;
use App\Category;
use App\Photo;
use App\TourSchedule;
use App\Country;
use Illuminate\Http\Request;

class TourController extends AdminController
{
    public function index(){
        $tours = Tour::orderBy('name', 'asc')->get();
        $tours->load('categories');
        return view('admin.tours.index', compact('tours'));
    }

    public function create(){
        $listcategories = Category::where('status','1')->orderBy('name', 'asc')->get();
        $countries = Country::orderBy('name', 'asc')->get();
//        $listsub = SubCategory::orderBy('title', 'asc')->get();
        return view('admin.tours.create', compact('listcategories', 'countries'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'country_id' => 'required'
        ]);

        $input = $request->except(['status', 'category_id']);

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $tour = Tour::create($input);

        $tour->categories()->attach($request->category_id);

        session()->flash('message_green', 'Tour successfully added!');
        //return redirect(route('tours.index'));
        return redirect(route('tours.edit', [$tour->id, 'tab_1'] ));
    }

    public function edit(Tour $tour){

        $categories = "";
        $listcategories = Category::where('status','1')->orderBy('name', 'asc')->get();
        //$listsub = SubCategory::orderBy('title', 'asc')->get();
        $photos = Photo::where('tour_id', $tour->id)->orderBy('order', 'asc')->get();
        $scheds = TourSchedule::where('tour_id', $tour->id)->get();
        $prices = TourPrice::where('tour_id', $tour->id)->orderBy('id', 'asc')->get();
        $countries = Country::orderBy('name', 'asc')->get();
        //$faqs = Faq::where('tour_id', $tour->id)->get();

        return view('admin.tours.edit', compact('tour', 'listcategories', 'photos', 'scheds',  'categories', 'prices', 'countries'));
    }

    public function update($id, Request $request){

        $tour = Tour::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'country_id' => 'required'
        ]);

        $input = $request->except(['status', 'category_id']);

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $tour->update($input);

        $tour->categories()->sync($request->category_id);

        session()->flash('message_green', 'Tour successfully updated!');
        return redirect(route('tours.edit', [$id, 'tab_1'] ));

    }

    public function destroy($id){
        $tour = Tour::findOrFail($id);
        $tour->delete();

        session()->flash('message_red', 'Tour Deleted');
        return redirect(route('tours.index'));
    }
}
