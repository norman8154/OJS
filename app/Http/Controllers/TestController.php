<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use Input, File;

class TestController extends Controller
{
    public function testcmp(Request $request)
    {
        $ac_outs = DB::select('select r.user, s.topic from judge_results r, add_subjects s
                                where r.result = "AC" and r.topicID = ? and r.topicID = s.id', [$request->topicID]);
        for ($self = 0; $self < count($ac_outs) - 1; $self++) {
            for ($other = $self + 1; $other < count($ac_outs); $other++) {
                $cmp_cmd = "cd ../submit/" . $ac_outs[$other]->topic . "\nxxd "
                    . $ac_outs[$self]->user . ".out > " . $ac_outs[$self]->user . ".hex\nxxd "
                    . $ac_outs[$other]->user . ".out > " . $ac_outs[$other]->user . ".hex\ndiff -y --suppress-common-lines "
                    . $ac_outs[$self]->user . ".hex " . $ac_outs[$other]->user . ".hex\nrm "
                    . $ac_outs[$self]->user . ".hex\nrm " . $ac_outs[$other]->user . ".hex";
//                echo $cmp_cmd . '<br>';
                $cmp_out = popen($cmp_cmd, 'r');
                $diff = 0;
                while (!feof($cmp_out)) {
                    $out = fgets($cmp_out);
                    if ($out == null)
                        break;
//                    echo $out . '<br>';
                    $diff++;
                }
//                echo fread($cmp_out, 4096);
                pclose($cmp_out);
                echo $ac_outs[$self]->user . ', ' . $ac_outs[$other]->user . ' diff: ' . $diff . '<br>';
            }
        }
        return view('test');
    }

    public function getTest()
    {
        return view('test');
    }
}