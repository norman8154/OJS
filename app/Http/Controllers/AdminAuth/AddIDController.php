<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;

class SubjectController extends Controller
{
   public function getAddID(Request $request){
	return view('admin.auth.addid');
   }

   public function postAddID(Request $request){
	$ids = $request->IDs;
	$seperator = "\r\n";
	$line = strtok($ids,$seperator);

	while($line !== false){
	     DB::table('student_ids')->insert(['ID' => $line]);
	     $line = strtok($seperator);
	}

	if ($request->hasFile('uploadfile') == true){
	    $path = '../public/';
	    $file_ext = $request->file('uploadfile')->getClientOriginalExtension();
	    $filename = 'StudentIDs'.'.'.$file_ext;

	    $request->file('uploadfile')->move($path, $filename);

	    $fp = fopen('../public/StudentIDs.txt', 'r');

            while (!feof($fp)) {
                $line = trim(fgets($fp));
                DB::table('student_ids')->insert(['ID' => $line]);
            }

            fclose($fp);
	}

	return redirect('/admin');
   }

}
