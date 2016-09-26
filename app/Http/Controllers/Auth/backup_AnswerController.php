<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Input, File;
use App\UploadFile;
use App\AddSubject;
use Illuminate\Http\Request;
use Auth;
use DB;

class AnswerController extends Controller
{

    public function postAnswer(Request $request)
    {
        if(Auth::check()) {
            if($request->hasFile('uploadfile') == false)
                return Redirect::back()->with('answer', '請上傳檔案');

            $topic = AddSubject::findOrFail($request->topicID);
            $a = $topic->topic;
            $addr = '../submit/' . $a . '/';

            $uploadfile = new UploadFile();
            $uploadfile->user = Auth::user()->name;
            $file_name = $request->file('uploadfile')->getClientOriginalName();
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $uploadfile->name = $file_name;
            $uploadfile->topicID = $request->topicID;
            $uploadfile->language = $file_ext;
            $store_name = Auth::user()->name . '.' . $file_ext;

            $input = '';
            $input = $this->get_input($topic->topic);
            if ($file_ext == 'cpp') {
                $store_name = Auth::user()->name . '.cpp';
                $cmd = "cd ../submit/" . $topic->topic . "\ngcc " . Auth::user()->name . ".cpp -o " . Auth::user()->name . ".out\necho " . $input . "|./" . Auth::user()->name . ".out\nrm " . Auth::user()->name . ".out";
            } else if ($file_ext == 'c') {
                $store_name = Auth::user()->name . '.c';
                $cmd = "cd ../submit/" . $topic->topic . "\ngcc " . Auth::user()->name . ".c -o " . Auth::user()->name . ".out\necho " . $input . "|./" . Auth::user()->name . ".out\nrm " . Auth::user()->name . ".out";
            } else {
                return Redirect::back()->with('answer', '請上傳C或C++檔');
            }
            $request->file('uploadfile')->move($addr, $store_name);

            $anspath = '../answers/' . $topic->topic . '/output.txt';
            $ans = fopen($anspath, 'r');
            $out = popen($cmd, 'r');
            $correct = 0;
            $wrong = 0;

            while ((!feof($ans)) || (!feof($out))) {
                $ans_buf = trim(fgets($ans));
                $out_buf = trim(fgets($out));
                echo 'ans:' . $ans_buf . ' ';
                echo 'input:' . $out_buf . '</br>';

                if (strcmp($ans_buf, $out_buf) == 0)
                    $correct++;
                else
                    $wrong++;
            }

            pclose($out);
            fclose($ans);

            if (($wrong == 0) && ($correct == 0)) {
                $result = 'RE';
                $uploadfile->result = $result;
            } else if ($wrong == 0) {
                $result = 'AC';
                $uploadfile->result = $result;
            } else {
                $result = 'WA ' . $wrong . ' wrong(s)';
                $uploadfile->result = 'WA';
            }
            $uploadfile->save();

            return Redirect::back()->with('answer', $result);
        }
        else{
            return Redirect::to('/login');
        }
    }

    public function get_input($topic)
    {
        $filepath = '../answers/' . $topic . '/input.txt';
        $result = '';

        $fp = fopen($filepath, 'r');

        while (!feof($fp)) {
            $line = fgets($fp);
            $line = trim($line);
            $result = $result . $line . ' ';
        }

        fclose($fp);

        return $result;
    }
}
