<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class HomeController extends Controller
{
    public function mail()
    {
        echo "fgh";exit;
        //$user = User::find(1)->toArray();
        $user = ["name"=>"amit","email" => 'amitojha@matrixnmedia.com'];
        Mail::send('test_mail', $user, function($message) use ($user) {
            $message->from($user['email']);
            $message->to($user['email']);
            $message->subject('Mail Testing');
        });
        dd('Mail Send Successfully');
    }
}
