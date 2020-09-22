<?php

namespace App\Http\Controllers\Admin;

use App\Submission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SubmissionEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, $status)
    {
        $status_of_submission = $status;
        $submission = Submission::where('status_of_submission', $status);
        return view('pages.submissionemployee.index', compact('submission', 'status_of_submission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.submissionemployee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store($status, $id_submission)
    {
        try {
            if (!empty($id_submission)) {

                if ($status == 1) $status = 2;
                $message = "Edit";
                $submission = Submission::findOrFail($id_submission);
                $submission->update(['status_of_submission' => $status]);
            }

            Session::flash('success.message', 'Success to update status submission');
            return redirect('submissionemployee/' . ($status - 1));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to update status submission');
            return redirect('submissionemployee/' . ($status - 1));
        }
    }

    /**
     * method for set data in datagrid blade
     */
    public function getdata($status)
    {
        //$Submission = Submission::where('id_employee', $id_employee)->get();

        $submission = DB::select('SELECT
                        a.`id`,
                        a.`id_employee`,
                        b.`first_name` full_name,
                        a.`date_of_submission`,
                        a.`reason_of_submission`,
                        a.`status_of_submission`,
                        c.`activity_name` type_submission
                        FROM `submission` A
                        INNER JOIN `employee` B ON A.`id_employee` = B.`id`
                        INNER JOIN `activity` C ON A.`id_activity` = C.`id`
                        WHERE a.`status_of_submission` = :status_of_submission', ['status_of_submission' => $status]);
        return Datatables::of($submission)

            ->addColumn('action',  function ($submission) {
                $style_btn = "";
                $name_btn = "";
                if ($submission->status_of_submission == 0) {
                    $style_btn = "btn-primary";
                    $name_btn = "first submission";
                } else if ($submission->status_of_submission == 1) {
                    $style_btn = "btn-warning";
                    $name_btn = "staff ir";
                } else if ($submission->status_of_submission == 2) {
                    $style_btn = "btn-info";
                    $name_btn = "head division";
                } else if ($submission->status_of_submission == 3) {
                    $style_btn = "btn-default";
                    $name_btn = "head division HRGA";
                } else if ($submission->status_of_submission == 4) {
                    $style_btn = "btn-success";
                    $name_btn = "consultant";
                } else if ($submission->status_of_submission == 5) {
                    $style_btn = "btn-success";
                    $name_btn = "finish";
                } else if ($submission->status_of_submission == 6) {
                    $style_btn = "btn-danger";
                    $name_btn = "failed";
                }
                $action = '<div class="btn-group">
                <a href="' . ($submission->status_of_submission + 1) . '/' . $submission->id . '"  data-id="' . $submission->status_of_submission . '" title="Submit" class="sa-submit btn btn-xs ' . $style_btn . '">' . $name_btn . '</i></a></div>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
