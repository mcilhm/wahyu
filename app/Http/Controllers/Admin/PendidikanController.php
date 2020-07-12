<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Pendidikan;
use DataTables;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pendidikan="";
        if($request->query('edit')){
            $pendidikan = Pendidikan::findOrFail($request->query('edit'));
        }
        return view('pages.pendidikan.index', compact('pendidikan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.pendidikan.create');
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
                $pendidikan = Pendidikan::findOrFail($request->id);
                $pendidikan->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }
            else
            {
                $message = "Add";
                $pendidikan = Pendidikan::create([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }

            \Session::flash('success.message', 'Success to '.$message);
           return redirect('pendidikan');

        } catch(\Exception $e) {
        	\Session::flash('error.message', 'Failed to '.$message);
            return redirect('pendidikan');
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
        $delete = Pendidikan::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
    	$pendidikan = Pendidikan::all();
        return Datatables::of($pendidikan)

            ->addColumn('action',  function ($pendidikan) {

            	$action = '<div class="btn-group"> <a href="pendidikan?edit='.$pendidikan->id.'" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                <a href="pendidikan/delete/'.$pendidikan->id.'"  data-id="'.$pendidikan->id.'" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);

    }
}
