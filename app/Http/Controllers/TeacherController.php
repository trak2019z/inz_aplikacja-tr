<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::get();

        return view('teacher.index')->with(compact('teachers'));
    }

    public function checkIfTeacherExist($name = null)
    {
        if (Teacher::where('teacher_name', '=', $name)->exists())
            return true;
        else
            return false;
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            if ($this->checkIfTeacherExist($data['teacher_name'])) {

                return redirect('nauczyciele/dodaj')->with('flash_message_error','Nauczuciel '.$data['teacher_name'].' juz istnieje');
            }

            $teacher = new Teacher;
            $teacher->teacher_name = $data['teacher_name'];
            
            if ($teacher->save())
                return redirect('nauczyciele')->with('flash_message_success','Nauczuciel został dodany.');
            else
                return redirect('nauczyciele')->with('flash_message_error','Błąd podczas dodawania nauczyciela.');
        }
        return view('teacher.create');
    }

    public function edit(Request $request, $teacher_id = null)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            $teacher = Teacher::where('teacher_id',$teacher_id)->first();

            if ($teacher->teacher_name != $data['teacher_name'])
                if ($this->checkIfTeacherExist($data['teacher_name'])) {

                    return redirect('nauczyciele/edytuj/'.$teacher_id)->with('flash_message_error','Nauczuciel '.$data['teacher_name'].' juz istnieje');
                }

            $teacher_data['teacher_name'] = $data['teacher_name'];
            
            if (Teacher::where('teacher_id',$teacher_id)->update($teacher_data))
                return redirect('nauczyciele')->with('flash_message_success','Nauczuciel został zaktualizowany.');
            else
                return redirect('nauczyciele')->with('flash_message_error','Błąd podczas aktualizowania nauczyciela.');
        }

        $teacher = Teacher::where('teacher_id',$teacher_id)->first();

        return view('teacher.edit')->with(compact('teacher'));
    }

    public function delete(Request $request, $teacher_id = null)
    {
        if(!empty($teacher_id))
        {
            if (Teacher::where('teacher_id',$teacher_id)->delete())
                 return redirect('nauczyciele')->with('flash_message_success','Nauczuciel został usunięty.');
            else
                return redirect('nauczyciele')->with('flash_message_error','Błąd podczas usuwania nauczyciela.');
        }
        return redirect('nauczyciele');
    }
}
