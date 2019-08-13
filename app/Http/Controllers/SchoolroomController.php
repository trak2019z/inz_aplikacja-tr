<?php

namespace App\Http\Controllers;

use App\Schoolroom;
use App\Shedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SchoolroomController extends Controller
{

    public function index()
    {
        $schoolrooms = Schoolroom::get();

        return view('schoolroom.index')->with(compact('schoolrooms'));
    }

    public function checkIfSchoolroomExist($name = null)
    {
        if (Schoolroom::where('schoolroom_name', '=', $name)->exists())
            return true;
        else
            return false;
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            if ($this->checkIfSchoolroomExist($data['schoolroom_name'])) {

                return redirect('klasy/dodaj')->with('flash_message_error','Klasa '.$data['schoolroom_name'].' juz istnieje');
            }

            $schoolroom = new Schoolroom;
            $schoolroom->schoolroom_name = $data['schoolroom_name'];
            
            if ($schoolroom->save())
                return redirect('klasy')->with('flash_message_success','Klasa została dodana.');
            else
                return redirect('klasy')->with('flash_message_error','Błąd podczas dodawania klasy.');
        }
        return view('schoolroom.create');
    }

    public function edit(Request $request, $schoolroom_id = null)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            $schoolroom = Schoolroom::where('schoolroom_id',$schoolroom_id)->first();

            if ($schoolroom->schoolroom_name != $data['schoolroom_name'])
                if ($this->checkIfSchoolroomExist($data['schoolroom_name'])) {

                    return redirect('klasy/edytuj/'.$schoolroom_id)->with('flash_message_error','Klasa '.$data['schoolroom_name'].' juz istnieje');
                }

            $schoolroom_data['schoolroom_name'] = $data['schoolroom_name'];
            
            if (Schoolroom::where('schoolroom_id',$schoolroom_id)->update($schoolroom_data))
                return redirect('klasy')->with('flash_message_success','Klasa została zaktualizowana.');
            else
                return redirect('klasy')->with('flash_message_error','Błąd podczas aktualizowania klasy.');
        }

        $schoolroom = Schoolroom::where('schoolroom_id',$schoolroom_id)->first();

        return view('schoolroom.edit')->with(compact('schoolroom'));
    }

    public function delete(Request $request, $schoolroom_id = null)
    {
        if(!empty($schoolroom_id))
        {
            if (Schoolroom::where('schoolroom_id',$schoolroom_id)->delete()) {
                Shedule::where('schoolroom_id',$schoolroom_id)->delete();
                 return redirect('klasy')->with('flash_message_success','Klasa została usunięta.');
            }
            else
                return redirect('klasy')->with('flash_message_error','Błąd podczas usuwania klasy.');
        }
        return redirect('klasy');
    }
}
