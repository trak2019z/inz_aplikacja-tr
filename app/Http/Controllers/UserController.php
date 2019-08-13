<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('user.index')->with(compact('users'));
    }

    public function checkIfUserExist($email = null)
    {
        if (User::where('email', '=', $email)->exists())
            return true;
        else
            return false;
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            if ($this->checkIfUserExist($data['email'])) {

                return redirect('uzytkownicy/dodaj')->with('flash_message_error','Adres mail '.$data['email'].' juz istnieje');
            }

            $user = new User;
            $user->name = $data['name'];
            $user->role = $data['role'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            
            if ($user->save())
                return redirect('uzytkownicy')->with('flash_message_success','Użytkownik został dodany.');
            else
                return redirect('uzytkownicy')->with('flash_message_error','Błąd podczas dodawania użytkownika.');
        }
        return view('user.create');
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            $user = User::where('id',$id)->first();

            if ($user->email != $data['email'])
                if ($this->checkIfUserExist($data['email'])) {

                    return redirect('uzytkownicy/edytuj/'.$id)->with('flash_message_error','Adres email '.$data['email'].' juz istnieje');
                }

            $user_data['name'] = $data['name'];
            if (isset($data['role']))
                $user_data['role'] = $data['role'];
            $user_data['email'] = $data['email'];
            if ($data['password'] != '')
                $user_data['password'] = bcrypt($data['password']);
            
            if (User::where('id',$id)->update($user_data))
                return redirect('uzytkownicy')->with('flash_message_success','Użytkownik został zaktualizowany.');
            else
                return redirect('uzytkownicy')->with('flash_message_error','Błąd podczas aktualizowania uzytkownika.');
        }

        $user = User::where('id',$id)->first();

        return view('user.edit')->with(compact('user'));
    }

    public function delete(Request $request, $id = null)
    {
        if($id != null && Auth::user()->role == 'admin')
        {
            if (User::where('id',$id)->delete()) {
                 return redirect('uzytkownicy')->with('flash_message_success','Użytkownik został usunięty.');
            }
            else
                return redirect('uzytkownicy')->with('flash_message_error','Błąd podczas usuwania uzytkownika.');
        }
        return redirect('uzytkownicy');
    }
}
