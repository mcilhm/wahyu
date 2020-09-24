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

class EndedContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.endedcontract.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.endedcontract.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        try {
            if (!empty($id)) {
                $employee = Employee::findOrFail($id);
                $employee->update(['status_generated_ended_contract' => 1]);
            }
            Session::flash('success.message', 'Success to update status generated ended contract');
            return redirect('endedcontract/');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to update status generated ended contract');
            return redirect('endedcontract/');
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

    public function getdata()
    {
        // $employee = Employee::all();
        // DB::enableQueryLog(); // Enable query log
        $employee = DB::select('SELECT
                        a.`id`,
                        a.`no_reg`,
                        a.`first_name`,
                        a.`last_name`,
                        a.`division_id`,
                        a.`department_id`,
                        a.`section_id`,
                        a.`position_id`,
                        a.`date_of_entry`,
                        a.`email`,
                        a.`created_at`,
                        a.`updated_at`,
                        b.`name` division_name,
                        c.`name` department_name,
                        e.`name` section_name,
                        d.`name` kelas_name
                        FROM `employee` A
                        INNER JOIN `division` B ON a.`division_id` = b.`id`
                        INNER JOIN `department` C ON a.`department_id` = C.`id`
                        INNER JOIN `kelas` D ON a.`kelas_id` = D.`id`
                        INNER JOIN `section` E ON a.`section_id` = E.`id`
                        INNER JOIN `position` F ON a.`position_id` = F.`id`
                        WHERE A.`status`=:status
                        AND (DATEDIFF(DATE_ADD(date_of_entry, INTERVAL 1 YEAR), :getdate) <= 60)
                        AND A.`status_generated_ended_contract` != 1', ['status' => 0, 'getdate' => Carbon::today()->toDateString()]);
        // dd(DB::getQueryLog()); // Show results of log

        return Datatables::of($employee)
            ->addColumn('action',  function ($employee) {

                $action = '
                <div class="btn-group">
                    <a href="endedcontract/' . $employee->id . '" data-id="' . $employee->id . '" title="Updated" class="sa-submit btn btn-xs btn-warning">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>';

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
