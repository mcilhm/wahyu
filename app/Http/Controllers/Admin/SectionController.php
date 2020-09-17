<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use App\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $section = "";
        $department = Department::all();
        if ($request->query('edit')) {
            $section = Section::findOrFail($request->query('edit'));
        }
        return view('pages.section.index', compact('section', 'department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.section.create');
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
                $section = Section::findOrFail($request->id);
                $section->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'department_id' => $request->department_id
                ]);
            } else {
                $message = "Add";
                $section = Section::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'department_id' => $request->department_id
                ]);
            }

            Session::flash('success.message', 'Success to ' . $message);
            return redirect('section');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to ' . $message);
            return redirect('section');
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
        $delete = section::findOrFail($id);
        $delete->delete();

        Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
        // $section = section::all();
        $section = DB::select('SELECT
                        A.`id`,
                        A.`name`,
                        A.`description`,
                        B.`name` department_name
                        FROM `section` A
                        LEFT JOIN `department` B ON A.`department_id` = B.`id`');
        return Datatables::of($section)

            ->addColumn('action',  function ($section) {

                $action = '<div class="btn-group"> <a href="section?edit=' . $section->id . '" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                <a href="section/delete/' . $section->id . '"  data-id="' . $section->id . '" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);
    }
}
