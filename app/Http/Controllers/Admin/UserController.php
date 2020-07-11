<?php

namespace App\Http\Controllers;
use App\User;
use DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user="";
        if($request->query('edit')){
            $user = User::findOrFail($request->query('edit'));
        }
        return view('pages.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if(!empty($request->id))
            {
                $user = User::findOrFail($request->id);
                $user->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'user_fullname' => $request->user_fullname,
                    'user_email' => $request->user_email
                ]);
            }
            else
            {
                $user = User::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'user_fullname' => $request->user_fullname,
                    'user_email' => $request->user_email,
                    'user_level' => '0'
                ]);
            }

            \Session::flash('success.message', 'Success to Add');
           return redirect('user');

        } catch(\Exception $e) {
        	\Session::flash('error.message', 'Failed to Add');
            return redirect('user');
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
        $delete = User::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
    	$user = User::all();
        return Datatables::of($user)

            ->addColumn('action',  function ($user) { 

            	$action = '<div class="btn-group"> <a href="user?edit='.$user->id.'" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> 
                <a href="user/delete/'.$user->id.'"  data-id="'.$user->id.'" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })
            
            ->rawColumns(['action'])
            ->make(true);

    }
}
