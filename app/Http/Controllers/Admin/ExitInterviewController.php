<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use Carbon\Carbon;
use App\Submission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExitInterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $interview = null;
        if ($request->query('edit')) {
            $interview = DB::table('submission')
                ->join('employee', 'submission.id_employee', '=', 'employee.id')
                ->select('submission.*', 'employee.no_reg')
                ->where('submission.id', $request->query('edit'))
                ->first();
        }
        return view('pages.exitinterview.index', compact('interview'));
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
        try {
            if (!empty($request->id)) {
                $submission = Submission::findOrFail($request->id);
                $employee = Employee::where('id', $submission->id_employee)->first();
                $tmpFolderPath = 'upload/result/interview/' . $employee->no_reg;

                $fileName = str_replace(' ', '-', ($employee->first_name . ' ' . $employee->last_name)) . '-' . time() . '.' . $request->result_exit_interview_file->getClientOriginalExtension();
                $request->result_exit_interview_file->move($tmpFolderPath, $fileName);
                $submission->update([
                    'result_exit_interview_file' => $tmpFolderPath . $fileName,
                    'status_of_exit_interview' => 1,
                    'reason_of_resign' => $request->reason_of_resign
                ]);
            } else {
                Session::flash('error.message', 'Failed to update exit interview');
                return redirect('exitinterview/');
            }
            Session::flash('success.message', 'Success to update exit interview');
            return redirect('exitinterview/');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to update exit interview');
            return redirect('exitinterview/');
        }
    }

    /**
     * method for set data in datagrid blade
     */
    public function getdata()
    {
        //$Submission = Submission::where('id_employee', $id_employee)->get();

        $submission = DB::select(
            'SELECT
                        a.`id`,
                        a.`id_employee`,
                        b.`first_name` full_name,
                        a.`date_of_ended_work`,
                        a.`date_of_interview`,
                        a.`reason_of_submission`,
                        a.`status_of_submission`,
                        c.`activity_name` type_submission
                        FROM `submission` A
                        INNER JOIN `employee` B ON A.`id_employee` = B.`id`
                        INNER JOIN `activity` C ON A.`id_activity` = C.`id`
                        WHERE a.`status_of_submission` = :status_of_submission
                        AND a.`date_of_interview` IS NOT NULL
                        AND a.`status_of_exit_interview` = 0',
            ['status_of_submission' => 4]
        );
        return Datatables::of($submission)
            ->addColumn('status',  function ($submission) {
                $style_btn = "";
                $name_btn = "";
                if ($submission->status_of_submission == 0) {
                    $style_btn = "btn-primary";
                    $name_btn = "first submission";
                } else if ($submission->status_of_submission == 2) {
                    $style_btn = "btn-info";
                    $name_btn = "head division";
                } else if ($submission->status_of_submission == 3) {
                    $style_btn = "btn-warning";
                    $name_btn = "staff ir";
                } else if ($submission->status_of_submission == 4) {
                    $style_btn = "btn-success";
                    $name_btn = "approved";
                }
                $action = '<div class="btn-group"><span class="btn btn-xs ' . $style_btn . '">' . $name_btn . '</span></div>';
                return $action;
            })
            ->addColumn('exit_interview', function ($submission) {

                $action = '<div class="btn-group">
                    <a href="exitinterview?edit=' . $submission->id . '" data-toggle="tooltip" title="Update" class="btn btn-xs btn-danger">Exit Interview </a>
                    </div>';
                return $action;
            })
            ->rawColumns(['status', 'exit_interview'])
            ->make(true);
    }
}
