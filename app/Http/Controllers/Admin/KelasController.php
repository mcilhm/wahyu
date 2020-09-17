<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kelas = "";
        if ($request->query('edit')) {
            $kelas = Kelas::findOrFail($request->query('edit'));
        }
        return view('pages.kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.kelas.create');
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
                $kelas = Kelas::findOrFail($request->id);
                $kelas->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            } else {
                $message = "Add";
                $kelas = Kelas::create([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }

            Session::flash('success.message', 'Success to ' . $message);
            return redirect('kelas');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error.message', 'Failed to ' . $message);
            return redirect('kelas');
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
        $delete = Kelas::findOrFail($id);
        $delete->delete();

        Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
        $kelas = Kelas::all();
        return Datatables::of($kelas)

            ->addColumn('action',  function ($kelas) {

                $action = '<div class="btn-group"> <a href="kelas?edit=' . $kelas->id . '" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                <a href="kelas/delete/' . $kelas->id . '"  data-id="' . $kelas->id . '" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);
    }
}
