<?php

namespace App\Http\Controllers\Admin;

use App\Division;
use Carbon\Carbon;
use App\Submission;
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
        $division = Division::all();

        $division = DB::select('SELECT 
                                a.*,
                                (SELECT COUNT(`id`) FROM employee WHERE `division_id` = a.`id` AND `status_generated_ended_contract` = 1) count_ended
                                FROM division a');
        return view('pages.worklist.index', compact('employee', 'division'));
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

    public function getdataresign()
    {
        //  DB::enableQueryLog(); // Enable query log
        $submission = DB::select(
            'SELECT
                b.`id`,
                a.`no_reg`,
                a.`first_name`,
                a.`last_name`,
                b.`status_of_document`,
                b.`status_of_administration`,
                b.`status_of_exit_interview`,
                b.`status_of_submission`
            FROM `employee` A
            INNER JOIN `submission` B ON a.`id` = b.`id_employee`
            WHERE b.`status_of_submission`=:status_of_submission
            AND b.`id_activity` = 1
            AND (b.`status_of_document` != 1 OR b.`status_of_administration` != 1)',
            ['status_of_submission' => 4]
        );
        //  dd(DB::getQueryLog()); // Show results of log

        return Datatables::of($submission)
            ->addColumn('fullname',  function ($submission) {
                $action = $submission->first_name . " " . $submission->last_name;
                return $action;
            })
            ->addColumn('document',  function ($submission) {

                if ($submission->status_of_document == 0 || empty($submission->status_of_document))
                    $action = '<span class="btn btn-xs btn-danger">Not Yet</span>';
                else
                    $action = '<span class="btn btn-xs btn-success">Done</span>';

                return $action;
            })
            ->addColumn('administration',  function ($submission) {
                if ($submission->status_of_administration == 0 || empty($submission->status_of_administration))
                    $action = '<div class="btn-group">
                        <a href="worklist/updatestatusdocument/'.$submission->id.'"  data-id="' . $submission->id . '" title="Submit" class="sa-submit btn btn-xs btn-danger"> Not Yet
                        </a>
                        </div>';
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
                if ($submission->status_of_submission == 4)
                    $action = '<span class="btn btn-xs btn-success">Approved</span>';

                return $action;
            })
            ->rawColumns(['fullname', 'document', 'administration', 'exit_interview', 'submission'])
            ->make(true);
    }


    public function getdatapensiun()
    {
        // $employee = Employee::all();
        //  DB::enableQueryLog(); // Enable query log
        $submission = DB::select(
            'SELECT
                        a.`id`,
                        a.`no_reg`,
                        a.`first_name`,
                        a.`last_name`,
                        b.`status_of_document`,
                        b.`status_of_administration`,
                        b.`status_of_exit_interview`,
                        b.`status_of_submission`
                        FROM `employee` A
                        INNER JOIN `submission` B ON a.`id` = b.`id_employee`
                        WHERE b.`status_of_submission`=:status_of_submission
                        AND b.`id_activity` = 2
                        AND (b.`status_of_document` != 1 OR b.`status_of_administration` != 1)',
            ['status_of_submission' => 4]
        );
        //  dd(DB::getQueryLog()); // Show results of log

        return Datatables::of($submission)
            ->addColumn('fullname',  function ($submission) {
                $action = $submission->first_name . " " . $submission->last_name;
                return $action;
            })
            ->addColumn('document',  function ($submission) {

                if ($submission->status_of_document == 0 || empty($submission->status_of_document))
                    $action = '<span class="btn btn-xs btn-danger">Not Yet</span>';
                else
                    $action = '<span class="btn btn-xs btn-success">Done</span>';

                return $action;
            })
            ->addColumn('administration',  function ($submission) {
                if ($submission->status_of_administration == 0 || empty($submission->status_of_administration))
                    $action = '<span class="btn btn-xs btn-danger">Not Yet</span>';
                else
                    $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('submission',  function ($submission) {
                if ($submission->status_of_submission == 4)
                    $action = '<span class="btn btn-xs btn-success">Approved</span>';

                return $action;
            })
            ->rawColumns(['fullname', 'document', 'administration', 'exit_interview', 'submission'])
            ->make(true);
    }

    public function getdataendedcontract($id_division)
    {
        // DB::enableQueryLog(); // Enable query log
        //  $employee = Employee::where('status', 0)->where('status_generated_ended_contract', 1);
        if ($id_division == 0) {
            $employee = DB::select('SELECT
                        a.`id`,
                        a.`no_reg`,
                        a.`first_name`,
                        a.`last_name`,
                        b.`name` division_name,
                        c.`name` department_name,
                        e.`name` section_name,
                        d.`name` kelas_name,
                        a.`status_generated_ended_contract`
                        FROM `employee` A
                        INNER JOIN `division` B ON a.`division_id` = b.`id`
                        INNER JOIN `department` C ON a.`department_id` = C.`id`
                        INNER JOIN `kelas` D ON a.`kelas_id` = D.`id`
                        INNER JOIN `section` E ON a.`section_id` = E.`id`
                        WHERE A.`status`=:status
                        AND A.`status_generated_ended_contract` > 0', ['status' => 0]);
        } else {
            $employee = DB::select('SELECT
                        a.`id`,
                        a.`no_reg`,
                        a.`first_name`,
                        a.`last_name`,
                        b.`name` division_name,
                        c.`name` department_name,
                        e.`name` section_name,
                        d.`name` kelas_name,
                        a.`status_generated_ended_contract`
                        FROM `employee` A
                        INNER JOIN `division` B ON a.`division_id` = b.`id`
                        INNER JOIN `department` C ON a.`department_id` = C.`id`
                        INNER JOIN `kelas` D ON a.`kelas_id` = D.`id`
                        INNER JOIN `section` E ON a.`section_id` = E.`id`
                        WHERE A.`status`=:status
                        AND A.`status_generated_ended_contract` > 0
                        AND A.`division_id` = :division_id', ['status' => 0, "division_id" => $id_division]);
        }
        return Datatables::of($employee)
            ->addColumn('fullname',  function ($submission) {
                $action = $submission->first_name . " " . $submission->last_name;
                return $action;
            })
            ->addColumn('status_generated_ended_contract',  function ($employee) {
                if ($employee->status_generated_ended_contract == 1)
                    $action = '<span class="btn btn-xs btn-danger">Not Yet</span>';
                else
                    $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->rawColumns(['fullname', 'status_generated_ended_contract'])
            ->make(true);
    }

    public function generateendedcontract($id)
    {
        # code...

        $head_of_division = DB::table("employee")
            ->join('division', 'employee.division_id', "=", "division.id")
            ->select('employee.*', 'division.name')
            ->where('division_id', $id)
            ->where('position_id', 7)->first();

        $head_of_division_HRGA = DB::table("employee")
            ->join('division', 'employee.division_id', "=", "division.id")
            ->select('employee.*', 'division.name')
            ->where('division_id', 13)
            ->where('position_id', 7)->first();

        $ended_contract = DB::table("employee")
            ->join('department', 'employee.department_id', '=', 'department.id')
            ->select('employee.*', 'department.name')
            ->where('employee.division_id', $id)
            ->where('employee.status_generated_ended_contract', 1);

        if ($ended_contract->count() == 0) {

            Session::flash('error.message', 'No data to be generated');
            return redirect('worklist');
        }
        $employees = array();
        foreach ($ended_contract->get() as $row) {
            # code...
            $employee = array(
                'noreg'        => $row->no_reg,
                'employee_name' => $row->first_name . " " . $row->last_name,
                'dept_name'      => $row->name,
                'end_date'     => Carbon::parse($row->date_of_entry)->addYears(1)->format("d-m-Y"),
            );
            Submission::create([
                'id_employee' => $row->id,
                'date_of_ended_work' => Carbon::parse($row->date_of_entry)->addYears(1),
                'id_activity' => 3,
                'date_of_submission' => Carbon::now(),
                'reason_of_submission' => "Ended Contract"
            ]);

            array_push($employees, $employee);
        }
        // echo json_encode($employees);

        $template_file = "upload/template/";

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_file . "surat_ended_contract_to_divisi.docx");

        $templateProcessor->setValue('bulan', $this->getRomawi(date("m")));
        $templateProcessor->setValue('tahun', date("Y"));
        $templateProcessor->setValue('current_date', date("d m Y"));

        $templateProcessor->setValue('name_head_of_division', $head_of_division->first_name . " " . $head_of_division->last_name);
        $templateProcessor->setValue('div_name', $head_of_division->name);
        $templateProcessor->setValue('name_hrga', $head_of_division_HRGA->first_name . " " . $head_of_division_HRGA->last_name);

        $templateProcessor->cloneRowAndSetValues('noreg', $employees);

        // dd($template);
        $pathFile = 'upload/file/';
        $fileName = time() . '.docx';

        $templateProcessor->saveAs($pathFile . $fileName);


        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $newName = 'surat_ended_contract_to_divisi' . time() . '.docx';

        DB::table('employee')
            ->where('division_id', $id)
            ->where('status_generated_ended_contract', 1)
            ->update(['status_generated_ended_contract' => 2]);

        Session::flash('success.message', 'Success generated');
        return response()->download(public_path($pathFile . $fileName), $newName, $headers);
    }

    public function updateStatusDocument($id)
    {
        try {
            if (!empty($id)) {
                $submission = Submission::findOrFail($id);
                $submission->update(['status_of_administration' => 1]);
            }
            Session::flash('success.message', 'Success to update status administration');
            return redirect('worklist');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to update status administration');
            return redirect('worklist');
        }
    }

    private function getRomawi($bln)
    {
        switch ($bln) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }
}
