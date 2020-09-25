<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use Carbon\Carbon;
use App\Submission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, $activity)
    {
        $id_activity = $activity;
        $submission = "";
        if ($request->query('edit')) {
            $submission = Submission::findOrFail($request->query('edit'));
        }
        return view('pages.submission.index', compact('submission', 'id_activity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.submission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_activity)
    {
        try {
            $activity = Activity::where('id', $id_activity)->first();
            if ($request->hasfile('file_lampiran')) {
                $tmpFolderPath = 'upload/submission/' . session("no_reg");
                $fileName = str_replace(' ', '-', $activity->activity_name) . '-' . str_replace(' ', '-', session("employee_name")) . '-' . time() . '.' . $request->file_lampiran->getClientOriginalExtension();
                $request->file_lampiran->move($tmpFolderPath, $fileName);

                Submission::create([
                    'id_employee' => Auth::user()->employee_id,
                    'date_of_ended_work' => $request->date_of_ended_work,
                    'id_activity' => $id_activity,
                    'date_of_submission' => Carbon::now(),
                    'reason_of_submission' => $request->reason_of_submission,
                    'submission_file' => $tmpFolderPath . $fileName
                ]);
                Session::flash('success.message', 'Success to create submission');
                return redirect('submission/' . $id_activity);
            } else {
                Session::flash('error.message', 'Failed to create submission');
                return redirect('submission/' . $id_activity);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to create submission');
            return redirect('submission/' . $id_activity);
        }
    }

    /**
     * method for set data in datagrid blade
     */
    public function getdata($id_activity)
    {
        //$Submission = Submission::where('id_employee', $id_employee)->get();

        $submission = DB::select('SELECT
                        a.`id`,
                        a.`id_employee`,
                        b.`first_name` full_name,
                        a.`date_of_ended_work`,
                        a.`date_of_submission`,
                        a.`reason_of_submission`,
                        a.`status_of_submission`,
                        c.`activity_name` type_submission
                        FROM `submission` A
                        INNER JOIN `employee` B ON A.`id_employee` = B.`id`
                        INNER JOIN `activity` C ON A.`id_activity` = C.`id`
                        WHERE a.`id_activity` = :id_activity
                        AND a.`id_employee` = :id_employee', ['id_activity' => $id_activity, 'id_employee' => Auth::user()->employee_id]);
        return Datatables::of($submission)

            ->addColumn('action',  function ($submission) {
                $style_btn = "";
                $name_btn = "";
                if ($submission->status_of_submission == 0) {
                    $style_btn = "btn-primary";
                    $name_btn = "First Submission";
                } else if ($submission->status_of_submission == 2) {
                    $style_btn = "btn-info";
                    $name_btn = "Head Division";
                } else if ($submission->status_of_submission == 3) {
                    $style_btn = "btn-warning";
                    $name_btn = "Staff IR";
                } else if ($submission->status_of_submission == 4) {
                    $style_btn = "btn-success";
                    $name_btn = "Approved";
                } else if ($submission->status_of_submission == -1) {
                    $style_btn = "btn-danger";
                    $name_btn = "Decline";
                }
                $action = '<div class="btn-group"><span class="btn btn-xs ' . $style_btn . '">' . $name_btn . '</span></div>';
                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);
    }
}
