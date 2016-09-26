<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use Auth;
use Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $from = ['email' => env('MAIL_USERNAME', 'jackson90295@gmail.com'),
            'name' => 'NTUST_CSIE_OJS',
            'subject' => 'Your verify code'
        ];

        $to = ['email' => trim(Auth::user()->studentID) . "@mail.ntust.edu.tw",
            'name' => Auth::user()->name
        ];

        //echo 'email:'.$from['email'];

        $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $key = "";
        for ($i = 0; $i < 8; $i++) {
            $key .= $pattern{rand(0, 61)};
        }
        DB::table('verify_codes')->insert(['verify' => $key]);

        $verify_code = DB::table('verify_codes')->select('verify')->where('used', 0)->first();
        $data = ['verify_code' => $verify_code->verify];

        Mail::queue('emails.layout', $data, function ($message) use ($from, $to) {
            $message->from($from['email'], $from['name']);
            $message->to($to['email'], $to['name'])->subject($from['subject']);
        });

        DB::table('verify_codes')->where('verify', $verify_code->verify)->update(['used' => 1, 'owner' => Auth::user()->studentID]);

        return redirect('/verify');
    }

    public function resend()
    {
        $from = ['email' => env('MAIL_USERNAME', 'jackson90295@gmail.com'),
            'name' => 'NTUST_CSIE_OJS',
            'subject' => 'Your verify code'
        ];

        $to = ['email' => trim(Auth::user()->studentID) . "@mail.ntust.edu.tw",
            'name' => Auth::user()->name
        ];

        echo 'email:' . $from['email'];

        $verify_code = DB::table('verify_codes')->select('verify')->where('owner', Auth::user()->studentID)->first();
        $data = ['verify_code' => $verify_code->verify];

        Mail::queue('emails.layout', $data, function ($message) use ($from, $to) {
            $message->from($from['email'], $from['name']);
            $message->to($to['email'], $to['name'])->subject($from['subject']);
        });

        DB::table('verify_codes')->where('verify', $verify_code->verify)->update(['used' => 1, 'owner' => Auth::user()->studentID]);

        return redirect('/verify');
    }
}
