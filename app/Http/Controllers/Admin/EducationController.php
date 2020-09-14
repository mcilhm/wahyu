<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Education;
use DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $education="";
        if($request->query('edit')){
            $education = Education::findOrFail($request->query('edit'));
        }
        return view('pages.education.index', compact('education'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.education.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = "";
        try {
            if(!empty($request->id))
            {
                $message = "Edit";
                $education = Education::findOrFail($request->id);
                $education->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }
            else
            {
                $message = "Add";
                $education = Education::create([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }

            \Session::flash('success.message', 'Success to '.$message);
           return redirect('education');

        } catch(\Exception $e) {
            Log::error($ex->getMessage());
        	\Session::flash('error.message', 'Failed to '.$message);
            return redirect('education');
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
        $delete = education::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
    	$education = Education::all();
        return Datatables::of($education)

            ->addColumn('action',  function ($education) {

            	$action = '<div class="btn-group"> <a href="education?edit='.$education->id.'" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                <a href="education/delete/'.$education->id.'"  data-id="'.$education->id.'" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);

    }
}
