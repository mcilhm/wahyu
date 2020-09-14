<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Activity;
use DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activity="";
        if($request->query('edit')){
            $activity = Activity::findOrFail($request->query('edit'));
        }
        return view('pages.activity.index', compact('activity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.activity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        try {

            if(!empty($request->id))
            {
                $activity = Activity::findOrFail($request->id);
                $activity->update([
                    'activity_name' => $request->activity_name,
                    'activity_description' => $request->activity_description,
                    'activity_before_day' => $request->activity_before_day,
                    'activity_slug' => $request->activity_slug
                ]);
            }
            else{
                $activity = Activity::create([
                    'activity_name' => $request->activity_name,
                    'activity_description' => $request->activity_description,
                    'activity_before_day' => $request->activity_before_day,
                    'activity_slug' => $request->activity_slug
                ]);
            }

            \Session::flash('success.message', 'Success to Add');
           return redirect('activity');

        } catch(\Exception $e) {
            Log::error($ex->getMessage());
        	\Session::flash('error.message', 'Failed to Add');
            return redirect('activity');
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
        $delete = Activity::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }

    public function getdata()
    {
    	$activity = Activity::all();
        return Datatables::of($activity)

            ->addColumn('action',  function ($activity) {

            	$action = '<div class="btn-group"> <a href="activity?edit='.$activity->id.'" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                    <a href="activity_template/'.$activity->id.'" title="Template" class="btn btn-xs btn-info"><i class="fa fa-file"></i></a>
                    <a href="activity_status/'.$activity->id.'" title="Status" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></a>
                    <a href="activity/delete/'.$activity->id.'"  data-id="'.$activity->id.'" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                    </div>';
                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);

    }
}
