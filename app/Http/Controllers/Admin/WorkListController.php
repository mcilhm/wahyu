<?php

namespace App\Http\Controllers\Admin;

use App\Kelas;
use App\Section;
use App\Division;
use App\Employee;
use App\Position;
use App\Education;
use Carbon\Carbon;
use App\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class WorkListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employee = "";
        return view('pages.worklist.index', compact('employee'));
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
    public function store($id)
    {

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

    public function getdataapproved()
    {
        // $employee = Employee::all();
        //  DB::enableQueryLog(); // Enable query log
        $submission = DB::select('SELECT
                        a.`id`,
                        a.`no_reg`,
                        a.`first_name` fullname,
                        b.`status_of_document`,
                        b.`status_of_administration`,
                        b.`status_of_exit_interview`,
                        b.`status_of_submission`
                        FROM `employee` A
                        INNER JOIN `submission` B ON a.`id` = b.`id_employee`
                        WHERE b.`status_of_submission`=:status_of_submission',
                        ['status_of_submission' => 4]);
        //  dd(DB::getQueryLog()); // Show results of log

        return Datatables::of($submission)
            ->addColumn('document',  function ($submission) {

                if($submission->status_of_document == 0 || empty($submission->status_of_document))
                    $action = '<span class="btn btn-xs btn-danger">Not Yet</span>';
                else
                    $action = '<span class="btn btn-xs btn-success">Done</span>';

                return $action;
            })
            ->addColumn('administration',  function ($submission) {
                if($submission->status_of_administration == 0 || empty($submission->status_of_administration))
                    $action = '<span class="btn btn-xs btn-danger">Not Yet</span>';
                else
                    $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('exit_interview',  function ($submission) {
                if($submission->status_of_exit_interview == 0 || empty($submission->status_of_exit_interview))
                    $action = '<span class="btn btn-xs btn-danger">Not Yet</span>';
                else
                    $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('submission',  function ($submission) {
                if($submission->status_of_submission == 4)
                    $action = '<span class="btn btn-xs btn-success">Approved</span>';

                return $action;
            })
            ->rawColumns(['document', 'administration', 'exit_interview', 'submission'])
            ->make(true);
    }

    public function getdataendedcontract()
    {
        // DB::enableQueryLog(); // Enable query log
        //  $employee = Employee::where('status', 0)->where('status_generated_ended_contract', 1);

         $employee = DB::select('SELECT
                        a.`id`,
                        a.`no_reg`,
                        a.`first_name`,
                        b.`name` division_name,
                        c.`name` department_name,
                        e.`name` section_name,
                        d.`name` kelas_name
                        FROM `employee` A
                        INNER JOIN `division` B ON a.`division_id` = b.`id`
                        INNER JOIN `department` C ON a.`department_id` = C.`id`
                        INNER JOIN `kelas` D ON a.`kelas_id` = D.`id`
                        INNER JOIN `section` E ON a.`section_id` = E.`id`
                        WHERE A.`status`=:status
                        AND A.`status_generated_ended_contract` = 1', ['status' => 0]);
        // dd(DB::getQueryLog()); // Show results of log

         return Datatables::of($employee)->make(true);
    }
}
