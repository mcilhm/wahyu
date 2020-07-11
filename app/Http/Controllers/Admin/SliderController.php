<?php

namespace App\Http\Controllers;
use App\ContentSlider;
use DataTables;
use Illuminate\Http\Request;
use Validator;
use Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slider="";
        if($request->query('edit')){
            $slider = ContentSlider::findOrFail($request->query('edit'));
        }
        return view('pages.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.slider.create');
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

            $slugname = str_slug($inputs['slider_name'], "-");
            if(empty($slugname)){

                $slugname = preg_replace("/[\s-]+/", " ", $inputs['slider_name']);
    
                $slugname = preg_replace("/[\s_]/", '-', $slugname);
    
            }

            if(!empty($request->id))
            {
                $slider = ContentSlider::findOrFail($request->id);
                if(null !== $request->file('slider_photo')){

                    $imgWW = $this->resizepostimage($request->file('slider_photo'), $slugname);

                }else{
                    $imgWW=$slider->slider_photo;
                }

                $slider->update([
                    'slider_name' => $request->slider_name,
                    'slider_photo' => $imgWW,
                    'slider_url' => $request->slider_url,
                    'position' => $request->position
                ]);
            }

            \Session::flash('success.message', 'Success to Add');
            return redirect('slider');

        } catch(\Exception $e) {
        	\Session::flash('error.message', $e);
            return redirect('slider');
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
        $delete = content_slider::findOrFail($id);
        $delete->delete();

        \Session::flash('success.message', trans("Success To Delete"));

        return redirect()->back();
    }
    public function getdata()
    {
    	$slider = content_slider::all();
        return Datatables::of($slider)

            ->addColumn('action',  function ($slider) { 

            	$action = '<div class="btn-group"> <a href="slider?edit='.$slider->id.'" data-toggle="tooltip" title="Update" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> 
                <a href="'.action("SliderController@showslider",  $slider->id).'" data-toggle="tooltip" title="Ubah Status" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></a>    
                <a href="slider/delete/'.$slider->id.'"  data-id="'.$slider->id.'" title="Delete" class="sa-remove btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></div>';

                return $action;
            })
            ->editColumn('slider_show',  function ($slider) { 

        		if($slider->slider_show == 1)
        		{
        			return '<span class="label label-info">Aktif</span>';
        		}
        		else
        		{
        			return '<span class="label label-danger">Tidak Aktif</span>';
        		}
            })
            
            ->rawColumns(['action','slider_show'])
            ->make(true);

    }
    public function showslider($id)
    {

        $slider = content_slider::findOrFail($id);

        if($slider->slider_show == '0' or $slider->slider_show == null){
            $slider->slider_show = '1';
            $slider->save();
        }else{
            $slider->slider_show = '0';
            $slider->save();

        }

        \Session::flash('success.message', 'Status Changed');

        return redirect()->back();

    }
    private function resizepostimage($imgWW, $slug)
    {

        $tmpFilePath = 'upload/slider/';

        $tmpFileDate =  date('Y-m') .'/'.date('d').'/';

        $tmpFileName = substr($slug,0,100).'_'.time();

        $saveFilePath = $tmpFilePath.$tmpFileDate.$tmpFileName;


        $this->makeimagedir($tmpFilePath.$tmpFileDate);


        if(substr($imgWW, 0, 4) == 'http'){

            $imgWsr = $imgWW;

        }else{

            $imgWsr = substr($imgWW, 1);

        }
        
        $imorig= Image::make($imgWW)->save($saveFilePath.'.jpg');


        if(env('APP_FILESYSTEM')=="s3"){

            \Storage::disk('s3')->put($saveFilePath.'.jpg', $imorig->stream()->__toString());

            \File::delete(public_path($saveFilePath.'.jpg'));


            return $this->s3url.$saveFilePath;
        }


        return $tmpFileDate.$tmpFileName;
    }

    private function makeimagedir($path)
    {
        if (!file_exists(public_path() .'/'. $path )) {
            $oldmask = umask(0);
            mkdir(public_path() .'/'. $path , 0777, true);
            umask($oldmask);
        }
        return;
    }
}
