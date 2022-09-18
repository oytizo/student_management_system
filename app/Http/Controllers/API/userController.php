<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\frontend\teacher\students;

class userController extends Controller
{
   public function index(Request $request)
   {
      $input = $request->all();
      // $userid = User::find($input['email'])->teacher->id;
      $email = User::where('email', $input['s_email'])->first();
      $GLOBALS['name']=$input['s_name'];
      $GLOBALS['course_name']=$input['course_name'];
      $GLOBALS['contact']=$input['contact_no'];
      $GLOBALS['email']=$input['s_email'];
      $GLOBALS['role']='2';
      $GLOBALS['user_id']=$input['t_id'];
      $GLOBALS['password']=hash::make($input['s_password']);



      $validated = Validator::make($input, [
         'email' => 'required|email',
         's_email' => 'required|email',
         'password' => 'required',
         's_name' => 'required|string|max:255',
         'course_name' => 'required|string||max:255',
         'contact_no' =>'required',
         's_password' =>'required',
      ]);

      if ($validated->fails()) {
         return response()->json(['error' => $validated->errors()->all()], 422);
      }
      if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {

         if (!$email) {

            try {
                // Transaction
                $exception = DB::transaction(function () {

                    DB::transaction(function () {

                        DB::insert("insert into users(name,email,role,password) values('" . $GLOBALS['name'] . "','" . $GLOBALS['email'] . "','" . $GLOBALS['role'] . "','" . $GLOBALS['password'] . "')");
                        DB::insert("insert into students(name,course_name,contact,t_id,email,password) values('" . $GLOBALS['name'] . "','" . $GLOBALS['course_name'] . "','" . $GLOBALS['contact'] . "','" . $GLOBALS['user_id'] . "','" . $GLOBALS['email'] . "','" . $GLOBALS['password'] . "')");
                        //   return back();
                        // return view('backend/pages/addteacher');
                    });
                });

                if (is_null($exception)) {
                    return 'Successfully Insert';
                } else {
                    throw new Exception;
                }
            } catch (Exception $e) {
                return 'Unsuccessful Insert';
            }
        } else {
            return 'This Email Already Taken';
        }

         
      } else {
         return 'no';
      }
   }
}
