<?php

namespace App\Http\Controllers;

use App\Shedule;
use App\Schoolroom;
use App\Subject;
use App\Teacher;
use App\Room;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SheduleController extends Controller
{
    public function index($schoolroom_id = null, $active_week = null)
    {
        if ($active_week == null)
            $active_week = 'A';

        $schoolroom = Schoolroom::where('schoolroom_id',$schoolroom_id)->first();
        $shedules = Shedule::where('schoolroom_id',$schoolroom_id)
                    ->where('shedule_week',$active_week)
                    ->join('teachers','shedules.teacher_id','=','teachers.teacher_id')
                    ->join('rooms','shedules.room_id','=','rooms.room_id')
                    ->join('subjects','shedules.subject_id','=','subjects.subject_id')
                    ->get();
        
        return view('shedule.index')->with(compact('schoolroom','shedules','active_week'));
    }

    public function checkIfSheduleExist(array $data, $schoolroom_id = null, $shedule_id = null)
    {
        $data['shedule_hour_start'] = $data['shedule_hour_start'].':'.$data['shedule_minute_start'];
        $data['shedule_hour_end'] = $data['shedule_hour_end'].':'.$data['shedule_minute_end'];
        $shedule = '';

        if ($shedule_id == null)
            $shedule = Shedule::where('shedule_day', '=', $data['shedule_day'])
                        ->where('shedule_week', '=', $data['shedule_week'])
                        ->where('schoolroom_id', '=', $schoolroom_id)
                        ->whereRaw('(? BETWEEN shedule_hour_start AND shedule_hour_end OR ? BETWEEN shedule_hour_start AND shedule_hour_end OR shedule_hour_start BETWEEN ? AND ? OR shedule_hour_end BETWEEN ? AND ?)',
                                    [$data['shedule_hour_start'], $data['shedule_hour_end'], 
                                    $data['shedule_hour_start'], $data['shedule_hour_end'] ,
                                    $data['shedule_hour_start'], $data['shedule_hour_end']])
                        ->get();
        else 
            $shedule = Shedule::where('shedule_day', '=', $data['shedule_day'])
            ->where('shedule_week', '=', $data['shedule_week'])
            ->where('schoolroom_id', '=', $schoolroom_id)
            ->where('shedule_id', '!=', $shedule_id)
            ->whereRaw('(? BETWEEN shedule_hour_start AND shedule_hour_end OR ? BETWEEN shedule_hour_start AND shedule_hour_end OR shedule_hour_start BETWEEN ? AND ? OR shedule_hour_end BETWEEN ? AND ?)',
                        [$data['shedule_hour_start'], $data['shedule_hour_end'], 
                        $data['shedule_hour_start'], $data['shedule_hour_end'] ,
                        $data['shedule_hour_start'], $data['shedule_hour_end']])
            ->get();

        if ($shedule->isEmpty()) 
            return false;
        else
            return true;
    }

    public function create(Request $request, $schoolroom_id = null, $active_week = null)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            if ($this->checkIfSheduleExist($data, $schoolroom_id, null)) {

                return redirect()->back()->with('flash_message_error','Błędne dane.');
            }

            $shedule = new Shedule;
            $shedule->schoolroom_id = $schoolroom_id;
            $shedule->shedule_day = $data['shedule_day'];
            $shedule->shedule_week = $data['shedule_week'];
            $shedule->shedule_hour_start = $data['shedule_hour_start'].':'.$data['shedule_minute_start'];
            $shedule->shedule_hour_end = $data['shedule_hour_end'].':'.$data['shedule_minute_end'];
            $shedule->subject_id = $data['subject_id'];
            $shedule->teacher_id = $data['teacher_id'];
            $shedule->room_id = $data['room_id'];
            
            if ($shedule->save())
                return redirect('rozklad/'.$schoolroom_id.'/'.$active_week)->with('flash_message_success','Zajęcia zostały dodane.');
            else
                return redirect('rozklad/'.$schoolroom_id.'/'.$active_week)->with('flash_message_error','Błąd podczas dodawania zajęć.');
        }

        $schoolroom = Schoolroom::where('schoolroom_id',$schoolroom_id)->first();
        $subjects = Subject::get();
        $rooms = Room::get();
        $teachers = Teacher::get();

        return view('shedule.create')->with(compact('subjects','rooms','teachers','schoolroom','active_week'));
    }

    public function edit(Request $request, $schoolroom_id = null, $shedule_week = null, $shedule_id = null)
    {
        $active_week = $shedule_week;

        if ($request->isMethod('post'))
        {
            $data = $request->input();

            $shedule = Shedule::where('shedule_id',$shedule_id)->first();

            $new_start_hounr = $data['shedule_hour_start'].':'.$data['shedule_minute_start'];
            $new_end_hounr = $data['shedule_hour_end'].':'.$data['shedule_minute_end'];

            if (($shedule->shedule_hour_start != $new_start_hounr) || ($shedule->shedule_hour_end != $new_end_hounr))
                if ($this->checkIfSheduleExist($data, $schoolroom_id, $shedule_id)) {

                    return redirect('rozklad/edytuj/'.$shedule->schoolroom_id.'/'.$shedule->shedule_week.'/'.$shedule->shedule_id)->with('flash_message_error','Błedne dane.');
                }

            $shedule_data['schoolroom_id'] = $schoolroom_id;
            $shedule_data['shedule_day'] = $data['shedule_day'];
            $shedule_data['shedule_week'] = $data['shedule_week'];
            $shedule_data['shedule_hour_start'] = $data['shedule_hour_start'].':'.$data['shedule_minute_start'];
            $shedule_data['shedule_hour_end'] = $data['shedule_hour_end'].':'.$data['shedule_minute_end'];
            $shedule_data['subject_id'] = $data['subject_id'];
            $shedule_data['teacher_id'] = $data['teacher_id'];
            $shedule_data['room_id'] = $data['room_id'];
            
            if (Shedule::where('shedule_id',$shedule_id)->update($shedule_data))
                return redirect('rozklad/'.$schoolroom_id.'/'.$data['shedule_week'])->with('flash_message_success','Zajęcia zostały zaktualizowane.');
            else
                return redirect('rozklad/'.$schoolroom_id.'/'.$data['shedule_week'])->with('flash_message_error','Błąd podczas aktualizowania zajęć.');
        }

        $shedule = Shedule::where('shedule_id',$shedule_id)->first();
        $schoolroom = Schoolroom::where('schoolroom_id',$schoolroom_id)->first();
        $subjects = Subject::get();
        $rooms = Room::get();
        $teachers = Teacher::get();
        $start_hour_pieces = explode(":",$shedule->shedule_hour_start);
        $end_hour_pieces = explode(":",$shedule->shedule_hour_end);

        return view('shedule.edit')->with(compact('subjects','rooms','teachers','schoolroom','active_week','shedule','start_hour_pieces','end_hour_pieces'));
    }
    
    public function delete(Request $request, $schoolroom_id = null, $shedule_week = null, $shedule_id = null)
    {
        if($shedule_id != null)
        {
            if (Shedule::where('shedule_id',$shedule_id)->delete())
                 return redirect('rozklad/'.$schoolroom_id.'/'.$shedule_week)->with('flash_message_success','Zajęcia zostały usunięte.');
            else
                return redirect('rozklad/'.$schoolroom_id.'/'.$shedule_week)->with('flash_message_error','Błąd podczas usuwania zajęć.');
        } else {
            return redirect('rozklad/'.$schoolroom_id.'/'.$shedule_week)->with('flash_message_error','Błąd podczas usuwania zajęć.');
        }
    }
}
