<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\AddSubject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;

class SubjectController extends Controller
{
    public function index()
    {
        return Redirect::to('/');
    }


    public function show($topicID)
    {

        $subject = DB::select('select * from add_subjects where id = ?', [$topicID]);

        if (Auth::check()) {
            if($this->check_verification()) {
                $online_count = DB::table('users')->where('online', 'on')->count();
                return view('auth.upload', ['subject' => $subject[0], 'online_count' => $online_count]);
            }
            else{
                return Redirect::to('/verify');
            }
        }
        return view('auth.upload', ['subject' => $subject[0]]);

    }

    public function getTopic()
    {
        if (Auth::check()) {
            if($this->check_verification()) {
                $subjects = DB::select('select * from add_subjects ORDER by id DESC ');
                $results = DB::select('select * from judge_results where user = ?', [Auth::user()->studentID]);
                $topic_result = [];
                foreach ($subjects as $subject) {
                    $has_result = false;
                    foreach ($results as $result) {
                        if ($subject->id == $result->topicID) {
                            $has_result = true;
                            $score = $result->result;
                        }
                    }
                    if ($has_result) {
                        $topic_result[] = $score;
                    } else {
                        $topic_result[] = "";
                    }
                }
                $online_count = DB::table('users')->where('online', 'on')->count();
                return view('welcome', ['subject' => $subjects, 'online_count' => $online_count, 'topic_result' => $topic_result]);
            }
            else{
                return Redirect::to('/verify');
            }
        } else {
            $subjects = DB::select('select * from add_subjects ORDER by id DESC ');
            return view('welcome', ['subject' => $subjects]);
        }


    }

    public function getVerify(Request $request){
        return view('auth.verify',['online_count' => null]);
    }

    public function postVerify(Request $request){
        $check_verify = DB::table('verify_codes')->where([['verify',$request->verify],['owner',Auth::user()->studentID]])->get();

        if(current($check_verify) != NULL){
            DB::table('verify_codes')->where('verify',$request->verify)->delete();
            DB::table('users')->where('studentID',Auth::user()->studentID)->update(['verified' => 1]);
        }else{
            return redirect('/verify')->with('NotFound',true)->with('message','Wrong code.');
        }

        return redirect('/');
    }

    public function check_verification(){
        $verified = DB::table('users')->where([['studentID',Auth::user()->studentID],['verified',0]])->get();

        if(current($verified) != NULL)
            return false;

        return true;
    }

    public function download_file(Request $request){
        $subject = AddSubject::findOrFail($request -> topicID);
        $filename = $subject->file;
        $myFile = '../answers/'.$subject->topic.'/'.$filename;

        $mm_type="application/octet-stream";

        header("Cache-Control: public, must-revalidate");
        header("Pragma: hack"); // WTF? oh well, it works...
        header("Content-Type: " . $mm_type);
        header("Content-Length: " .(string)(filesize($myFile)) );
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header("Content-Transfer-Encoding: binary\n");
        readfile($myFile);
    }


}
