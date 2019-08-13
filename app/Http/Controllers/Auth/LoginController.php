<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\User;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/klasy';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $request->session()->put('login_custom_error', 'Błędny e-mail lub hasło.');
        throw ValidationException::withMessages(
            [
                'error' => 'Błędny e-mail lub hasło.',
            ]
        );
    }

    public function passwordReset(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input(); 
    
            $user = User::where('email',$data['email'])->first();

            if ($user) {

                $temp_password = str_random(8);
                User::where('id',$user->id)->update(['password' => bcrypt($temp_password)]);
    
                $notifications = DB::table('notifications_email')->first();

                $mailFrom = $notifications->mail_sender;
                $mailTo = $user->email;
                $subject = "=?UTF-8?B?".base64_encode($notifications->password_reset_notification_subject)."?=";

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";
                $headers .= "From: {$mailFrom}\r\n";

                $content = $notifications->password_reset_notification_content;

                $search  = array('[user_name]', '[new_password]');
                $replace = array($user->name, $temp_password );
                $content = str_replace($search, $replace, $content);

                mail($mailTo, $subject, $content, $headers);

                return view('auth.passwordReset')->with('flash_message_success','Nowe hasło zostało wysłane na mail');
            } else {
                return view('auth.passwordReset')->with('flash_message_error','Użytkownik nie istnieje.');
            }
        }
        return view('auth.passwordReset'); 
    }
}
