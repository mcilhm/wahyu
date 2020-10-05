<?php

namespace App\Http\Controllers\Admin;

use App\Submission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SubmissionReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.submissionreport.index');
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
                b.`status_of_submission`,
                b.`result_all_file`,
                b.`result_exit_interview_file`
            FROM `employee` A
            INNER JOIN `submission` B ON a.`id` = b.`id_employee`
            WHERE b.`status_of_submission`= 4
            AND b.`id_activity` = 1
            AND b.`status_of_document` = 1
            AND b.`status_of_administration` = 1
            AND b.`status_of_exit_interview` = 1'
        );
        //  dd(DB::getQueryLog()); // Show results of log

        return Datatables::of($submission)
            ->addColumn('fullname',  function ($submission) {
                $action = $submission->first_name . " " . $submission->last_name;
                return $action;
            })
            ->addColumn('document',  function ($submission) {
                $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('administration',  function ($submission) {
                $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('exit_interview',  function ($submission) {
                $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('submission',  function ($submission) {
                $action = '<span class="btn btn-xs btn-success">Approved</span>';
                return $action;
            })
            ->addColumn('result_all_file',  function ($submission) {
                $action = '<div class="btn-group">
                <a href="submissionreport/' . $submission->id . '/download/result_all_file" title="Download File" class="btn btn-xs btn-default"><i class="fa fa-file"></i> ' . $submission->result_all_file . '
                </a>
                </div>';
                return $action;
            })
            ->addColumn('result_exit_interview_file',  function ($submission) {
                $action = '<div class="btn-group">
                <a href="submissionreport/' . $submission->id . '/download/result_exit_interview_file" title="Download File" class="btn btn-xs btn-default"><i class="fa fa-file"></i> ' . $submission->result_exit_interview_file . '
                </a>
                </div>';
                return $action;
            })
            ->rawColumns(['fullname', 'submission', 'document', 'exit_interview','administration', 'result_all_file', 'result_exit_interview_file'])
            ->make(true);
    }


    public function getdatapensiun()
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
                b.`status_of_submission`,
                b.`result_all_file`
            FROM `employee` A
            INNER JOIN `submission` B ON a.`id` = b.`id_employee`
            WHERE b.`status_of_submission`= 4
            AND b.`id_activity` = 2
            AND b.`status_of_document` = 1
            AND b.`status_of_administration` = 1'
        );
        //  dd(DB::getQueryLog()); // Show results of log

        return Datatables::of($submission)
            ->addColumn('fullname',  function ($submission) {
                $action = $submission->first_name . " " . $submission->last_name;
                return $action;
            })
            ->addColumn('submission',  function ($submission) {
                if ($submission->status_of_submission == 4)
                    $action = '<span class="btn btn-xs btn-success">Approved</span>';

                return $action;
            })
            ->addColumn('document',  function ($submission) {
                $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('administration',  function ($submission) {
                $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('result_all_file',  function ($submission) {
                $action = '<div class="btn-group">
                <a href="submissionreport/' . $submission->id . '/download" title="Download File" class="btn btn-xs btn-default"><i class="fa fa-file"></i> ' . $submission->result_all_file . '
                </a>
                </div>';
                return $action;
            })
            ->rawColumns(['fullname', 'submission', 'document', 'administration', 'result_all_file'])
            ->make(true);
    }

    public function getdataendedcontract()
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
                b.`status_of_submission`,
                b.`result_all_file`,
                b.`result_exit_interview_file`
            FROM `employee` A
            INNER JOIN `submission` B ON a.`id` = b.`id_employee`
            WHERE b.`status_of_submission`= 4
            AND b.`id_activity` = 3
            AND b.`status_of_document` = 1
            AND b.`status_of_administration` = 1'
        );
        //  dd(DB::getQueryLog()); // Show results of log

        return Datatables::of($submission)
            ->addColumn('fullname',  function ($submission) {
                $action = $submission->first_name . " " . $submission->last_name;
                return $action;
            })
            ->addColumn('submission',  function ($submission) {
                $action = '<span class="btn btn-xs btn-success">Approved</span>';
                return $action;
            })
            ->addColumn('document',  function ($submission) {
                $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('administration',  function ($submission) {
                $action = '<span class="btn btn-xs btn-success">Done</span>';
                return $action;
            })
            ->addColumn('result_all_file',  function ($submission) {
                $action = '<div class="btn-group">
                <a href="submissionreport/'. $submission->id . '/download" title="Download File" class="btn btn-xs btn-default"><i class="fa fa-file"></i> ' . $submission->result_all_file . '
                </a>
                </div>';
                return $action;
            })
            ->rawColumns(['fullname','submission', 'document', 'administration', 'result_all_file'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($id, $type)
    {
        try {
            if (!empty($id)) {
                if($type == 'result_exit_interview_file')
                {
                    $submission = Submission::where('id', $id)->first();
                    $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Content-Type: application/pdf'];
                    $newName = explode("/", $submission->result_exit_interview_file)[3];

                    Session::flash('success.message', 'Success download file');
                    return response()->download(public_path($submission->result_exit_interview_file), $newName, $headers);
                }
                else 
                {
                    $submission = Submission::where('id', $id)->first();
                    $headers = ['Content-Type: application/zip'];
                    $newName = explode("/", $submission->result_all_file)[3];

                    Session::flash('success.message', 'Success download file');
                    return response()->download(public_path($submission->result_all_file), $newName, $headers);
                }
            }

            Session::flash('error.message', 'Failed to download file');
            return redirect('submissionreport');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to download file');
            return redirect('submissionreport');
        }
    }
}
