<?php

namespace App\Http\Controllers;

use App\Photo;
use Validator;
use Illuminate\Http\Request;
use File;

class PhotoController extends AdminController
{

    public function edit(Photo $photo){
        return view('admin.photos.edit', compact('photo'));
    }

    public function store(Request $request){

//        $this->validate($request, [
//            'title' => 'required',
//            'type_id' => 'required'
//        ]);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'type_id' => 'required'
        ]);

        if ($validator->fails()) {
            if($request->tour_id!='') {
                return redirect(route('tours.edit', [$request->tour_id, 'tab_2']));
            } else {
                return redirect(route('categories.edit', [$request->category_id, 'tab_2']));
            }
        }

        $input = $request->except(['status', 'image']);

        if ($request->hasFile('image')) {
            $imageName = urlencode($request->image->getClientOriginalName());
            $input['image'] = $imageName;
            $input['size'] = $request->image->getClientSize();
            $request->file('image')->storeAs(
                'uploads', $imageName, 'public'
            );
        }

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }


        Photo::create($input);

        session()->flash('message_green', 'Photo successfully added!');
        if($request->tour_id!='') {
            return redirect(route('tours.edit', [$request->tour_id, 'tab_2']));
        } else {
            return redirect(route('categories.edit', [$request->category_id, 'tab_2']));
        }
    }

    public function update($id, Request $request){
        $photo = Photo::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',
            'type_id' => 'required'
        ]);

        $input = $request->except(['status', 'image']);

        if ($request->hasFile('image')) {
            $imageName = urlencode($request->image->getClientOriginalName());
            $input['image'] = $imageName;
            $input['size'] = $request->image->getClientSize();
            $request->file('image')->storeAs(
                'uploads', $imageName, 'public'
            );
        }

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $photo->update($input);
        session()->flash('message_green', 'Photo successfully updated!');
        if($request->tour_id!='') {
            return redirect(route('tours.edit', [$request->tour_id, 'tab_2']));
        } else {
            return redirect(route('categories.edit', [$request->category_id, 'tab_2']));
        }
    }

    public function destroy($id, $tour_id){
        $photo = Photo::findOrFail($id);
        File::delete(public_path('uploads/').$photo->image);
        $photo->delete();

        session()->flash('message_red', 'Photo Deleted');
        //return redirect(route('photos.index'));
        return redirect(route('tours.edit', [$tour_id, 'tab_2']));
    }

    public function destroycat($id, $category_id){
        $photo = Photo::findOrFail($id);
        //File::delete(public_path('uploads/').$photo->image);
        $photo->delete();

        session()->flash('message_red', 'Photo Deleted');
        return redirect(route('categories.edit', [$category_id, 'tab_2']));
    }
}
