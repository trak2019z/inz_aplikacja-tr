<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schoolroom;
use App\Shedule;

class HomeController extends Controller
{

    public function index($schoolroom_id = null, $active_week = null)
    {
        $schoolrooms = Schoolroom::get();
        $schoolroom = '';
        $shedules = '';
        $active_schoolroom = '';

        if ($active_week == null)
            $active_week = 'A';

        if ($schoolroom_id != null) {
            $schoolroom = Schoolroom::where('schoolroom_id',$schoolroom_id)->first();
            $shedules = Shedule::where('schoolroom_id',$schoolroom_id)
                    ->where('shedule_week',$active_week)
                    ->join('teachers','shedules.teacher_id','=','teachers.teacher_id')
                    ->join('rooms','shedules.room_id','=','rooms.room_id')
                    ->join('subjects','shedules.subject_id','=','subjects.subject_id')
                    ->get();
            $active_schoolroom = $schoolroom_id;
        } else {
            $schoolroom = Schoolroom::first();
            $shedules = Shedule::where('schoolroom_id',$schoolroom->schoolroom_id)
                    ->where('shedule_week',$active_week)
                    ->join('teachers','shedules.teacher_id','=','teachers.teacher_id')
                    ->join('rooms','shedules.room_id','=','rooms.room_id')
                    ->join('subjects','shedules.subject_id','=','subjects.subject_id')
                    ->get();
            $active_schoolroom = $schoolroom->schoolroom_id;
        }

        return view('home')->with(compact('schoolrooms','schoolroom','shedules','active_schoolroom','active_week'));
    }
}
