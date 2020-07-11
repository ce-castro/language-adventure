<?php

namespace App\Http\Controllers;

use App\TourSchedule;
use Illuminate\Http\Request;

class TourScheduleController extends AdminController
{
    public function edit(TourSchedule $schedule){
        return view('admin.schedule.edit', compact('schedule'));
    }

    public function store(Request $request){
        $saveday = "";
        $this->validate($request, [
            'days' => 'required',
            'start' => 'required',
            'finish' => 'required'
        ]);

        $input = $request->except(['status', 'days']);

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        foreach ($request->days as $day){
            $saveday .= $day.",";
        }
        $input['days'] = substr($saveday,0,-1);

        TourSchedule::create($input);

        session()->flash('message_green', 'Schedule successfully added!');
        return redirect(route('tours.edit', [$input['tour_id'], 'tab_3'] ));
    }

    public function update($id, Request $request){
        $tourschedule = TourSchedule::findOrFail($id);

        $saveday = "";

        $this->validate($request, [
            'days' => 'required',
            'start' => 'required',
            'finish' => 'required',
        ]);

        $input = $request->except(['status', 'days', 'tour_id']);

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        foreach ($request->days as $day){
            $saveday .= $day.",";
        }
        $input['days'] = substr($saveday,0,-1);

        $tourschedule->update($input);

        session()->flash('message_green', 'Schedule successfully updated!');
        return redirect(route('tours.edit', [$request->tour_id, 'tab_3']));
    }

    public function destroy($id, $tour_id){
        $tourschedule = TourSchedule::findOrFail($id);
        $tourschedule->delete();

        session()->flash('message_red', 'Schedule Deleted');
        return redirect(route('tours.edit', [$tour_id, 'tab_3']));
    }

}
