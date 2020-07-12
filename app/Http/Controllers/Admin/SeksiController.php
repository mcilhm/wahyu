<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Seksi;
use DataTables;
use Illuminate\Http\Request;

class SeksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $seksi="";
        if($request->query('edit')){
            $seksi = Seksi::findOrFail($request->query('edit'));
        }
        return view('pages.seksi.index', compact('seksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.seksi.create');
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
                $seksi = Seksi::findOrFail($request->id);
                $seksi->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }
            else
            {
                $message = "Add";
                $seksi = Seksi::create([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }

            \Session::flash('success.message', 'Success to '.$message);
           return redirect('seksi');

        } catch(\Exception $e) {
        	\Session::flash('error.message', 'Failed to '.$message);
            return redirect('seksi');
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
        $delete = Seksi::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
    	$seksi = Seksi::all();
        return Datatables::of($seksi)

            ->addColumn('action',  function ($seksi) {

            	$action = '<div class="btn-group"> <a href="seksi?edit='.$seksi->id.'" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                <a href="seksi/delete/'.$seksi->id.'"  data-id="'.$seksi->id.'" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);

    }
}
