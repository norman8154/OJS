<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;

class RankingController extends Controller
{
    public function getTotalRanking()
    {
        /*$user_name = DB::table('users');
        $subject = DB::table('judge_results')->select(DB::raw('count(*) as count,name'))
            ->union($user_name)
            ->where('result', 'AC')
            ->orWhere('users.studentID', 'judge_results.user')
            ->groupBy('name')
            ->orderBy('count', 'desc')
            ->get();*/
        $subject = DB::select('select count(*) as count, u.name 
                                from users u, judge_results r 
                                where u.studentID = r.user and r.result = "AC"
                                group by u.name
                                order by count desc');
        $topic_count = DB::select('select id, topic from add_subjects');
        $each_topic = [];
        foreach ($topic_count as $topic) {
            $each_topic[$topic->topic] = DB::select('select u.name, r.time, r.memory, r.updated_at 
                                                      from add_subjects s, judge_results r, users u 
                                                      where s.id = ? and s.id = r.topicID and r.result = "AC" and r.updated_at < s.deadline and u.studentID = r.user
                                                      order by r.time asc, r.memory asc, r.updated_at asc', [$topic->id]);
        }


        if (Auth::check()) {
            $online_count = DB::table('users')->where('online', 'on')->count();
            return view('/ranking', ['subject' => $subject, 'online_count' => $online_count, 'topic_count' => $topic_count, 'each_topic' => $each_topic]);
        }
        return view('/ranking', ['subject' => $subject, 'topic_count' => $topic_count, 'each_topic' => $each_topic]);
    }
}