<?php namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail;
use App\Task;
use App\User;
use App\Client;
use App\Worker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Hash;
use View;
use Session;

class Correus extends Controller
{

    /*
    |--------------------------------------------------------------------------
	| Correus Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function enviarcorreu()
    {
        $data = Input::all();

        $rules = array(
            'mail_to' => 'required',
            'subject' => 'required',
            'message' => 'required',
        );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            return Redirect::to('enviarcorreu')
                ->withInput()->withFlashMessage('Error al enviar el correu.');

        } else {

            $mail = new Mail();

            $mail->mail_to = Input::get('mail_to');
            $mail->subject = Input::get('subject');
            $mail->message = Input::get('message');
            $mail->mail_from = Auth::user()->email;

            $mail->save();

            $id = $mail->id;
            $mail = Mail::find($id);

            $mail->update(array("thread" => $id));

            return Redirect::to('enviarcorreu');

        }
    }

    public function mostrarcorreu()
    {
        //entres al correu que selecciones. Si aquest no es unic (hi ha mes d'un correu en aquell thread)
        //se mostren tots los del thread en ordre de created_at
    }

    public function llistarcorreurebut()
    {
        //llista dels correus que has rebut.
    }

    public function llistarcorreuenviat()
    {
        //llista dels correus que has enviat..
    }

    public function contestarcorreu()
    {
        //es com enviarne un pero el numero de thread es igual al del missatge al que contestes
    }
}