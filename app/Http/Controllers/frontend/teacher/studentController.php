<?php

namespace App\Http\Controllers\frontend\teacher;

use App\Models\User;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\backend\teacher\teachers;
use App\Models\frontend\teacher\students;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend/teacher/addstudent');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $u_id = Auth::user()->id;
        $userid = User::find($u_id)->teacher->id;

        $studentinfo = students::where('t_id', $userid)->get();
        return view('frontend/teacher/manage-student', compact('studentinfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'course_name' => 'required|string||max:255',
            'email' => 'required|email|unique:users|max:255',
            'contact_no' =>'required',
        ]);
        $role = '3';
        $GLOBALS['name'] = $request->name;
        $GLOBALS['course_name'] = $request->course_name;
        $GLOBALS['contact'] = $request->contact_no;
        $GLOBALS['email'] = $request->email;
        $GLOBALS['role'] = $role;
        $GLOBALS['password'] = Hash::make($request->password);

        $email = User::where('email', $GLOBALS['email'])->first();
        // dd($email);
        $u_id = Auth::user()->id;
        $userid = User::find($u_id)->teacher->id;
        // $studentinfo=teachers::find(3)->student->name;

        $GLOBALS['user_id'] = $userid;

        // dd($userid);

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
                    $studentinfo = students::where('t_id', $GLOBALS['user_id'])->get();
                    return view('frontend/teacher/manage-student', compact('studentinfo'));
                } else {
                    throw new Exception;
                }
            } catch (Exception $e) {
                return false;
            }
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studentinfo = students::find($id);
        return view('frontend/teacher/editstudent', compact('studentinfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request, $id)
    {
        $updateteacher = students::find($id);
        $GLOBALS['updatename'] = $request->name;
        $GLOBALS['updatecourse'] = $request->course_name;
        $GLOBALS['updatecontact'] = $request->contact_no;
        $GLOBALS['updateemail'] = $request->email;
        $GLOBALS['updateid'] = $id;

        try {
            // Transaction
            $exception = DB::transaction(function () {

                DB::transaction(function () {
                    DB::update("update students  set name ='" . $GLOBALS['updatename'] . "',course_name='" . $GLOBALS['updatecourse'] . "',contact='" . $GLOBALS['updatecontact'] . "',email='" . $GLOBALS['updateemail'] . "' where id ='" . $GLOBALS['updateid'] . "'");
                    DB::update("update users  set name ='" . $GLOBALS['updatename'] . "',email='" . $GLOBALS['updateemail'] . "' where id ='" . $GLOBALS['updateid'] . "'");
                });
            });

            if (is_null($exception)) {
                $studentinfo = students::all();
                return view('frontend/teacher/manage-student', compact('studentinfo'));
            } else {
                throw new Exception;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $GLOBALS['id'] = $id;
        $GLOBALS['userid'] = students::find($id)->user->id;
        try {
            // Transaction
            $exception = DB::transaction(function () {
                DB::transaction(function () {
                    DB::delete("delete from users where id='" . $GLOBALS['userid'] . "'");
                    DB::delete("delete from students where id='" . $GLOBALS['id'] . "'");
                });        
            });
            if (is_null($exception)) {
                $studentinfo = students::all();
                return view('frontend/teacher/manage-student', compact('studentinfo'));
            } else {
                throw new Exception;
            }

          
        } catch (Exception $e) {
            return false;
        }
    }
    
}
