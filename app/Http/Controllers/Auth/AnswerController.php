<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\JudgeResult;
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
        if (Auth::check()) {
            if ($request->hasFile('uploadfile') == false)
                return Redirect::back()->with('answer', '請上傳檔案');

            $topic = AddSubject::findOrFail($request->topicID);
            $a = $topic->topic;
            $addr = '../submit/' . $a . '/';

            $uploadfile = new UploadFile();
            $uploadfile->user = Auth::user()->studentID;
            $file_name = $request->file('uploadfile')->getClientOriginalName();
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $uploadfile->name = $file_name;
            $uploadfile->topicID = $request->topicID;
            $uploadfile->language = $file_ext;
            $store_name = Auth::user()->studentID . '.' . $file_ext;

            $judge_result = JudgeResult::where('topicID', $request->topicID)->where('user', Auth::user()->studentID)->first();
            if($judge_result == null){
                $judge_result = new JudgeResult();
                $judge_result->user = Auth::user()->studentID;
                $judge_result->topicID = $request->topicID;
            }


            $input = $this->get_input($topic->topic);
            if ($file_ext == 'cpp') {
                $cmd = "cd ../submit/" . $topic->topic . "\ng++ " . Auth::user()->studentID . ".c -o " . Auth::user()->studentID . ".out\nts=\$(date +%s%N)\n/usr/local/bin/time -f \"MEM:\\n%D\n\" -o " . Auth::user()->studentID . "_mem.txt echo " . $input . "|./" . Auth::user()->studentID . ".out\ntt=\$((($(date +%s%N) - \$ts)/1000000))\nprintf \"TIME:\\n\$tt\\n\"";
                $del_cmd = "cd ../submit/" . $topic->topic . "\nrm " . Auth::user()->studentID . ".out\nrm " . Auth::user()->studentID . "_mem.txt";
            } else if ($file_ext == 'c') {
                $cmd = "cd ../submit/" . $topic->topic . "\ngcc -std=gnu11 " . Auth::user()->studentID . ".c -o " . Auth::user()->studentID . ".out\nts=\$(date +%s%N)\n/usr/local/bin/time -f \"MEM:\\n%D\n\" -o " . Auth::user()->studentID . "_mem.txt echo " . $input . "|./" . Auth::user()->studentID . ".out\ntt=\$((($(date +%s%N) - \$ts)/1000000))\nprintf \"TIME:\\n\$tt\\n\"";
                $del_cmd = "cd ../submit/" . $topic->topic . "\nrm " . Auth::user()->studentID . ".out\nrm " . Auth::user()->studentID . "_mem.txt";
            } else {
                return Redirect::back()->with('answer', '請上傳C或C++檔');
            }
            $request->file('uploadfile')->move($addr, $store_name);

            $anspath = '../answers/' . $topic->topic . '/output.txt';
            $ans = fopen($anspath, 'r');
            $out = popen($cmd, 'r');

            $correct = 0;
            $wrong = 0;
//            echo $cmd . '<br>';
//            echo $del_cmd . '<br>';
            $start = 1;
            while ((!feof($ans)) || (!feof($out))) {

                $out_buf = trim(fgets($out));
                if (strlen($out_buf) == 0 && $start == 1)
                    break;
                if (strcmp($out_buf, "TIME:") == 0) {
                    $out_buf = trim(fgets($out));
                    $judge_result->time = (int)$out_buf;
                    //echo 'TIME:' . $out_buf . 'mS</br>';
                } else {
                    $start = 0;
                    $ans_buf = trim(fgets($ans));
                    //echo 'ans:' . $ans_buf . ' ';
                    //echo 'input:' . $out_buf . '</br>';

                    if (strcmp($ans_buf, $out_buf) == 0)
                        $correct++;
                    else
                        $wrong++;
                }

            }

            pclose($out);
            fclose($ans);

            $mempath = '../submit/' . $topic->topic . '/' . Auth::user()->studentID . '_mem.txt';

            $mem_out = fopen($mempath, 'r');
            if ($mem_out != null) {
                while (!feof($mem_out)) {
                    $mem_buf = trim(fgets($mem_out));
                    if (strcmp($mem_buf, "MEM:") == 0) {
                        $mem_buf = trim(fgets($mem_out));
                        //echo 'MEM:' . $mem_buf . 'KB<br>';
                        $judge_result->memory = (int)$mem_buf;
                    }
                }
            }

            $del_out = popen($del_cmd, 'r');

            pclose($del_out);


            if (($wrong == 0) && ($correct == 0)) {
                $result = 'RE';
                $uploadfile->result = $result;
                $judge_result->result = $result;
            } else if ($wrong == 0) {
                $result = 'AC';
                $uploadfile->result = $result;
                $judge_result->result = $result;
            } else {
                $result = 'WA ' . $wrong . ' wrong(s)';
                $uploadfile->result = 'WA';
                $judge_result->result = 'WA';
            }
            $uploadfile->save();
            $judge_result->save();


            $result = $result." Time: ".$judge_result->time."ms, Mem: ".$judge_result->memory."KB";

            return Redirect::back()->with('answer', $result);
            //return view('/test');
        } else {
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