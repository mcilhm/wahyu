<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Employee;
use App\Division;
use App\Department;
use App\Kelas;
use App\Section;
use App\Education;
use App\Position;
use DB;
use DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employee="";
        $division = Division::all();
        $department = Department::all();
        $kelas = Kelas::all();
        $section = Section::all();
        $education = Education::all();
        $position = Position::all();
        if($request->query('edit')){
            $employee = Employee::findOrFail($request->query('edit'));
        }
        return view('pages.employee.index', compact('employee','division', 'department', 'kelas' ,'section', 'education', 'position'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.employee.create');
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
                $employee = Employee::findOrFail($request->id);
                $employee->update([
                    'no_reg' => $request->no_reg,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'kelas_id' => $request->kelas_id,
                    'position_id' => $request->position_id,
                    'department_id' => $request->department_id,
                    'section_id' => $request->section_id,
                    'job_status' => $request->job_status,
                    'date_of_entry' => $request->date_of_entry,
                    'date_of_birthday' => $request->date_of_birthday,
                    'education_id' => $request->education_id,
                    'work_location' => $request->work_location,
                    'marital_status' => $request->marital_status,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'status' => $request->status,
                    'division_id' => $request->division_id
                ]);
            }
            else{
                $message = "Add";
                $employee = Employee::create([
                    'no_reg' => $request->no_reg,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'kelas_id' => $request->kelas_id,
                    'position_id' => $request->position_id,
                    'department_id' => $request->department_id,
                    'section_id' => $request->section_id,
                    'job_status' => $request->job_status,
                    'date_of_entry' => $request->date_of_entry,
                    'date_of_birthday' => $request->date_of_birthday,
                    'education_id' => $request->education_id,
                    'work_location' => $request->work_location,
                    'marital_status' => $request->marital_status,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'status' => $request->status,
                    'division_id' => $request->division_id
                ]);
            }

            \Session::flash('success.message', 'Success to '.$message);
            return redirect('employee');

        } catch(\Exception $e) {
            Log::error($ex->getMessage());
        	\Session::flash('error.message', 'Failed to '.$message);
            return redirect('employee');
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
        $delete = Employee::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }

    public function getdata()
    {
        // $employee = Employee::all();
        $employee = DB::select('SELECT
                        a.`id`,
                        a.`no_reg`,
                        a.`first_name`,
                        a.`last_name`,
                        a.`kelas_id`,
                        a.`position_id`,
                        a.`department_id`,
                        a.`section_id`,
                        a.`job_status`,
                        a.`date_of_entry`,
                        a.`date_of_birthday`,
                        a.`education_id`,
                        a.`work_location`,
                        a.`marital_status`,
                        a.`gender`,
                        a.`email`,
                        a.`phone_number`,
                        a.`photo`,
                        a.`status`,
                        a.`division_id`,
                        a.`created_at`,
                        a.`updated_at`,
                        b.`name` division_name,
                        c.`name` department_name,
                        d.`name` kelas_name,
                        e.`name` section_name,
                        f.`name` position_name,
                        g.`name` education_name
                        FROM `employee` A
                        INNER JOIN `division` B ON a.`division_id` = b.`id`
                        INNER JOIN `department` C ON a.`department_id` = C.`id`
                        INNER JOIN `kelas` D ON a.`kelas_id` = D.`id`
                        INNER JOIN `section` E ON a.`section_id` = E.`id`
                        INNER JOIN `position` F ON a.`position_id` = F.`id`
                        INNER JOIN `education` G ON a.`education_id` = G.`id`');
        return Datatables::of($employee)
            ->addColumn('action',  function ($employee){

            	$action = '<div class="btn-group"> <a href="employee?edit='.$employee->id.'" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                <a href="employee/delete/'.$employee->id.'"  data-id="'.$employee->id.'" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);

    }
}
