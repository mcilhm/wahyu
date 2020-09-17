<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Division;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $division = "";
        if ($request->query('edit')) {
            $division = Division::findOrFail($request->query('edit'));
        }
        return view('pages.division.index', compact('division'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.division.create');
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
            if (!empty($request->id)) {
                $message = "Edit";
                $division = Division::findOrFail($request->id);
                $division->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            } else {
                $message = "Add";
                $division = Division::create([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }

            Session::flash('success.message', 'Success to ' . $message);
            return redirect('division');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to ' . $message);
            return redirect('division');
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
        $delete = Division::findOrFail($id);
        $delete->delete();

        Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
        $division = Division::all();
        return Datatables::of($division)

            ->addColumn('action',  function ($division) {

                $action = '<div class="btn-group"> <a href="division?edit=' . $division->id . '" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                <a href="division/delete/' . $division->id . '"  data-id="' . $division->id . '" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDepartment($id)
    {
        return Department::select('id', 'name')->where('division_id', $id)->get();
    }
}
