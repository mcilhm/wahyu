<?php

namespace App\Http\Controllers;
use App\webdesc;
use DataTables;
use Illuminate\Http\Request;

class WebdescController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $webdesc="";
        if(empty($webdesc)){
            $webdesc = webdesc::first();
        }
        return view('pages.webdesc.index', compact('webdesc'));
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
                $webdesc = webdesc::findOrFail($request->id);
                $webdesc->update([
                    'webtitle' => $request->webtitle,
                    'mkeyword' => $request->mkeyword,
                    'mdescription' => $request->mdescription,
                    'url' => $request->url,
                    'telp1' => $request->telp1,
                    'telp2' => $request->telp2,
                    'telp3' => $request->telp3,
                    'ophour' => $request->ophour,
                    'email' => $request->email,
                    'emailfrom' => $request->emailfrom,
                    'namafrom' => $request->namafrom,
                    'fb' => $request->fb,
                    'twitter' => $request->twitter,
                    'gplus' => $request->gplus,
                    'linkedin' => $request->linkedin,
                    'whatsapp' => $request->whatsapp,
                    'instagram' => $request->instagram
                ]);
            }
            else
            {
                $webdesc = webdesc::create([
                    'webtitle' => $request->webtitle,
                    'mkeyword' => $request->mkeyword,
                    'mdescription' => $request->mdescription,
                    'url' => $request->url,
                    'telp1' => $request->telp1,
                    'telp2' => $request->telp2,
                    'telp3' => $request->telp3,
                    'ophour' => $request->ophour,
                    'email' => $request->email,
                    'emailfrom' => $request->emailfrom,
                    'namafrom' => $request->namafrom,
                    'fb' => $request->fb,
                    'twitter' => $request->twitter,
                    'gplus' => $request->gplus,
                    'linkedin' => $request->linkedin,
                    'whatsapp' => $request->whatsapp,
                    'instagram' => $request->instagram
                ]);
            }

            \Session::flash('success.message', 'Success to Update');
            return redirect('webdesc');

        } catch(\Exception $e) {
        	\Session::flash('error.message', 'Failed to Add');
            return redirect('webdesc');
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
        $delete = webdesc::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
}
