<?php

namespace App\Http\Controllers;

use App\TourPrice;
use Illuminate\Http\Request;

class TourPriceController extends AdminController
{
    public function edit(TourPrice $tourprice){
        return view('admin.tourprices.edit', compact('tourprice'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'tour_id' => 'required|numeric',
            'adult_retail' => 'required|numeric',
            'adult_discount' => 'required|numeric',
            'child_retail' => 'required|numeric',
            'child_discount' => 'required|numeric'
        ]);

        $input = $request->except(['status']);

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        TourPrice::create($input);

        session()->flash('message_green', 'Price successfully added!');
        return redirect(route('tours.edit', [$request->tour_id, 'tab_4'] ));
    }

    public function update($id, Request $request){
        $tourprice = TourPrice::findOrFail($id);

        $this->validate($request, [
            'tour_id' => 'required|numeric',
            'adult_retail' => 'required|numeric',
            'adult_discount' => 'required|numeric',
            'child_retail' => 'required|numeric',
            'child_discount' => 'required|numeric'
        ]);

        $input = $request->except(['status']);

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $tourprice->update($input);

        session()->flash('message_green', 'Tour Price successfully updated!');
        return redirect(route('tours.edit', [$request->tour_id, 'tab_4']));
    }

    public function destroy($id, $tour_id){
        $tourschedule = TourPrice::findOrFail($id);
        $tourschedule->delete();

        session()->flash('message_red', 'Tour Price Deleted');
        return redirect(route('tours.edit', [$tour_id, 'tab_4']));
    }

}
