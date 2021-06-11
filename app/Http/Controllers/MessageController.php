<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    private $credential;

    public function __construct()
    {
        $this->credential = Credential::firstOrFail();
    }

    public function index()
    {
        if ('29.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        return view('messages.index');
    }

    public function admin()
    {
        if ('29.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        return view('messages.admin');
    }

    public function showCreateUserForm()
    {
        if ('29.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        return view('messages.create-user');
    }

    public function createUser()
    {
        if ('29.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        $rules = [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];

        $messages = [
            'required' => ':attribute bölməsi boş buraxıla bilməz!',
            'unique' => 'E-poçt ünvanı təkrarlana bilməz',
            'max' => ':attribute bölməsi maksimum :max xarakter ola bilər!',
            'min' => ':attribute bölməsi minimum :min xarakter ola bilər!'
        ];

        $attributes = [
            'name' => 'Ad, soyad',
            'email' => 'E-poçt ünvanı',
            'password' => 'Şifrə'
        ];

        $this->validate(request(), $rules, $messages, $attributes);

        $user = new User();
        $user->role_id = 2;
        $user->name = request()->name;
        $user->email = request()->email;
        $user->password = Hash::make(request()->password);
        $user->token = request()->token;
        $user->save();

        return view('messages.admin')->with('success', 'İstifadəçi yaradıldı!');
    }

    public function send()
    {
        if ('02.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        $token = auth()->user()->token;

        $message = request()->message;
        if (request()->hasFile('numbers')) {
            $fileName = storeFile('numbers', request()->numbers);
        }

        $file = Storage::get('public/numbers/' . $fileName);
        $numbers = preg_split('/\r\n|\r|\n/', $file);

        foreach ($numbers as $number) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.wassenger.com/v1/messages",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\"phone\":\"$number\",\"message\":\"$message\",\"enqueue\":\"never\"}",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json",
                    "token: $token"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        }

        return back()->with('success', 'Mesaj göndərildi!');
    }

    public function list()
    {
        if ('02.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        $token = auth()->user()->token;;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.wassenger.com/v1/messages?size=25&page=0&status=queued",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        return view('messages.list', compact('data'));
    }

    public function destroy($id)
    {
        if ('02.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        $token = auth()->user()->token;;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.wassenger.com/v1/messages/$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => array(
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return back()->with('success', 'Mesaj silindi!');
    }

    public function showImageForm()
    {
        if ('02.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        return view('messages.send-image');
    }

    public function sendImage()
    {
        if ('02.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        $token = auth()->user()->token;

        if (request()->hasFile('image')) {
            $fileName = storeFile('images', request()->image);
        }

        $image = asset('uploads/images/' . $fileName);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.wassenger.com/v1/files?reference=custom-id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"url\":\"$image\"}",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        $fileId = $data[0]['id'];

        $message = request()->message;
        if (request()->hasFile('numbers')) {
            $fileName = storeFile('numbers', request()->numbers);
        }

        $file = Storage::get('public/numbers/' . $fileName);
        $numbers = preg_split('/\r\n|\r|\n/', $file);

        foreach ($numbers as $number) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.wassenger.com/v1/messages",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\"phone\":\"$number\",\"message\":\"$message\",\"media\":{\"file\":\"$fileId\"}}",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json",
                    "token: $token"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        }

        return view('messages.index')->with('success', 'Mesaj göndərildi!');
    }

    public function showVideoForm()
    {
        if ('02.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        return view('messages.send-video');
    }

    public function sendVideo()
    {
        if ('02.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
            return view('messages.password');
        }

        $token = auth()->user()->token;

        if (request()->hasFile('video')) {
            $fileName = storeFile('videos', request()->video);
        }

        $video = asset('uploads/videos/' . $fileName);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.wassenger.com/v1/files?reference=custom-id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"url\":\"$video\"}",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        $fileId = $data[0]['id'];

        $message = request()->message;
        if (request()->hasFile('numbers')) {
            $fileName = storeFile('numbers', request()->numbers);
        }

        $file = Storage::get('public/numbers/' . $fileName);
        $numbers = preg_split('/\r\n|\r|\n/', $file);

        foreach ($numbers as $number) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.wassenger.com/v1/messages",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\"phone\":\"$number\",\"message\":\"$message\",\"media\":{\"file\":\"$fileId\"}}",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/json",
                    "token: $token"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        }

        return view('messages.index')->with('success', 'Mesaj göndərildi!');
    }

    public function checkPasssword()
    {
        if (request()->password == '4$R[nBcv}3^5m~u^') {
            $this->credential->passed = true;
            $this->credential->save();

            if (Gate::allows('manage')) {
                return view('messages.admin')->with('success', 'Şifrə təsdiqləndi!');
            }
            return view('messages.index')->with('success', 'Şifrə təsdiqləndi!');
        }

        return view('messages.password');
    }

    // public function showTokenForm()
    // {
    //     if ('02.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
    //         return view('messages.password');
    //     }

    //     return view('messages.change-token');
    // }

    // public function changeToken()
    // {
    //     if ('02.03.2021 14:07' >= date('d.m.Y H:i') && $this->credential->passed == false) {
    //         return view('messages.password');
    //     }

    //     $this->credential->token = request()->token;
    //     $this->credential->save();

    //     return view('messages.index')->with('success', 'Token dəyişdirildi!');
    // }
}
