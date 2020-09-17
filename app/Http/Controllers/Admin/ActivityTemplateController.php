<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ActivityTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class ActivityTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id_activity)
    {
        $activity = "";
        $idActivity = $id_activity;
        if ($request->query('edit')) {
            $activity = ActivityTemplate::findOrFail($request->query('edit'));
        }
        return view('pages.activity_template.index', compact('activity', 'idActivity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.activity_template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_activity)
    {
        $inputs = $request->all();

        try {

            if (!empty($request->id)) {
                $activity_template = ActivityTemplate::findOrFail($request->id);
                $activity_template->update([
                    'activity_id' => $id_activity,
                    'activity_template_name' => $request->activity_template_name
                ]);
            } else {
                $activity_template = ActivityTemplate::create([
                    'activity_id' => $id_activity,
                    'activity_template_name' => $request->activity_template_name
                ]);
            }

            Session::flash('success.message', 'Success to Add');
            return redirect('activity_template/' . $id_activity);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to Add');
            return redirect('activity_template/' . $id_activity);
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
        $delete = ActivityTemplate::findOrFail($id);
        $delete->delete();

        Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }

    public function getdata($id_activity)
    {
        $ActivityTemplate = ActivityTemplate::where('activity_id', $id_activity)->get();
        return Datatables::of($ActivityTemplate)
            ->addColumn('action',  function ($ActivityTemplate) use ($id_activity) {

                $action = '<div class="btn-group"> <a href="' . $id_activity . '/?edit=' . $ActivityTemplate->id . '" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                    <a href="delete/' . $ActivityTemplate->id . '"  data-id="' . $ActivityTemplate->id . '" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);
    }
}
