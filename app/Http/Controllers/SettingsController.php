<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            $settings_data['mail_sender'] = $data['mail_sender'];
            $settings_data['password_reset_notification_subject'] = $data['password_reset_notification_subject'];
            $settings_data['password_reset_notification_content'] = $data['password_reset_notification_content'];
            
            if (DB::table('notifications_email')->where('notification_id','=','1')->update($settings_data))
                return redirect('ustawienia')->with('flash_message_success','Ustawienia zostały zaktualizowane.');
            else
                return redirect('ustawienia')->with('flash_message_error','Błąd podczas aktualizowania ustawień.');
        }

        $settings = DB::table('notifications_email')->first();

        return view('settings.index')->with(compact('settings'));
    }
}
