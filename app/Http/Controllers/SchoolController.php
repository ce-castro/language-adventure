<?php

namespace App\Http\Controllers;

use App\Country;
use App\School;
use App\User;
use Illuminate\Http\Request;
use Auth;

class SchoolController extends AdminController
{
    public function index(){
        if(Auth::user()->role_id ==1){
            $schools = School::orderBy('name', 'asc')->get();
        } else {
            $schools = School::where('user_id', '=', Auth::user()->id)->orderBy('name', 'asc')->get();
        }
        return view('admin.schools.index', compact('schools'));
    }

    public function create(){
        $countries = Country::orderBy('name', 'asc')->get();
        $users = User::where('role_id', '!=', 1)->orderBy('name', 'asc')->get();
        return view('admin.schools.create',  compact('countries', 'users'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'city' => 'required',
            'country_id' => 'required',
            'user_id' => 'required'
        ]);

        $input = $request->except(['status']);

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $school = School::create($input);

        session()->flash('message_green', 'Tour successfully added!');
        return redirect(route('schools.index'));
//        return redirect(route('tours.edit', [$tour->id, 'tab_1'] ));
    }

    public function destroy($id){
        $tour = School::findOrFail($id);
        $tour->delete();

        session()->flash('message_red', 'School Deleted');
        return redirect(route('schools.index'));
    }

}
