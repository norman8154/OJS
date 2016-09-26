<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\AddSubject;
use DB;

class SubjectController extends Controller
{
    public function index()
    {

        return Redirect::to('/admin');
    }

    public function create()
    {

        if (Auth::guard('admin')->check()) {
            return view('admin.auth.addSubject');
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function store(Request $request)
    {

        if (Auth::guard('admin')->check()) {

            $add = new AddSubject();
            if($request -> file('uploadfile') != null) {
                $addr = '../answers/'.$request->topic;
                $file_name  = $request -> file('uploadfile') -> getClientOriginalName();
                $add->file = $file_name;
                $request->file('uploadfile')->move($addr, $file_name);
            }

            $add->topic = $request->topic;
            $add->detail = $request->detail;
            $add->input = $request->input;
            $add->output = $request->output;
            $add->deadline = date('Y-m-d H:i:s', mktime($request->h,$request->mm,00,$request->m,$request->d,$request->y));
            $add->save();

            $dir_path = "../answers/" . $request->topic;
            if (!is_dir($dir_path)) {
                mkdir("../answers/" . $request->topic, 0777, true);
            }

            $addr = '../answers/' . $request->topic . '/input.txt';
            $input_txt = fopen($addr, "w") or die("Unable to open file!");
            $txt = $request->input;
            fwrite($input_txt, $txt);
            fclose($input_txt);

            $addr = '../answers/' . $request->topic . '/output.txt';
            $output_txt = fopen($addr, "w") or die("Unable to open file!");
            $txt = $request->output;
            fwrite($output_txt, $txt);
            fclose($output_txt);

            return Redirect::to('/admin');
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function show($topicID)
    {
        if (Auth::guard('admin')->check()) {
            $subject = DB::select('select * from add_subjects where id = ?', [$topicID]);

            return view('admin.auth.upload', ['subject' => $subject[0]]);
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function destroy($topicID)
    {
        if (Auth::guard('admin')->check()) {
            $subject = AddSubject::findOrFail($topicID);
            $subject->destroy($topicID);
            $cmd = "cd ../answers\nrm -r " . $subject->topic . "\ncd ../submit\nrm -r " . $subject->topic;
            $xxx = popen($cmd,'r');
            pclose($xxx);

            return Redirect::to('/admin');
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function edit($topicID)
    {
        if (Auth::guard('admin')->check()) {
            $subject = DB::select('select * from add_subjects where id = ?', [$topicID]);

            return view('admin.auth.editSubject', ['subject' => $subject[0]]);
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function update(Request $request, $topicID)
    {
        if (Auth::guard('admin')->check()) {
            $subject = AddSubject::findOrFail($topicID);

            $subject->topic = $request->topic;
            $subject->detail = $request->detail;
            $subject->input = $request->input;
            $subject->output = $request->output;
            $subject->save();
            return Redirect::to('/admin');
        } else {
            return Redirect::to('admin/login');
        }
    }
}
