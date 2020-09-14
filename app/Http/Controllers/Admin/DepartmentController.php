<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Division;
use App\Department;
use App\Section;
use DataTables;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $department="";
        $division = Division::all();
        if($request->query('edit')){
            $department = Department::findOrFail($request->query('edit'));
        }
        return view('pages.department.index', compact('department', 'division'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.department.create');
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
            if(!empty($request->id))
            {
                $message = "Edit";
                $department = Department::findOrFail($request->id);
                $department->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'division_id' => $request->division_id,
                ]);
            }
            else
            {
                $message = "Add";
                $department = Department::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'division_id' => $request->division_id,
                ]);
            }

            \Session::flash('success.message', 'Success to '.$message);
           return redirect('department');

        } catch(\Exception $e) {
            Log::error($ex->getMessage());
        	\Session::flash('error.message', 'Failed to '.$message);
            return redirect('department');
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
        $delete = Department::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
        // $department = Department::all();

        $department = DB::select('SELECT
                        A.`id`,
                        A.`name`,
                        A.`description`,
                        B.`name` division_name
                        FROM `department` A
                        LEFT JOIN `division` B ON A.`division_id` = B.`id`');
        return Datatables::of($department)

            ->addColumn('action',  function ($department) {

            	$action = '<div class="btn-group"> <a href="department?edit='.$department->id.'" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                <a href="department/delete/'.$department->id.'"  data-id="'.$department->id.'" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);

    }

    public function getSection($id) {
        return Section::select('id', 'name')->where('department_id', $id)->get();
    }
}
