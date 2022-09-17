<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Global_;
use TheSeer\Tokenizer\Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Backend\Teacher\teacherModel;
use App\Models\backend\teacher\teachers;

class teacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacherinfo = teachers::all();
        return view('backend/pages/manage-teacher', compact('teacherinfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addteacherview()
    {
        // $info=User::find(4)->teacher->name;
        // dd($info);
        return view('backend/pages/addteacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = '2';
        $GLOBALS['name'] = $request->name;
        $GLOBALS['age'] = $request->age;
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
                        DB::insert("insert into teachers(name,age,contact,email,password) values('" . $GLOBALS['name'] . "','" . $GLOBALS['age'] . "','" . $GLOBALS['contact'] . "','" . $GLOBALS['email'] . "','" . $GLOBALS['password'] . "')");
                       
                    });
                });

                if (is_null($exception)) {
                    $teacherinfo = teachers::all();
                    return view('backend/pages/manage-teacher', compact('teacherinfo'));
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
        $teacheredit = teachers::find($id);
        // dd($teacheredit);
        return view('backend/pages/editteacher', compact('teacheredit'));
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
        $updateteacher = teachers::find($id);
        $GLOBALS['updatename'] = $request->name;
        $GLOBALS['updateage'] = $request->age;
        $GLOBALS['updatecontact'] = $request->contact_no;
        $GLOBALS['updateemail'] = $request->email;

        $GLOBALS['updateid'] = $request->id;

        // $username1=teachers::find(1)->user; 
        // $username1=User::find(4)->teacher->name;

        // dd($username1);

        // $GLOBALS['username']=teachers::find($GLOBALS['updateemail'])->user->name;
        // $GLOBALS['useremail']=teachers::find($GLOBALS['updateemail'])->user->email;


        try {
            // Transaction
            $exception = DB::transaction(function () {

                DB::transaction(function () {
                    DB::update("update teachers  set name ='" . $GLOBALS['updatename'] . "',age='" . $GLOBALS['updateage'] . "',contact='" . $GLOBALS['updatecontact'] . "',email='" . $GLOBALS['updateemail'] . "' where id ='" . $GLOBALS['updateid'] . "'");
                    DB::update("update users  set name ='" . $GLOBALS['updatename'] . "',email='" . $GLOBALS['updateemail'] . "' where id ='" . $GLOBALS['updateid'] . "'");
        
                    return view('backend/pages/addteacher');
                });
            });

            if (is_null($exception)) {
                $teacherinfo = teachers::all();
                return view('backend/pages/manage-teacher', compact('teacherinfo'));
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

        // dd($GLOBALS['id']);

        $GLOBALS['userid'] = teachers::find($id)->user->id;
        // $username1=User::find($id)->teacher->name;
        // dd($GLOBALS['userid'] );

        try {
            // Transaction
            $exception = DB::transaction(function () {

                DB::transaction(function () {
                    DB::delete("delete from users where id='" . $GLOBALS['id'] . "'");
                    DB::delete("delete from teachers where id='" . $GLOBALS['userid'] . "'");

                    // dd($GLOBALS['userid']);

                    //   return back();
                    // return view('backend/pages/addteacher');
                });
                
            });
            if (is_null($exception)) {
                $teacherinfo = teachers::all();
                return view('backend/pages/manage-teacher', compact('teacherinfo'));
            } else {
                throw new Exception;
            }

          
        } catch (Exception $e) {
            return false;
        }
    }
}
