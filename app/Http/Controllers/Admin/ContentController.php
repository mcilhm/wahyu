<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\ContentOther;
use DataTables;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.content.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $content="";
        if($request->query('edit')){
            $content = content_other::findOrFail($request->query('edit'));
        }
        return view('pages.content.create', compact('content'));
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
            if(!empty($request->id))
            {
                $content_others = content_other::findOrFail($request->id);
                $content_others->update([
                    'content_name' => $request->content_name,
                    'content_value' => $request->content_value,
                    'content_slug' => $request->content_slug
                ]);
            }
            else
            {
                $content_others = content_other::create([
                    'content_name' => $request->content_name,
                    'content_value' => $request->content_value,
                    'content_slug' => $request->content_slug
                ]);
            }

            \Session::flash('success.message', 'Success to Add');
            return redirect('content');

        } catch(\Exception $e) {
        	\Session::flash('error.message', 'Failed to Add');
            return redirect('content');
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
        $delete = content_other::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
    	$content = content_other::all();
        return Datatables::of($content)

            ->addColumn('action',  function ($content) { 
            	$action = '<div class="btn-group"> <a href="content/create?edit='.$content->id.'" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> 
                <a href="content/delete/'.$content->id.'"  data-id="'.$content->id.'" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })
            
            ->rawColumns(['action'])
            ->make(true);

    }
}
