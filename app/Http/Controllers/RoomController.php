<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::get();

        return view('room.index')->with(compact('rooms'));
    }

    public function checkIfRoomExist($name = null)
    {
        if (Room::where('room_name', '=', $name)->exists())
            return true;
        else
            return false;
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            if ($this->checkIfRoomExist($data['room_name'])) {

                return redirect('pokoje/dodaj')->with('flash_message_error','Pokój '.$data['room_name'].' juz istnieje');
            }

            $room = new Room;
            $room->room_name = $data['room_name'];
            
            if ($room->save())
                return redirect('pokoje')->with('flash_message_success','Pokój został dodany.');
            else
                return redirect('pokoje')->with('flash_message_error','Błąd podczas dodawania pokoju.');
        }
        return view('room.create');
    }

    public function edit(Request $request, $room_id = null)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            $room = Room::where('room_id',$room_id)->first();

            if ($room->room_name != $data['room_name'])
                if ($this->checkIfRoomExist($data['room_name'])) {

                    return redirect('pokoje/edytuj/'.$room_id)->with('flash_message_error','Pokój '.$data['room_name'].' juz istnieje');
                }

            $room_data['room_name'] = $data['room_name'];
            
            if (Room::where('room_id',$room_id)->update($room_data))
                return redirect('pokoje')->with('flash_message_success','Pokój został zaktualizowany.');
            else
                return redirect('pokoje')->with('flash_message_error','Błąd podczas aktualizowania pokoju.');
        }

        $room = Room::where('room_id',$room_id)->first();

        return view('room.edit')->with(compact('room'));
    }

    public function delete(Request $request, $room_id = null)
    {
        if(!empty($room_id))
        {
            if (Room::where('room_id',$room_id)->delete())
                 return redirect('pokoje')->with('flash_message_success','Pokój został usunięty.');
            else
                return redirect('pokoje')->with('flash_message_error','Błąd podczas usuwania pokoju.');
        }
        return redirect('pokoje');
    }
}
