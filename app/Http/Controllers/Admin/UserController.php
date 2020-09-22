<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = "";
        $role = Role::All();
        $employee = DB::table('employee')
            ->whereNotExists(function ($query) {
                $query->select('users.username')
                    ->from('users')
                    ->whereRaw('employee.no_reg = users.username');
            })
            ->get();
        if ($request->query('edit')) {
            $user = User::findOrFail($request->query('edit'));
            $employee = Employee::All();
        }
        return view('pages.user.index', compact('user', 'role', 'employee'));
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
        $message = "";
        try {
            if (!empty($request->id)) {
                $message = "Edit";
                $user = User::findOrFail($request->id);

                if (empty($request->password)) {
                    $user->update([
                        'role_id' => $request->role_id,
                    ]);
                } else {
                    $user->update([
                        'password' => bcrypt($request->password),
                        'role_id' => $request->role_id,
                    ]);
                }
            } else {
                $message = "Add";
                $employee = Employee::where('no_reg', $request->username)->first();
                $user = User::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'user_type' => '1',
                    'employee_id' => $employee->id,
                    'role_id' => $request->role_id,
                ]);
            }

            Session::flash('success.message', 'Success to ' . $message);
            return redirect('user');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to ' . $message);
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

        Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
        $user = DB::select('SELECT
                    A.`id`,
                    A.`username`,
                    B.`name` role_name
                    FROM users A
                    INNER JOIN role B ON A.`role_id` = B.`id`');
        return Datatables::of($user)

            ->addColumn('action',  function ($user) {

                $action = '<div class="btn-group"> <a href="user?edit=' . $user->id . '" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                <a href="user/delete/' . $user->id . '"  data-id="' . $user->id . '" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);
    }
}
