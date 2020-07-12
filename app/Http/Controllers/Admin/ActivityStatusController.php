<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\ActivityStatus;
use App\Division;
use DataTables;
use Illuminate\Http\Request;
use Validator;
use Image;

class ActivityStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id_activity)
    {
        $activity="";
        $idActivity = $id_activity;
        $division = Division::all();
        if($request->query('edit')){
            $activity = ActivityStatus::findOrFail($request->query('edit'));
        }
        return view('pages.activity_status.index', compact('activity','idActivity','division'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.activity_status.create');
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

            if(!empty($request->id))
            {
                $activity_status = ActivityStatus::findOrFail($request->id);
                $activity_status->update([
                    'activity_id' => $id_activity,
                    'activity_status_name' => $request->activity_status_name,
                    'division_id' => $request->division_id
                ]);
            }
            else{
                $activity_status = ActivityStatus::create([
                    'activity_id' => $id_activity,
                    'activity_status_name' => $request->activity_status_name,
                    'division_id' => $request->division_id
                ]);
            }

            \Session::flash('success.message', 'Success to Add');
            return redirect('activity_status/'.$id_activity);

        } catch(\Exception $e) {
        	\Session::flash('error.message', 'Failed to Add');
            return redirect('activity_status/'.$id_activity);
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
        $delete = ActivityStatus::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }

    public function getdata($id_activity)
    {
    	$activityStatus = ActivityStatus::where('activity_id', $id_activity)->get();
        return Datatables::of($activityStatus)
            ->addColumn('action',  function ($activityStatus) use($id_activity){

            	$action = '<div class="btn-group"> <a href="'.$id_activity.'/?edit='.$activityStatus->id.'" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                    <a href="delete/'.$activityStatus->id.'"  data-id="'.$activityStatus->id.'" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);

    }
}
