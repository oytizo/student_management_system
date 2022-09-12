<?php

namespace App\Http\Controllers\frontend\teacher;

use App\Models\User;
use Illuminate\Http\Request;
use Psy\Exception\Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\frontend\teacher\studenttable;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = '3';
        $GLOBALS['name'] = $request->name;
        $GLOBALS['course_name'] = $request->course_name;
        $GLOBALS['contact'] = $request->contact_no;
        $GLOBALS['email'] = $request->email;
        $GLOBALS['role'] = $role;
        $GLOBALS['password'] = Hash::make($request->password);

        $email = User::where('email', $GLOBALS['email'])->first();
        // dd($email);

        if (!$email) {

            try {
                // Transaction
                $exception = DB::transaction(function () {

                    DB::transaction(function () {
                        DB::insert("insert into users(name,email,role,password) values('" . $GLOBALS['name'] . "','" . $GLOBALS['email'] . "','" . $GLOBALS['role'] . "','" . $GLOBALS['password'] . "')");
                        DB::insert("insert into studenttables(name,course_name,contact,email,password) values('" . $GLOBALS['name'] . "','" . $GLOBALS['course_name'] . "','" . $GLOBALS['contact'] . "','" . $GLOBALS['email'] . "','" . $GLOBALS['password'] . "')");
                        //   return back();
                        return view('backend/pages/addteacher');
                    });
                });

                if (is_null($exception)) {
                    $studentinfo = studenttable::all();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
