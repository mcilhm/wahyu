<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Submission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ManageJadwalInterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $submission = null;
        if ($request->query('edit')) {
            $submission = Submission::findOrFail($request->query('edit'));
        }
        return view('pages.managejadwalinterview.index', compact('submission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.managejadwalinterview.create');
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
                $message = "Edit";
                $submission = Submission::findOrFail($request->id);
                $submission->update([
                    'date_of_interview' => $request->date_of_interview
                ]);
            }
            else {
                Session::flash('error.message', 'Failed to create manage jadwal interview');
                return redirect('managejadwalinterview/');
            }
            Session::flash('success.message', 'Success to create manage jadwal interview');
            return redirect('managejadwalinterview/');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to create manage jadwal interview');
            return redirect('managejadwalinterview/');
        }
    }

    /**
     * method for set data in datagrid blade
     */
    public function getdata()
    {
        //$Submission = Submission::where('id_employee', $id_employee)->get();

        $submission = DB::select('SELECT
                        a.`id`,
                        a.`id_employee`,
                        b.`first_name`,
                        b.`last_name`,
                        a.`date_of_ended_work`,
                        a.`date_of_submission`,
                        a.`reason_of_submission`,
                        a.`status_of_submission`,
                        c.`activity_name` type_submission
                        FROM `submission` A
                        INNER JOIN `employee` B ON A.`id_employee` = B.`id`
                        INNER JOIN `activity` C ON A.`id_activity` = C.`id`
                        WHERE a.`status_of_submission` = :status_of_submission
                        AND a.`date_of_interview` IS NULL',
                        ['status_of_submission' => 4]);
        return Datatables::of($submission)
            ->addColumn('full_name',  function ($submission) {
                $action = $submission->first_name . " " . $submission->last_name;
                return $action;
            })
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
                $action =
                '<div class="btn-group">
                    <a href="managejadwalinterview?edit=' . $submission->id . '" data-toggle="tooltip" title="Update" class="btn btn-xs ' . $style_btn . '">Manage Jadwal Interview</a>
                </div>';

                return $action;
            })

            ->rawColumns(['full_name', 'action'])
            ->make(true);
    }
}
