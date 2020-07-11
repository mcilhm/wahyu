<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductPhotos;
use DataTables;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Validator;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $type = master_tour_type::all();
        $country = master_country::all();
        $tour = "";
        $tour_photos="";
        
        if ($request->query('edit')) {
            $tour = tour::where('tour_id',$request->query('edit'))->first();
            $tour_photos = tour_photos::where('tour_id', $request->query('edit'))->get();
        }
        
        return view('pages.tour.create', compact('tour', 'type', 'country', 'tour_photos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $tourslug = str_slug($request->tour_name, "-");

        if(empty($tourslug)){

            $tourslug = preg_replace("/[\s-]+/", " ", $request->tour_name);

            $tourslug = preg_replace("/[\s_]/", '-', $tourslug);

        }

        try {
                $id = IdGenerator::generate(['table' => 'tours', 'length' => 8, 'prefix' =>'Tour-', 'column' => 'tour_id']);
                tour::create([
                    'tour_id' => $id,
                    'tour_name' => $request->tour_name,
                    'tour_type_id' => $request->tour_type_id,
                    'country_id' => $request->country_id,
                    'tour_duration' => $request->tour_duration,
                    'tour_price' => $request->tour_price,
                    'tour_itinerary' => $request->tour_itinerary,
                    'tour_description' => $request->tour_description,
                    'tour_terms_conditions' => $request->tour_terms_conditions,
                    'tour_hot_deals' => isset($request->tour_hot_deals) ? $request->tour_hot_deals : 0,
                    'tour_slug' => $tourslug
                ]);

                if ($request->hasfile('tour_photo')) {
                    foreach ($request->file('tour_photo') as $image) {
                        $imgWW = $this->resizepostimage($id,$image);
                        $tour_photos = tour_photos::create([
                            'tour_id' => $id,
                            'tour_photo' => $imgWW
                        ]);
                    }
                }

                \Session::flash('success.message', 'Success to Add');
                return redirect('tour');

        } catch(\Exception $e) {
        	\Session::flash('error.message', 'Failed to Add');
            return redirect('tour');
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
    public function update(Request $request)
    {
        $tourslug = str_slug($request->tour_name, "-");

        if (empty($tourslug)) {

            $tourslug = preg_replace("/[\s-]+/", " ", $request->tour_name);

            $tourslug = preg_replace("/[\s_]/", '-', $tourslug);
        }

        try {
            // $tour = tour::findOrFail($request->id);
            // $tour->update([
            //     'tour_name' => $request->tour_name,
            //     'tour_type_id' => $request->tour_type_id,
            //     'country_id' => $request->country_id,
            //     'tour_duration' => $request->tour_duration,
            //     'tour_price' => $request->tour_price,
            //     'tour_itinerary' => $request->tour_itinerary,
            //     'tour_description' => $request->tour_description,
            //     'tour_terms_conditions' => $request->tour_terms_conditions,
            //     'tour_hot_deals' => isset($request->tour_hot_deals) ? $request->tour_hot_deals : 0,
            //     'tour_slug' => $tourslug
            // ]);

            if ($request->hasfile('tour_photo')) {
                echo json_encode($request->file('tour_photo'));
            }

        // \Session::flash('success.message', 'Success to Update');
        // return redirect('content');

    } catch(\Exception $e) {
        \Session::flash('error.message', 'Failed to Add');
        return redirect('content');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getdata()
    {
    	$tours = tour::all();
        return Datatables::of($tours)
            ->editColumn('tour_type',  function ($tours) { 

                $category = $tours->category->tour_type_name;

                return $category;
            })

            ->editColumn('tour_country',  function ($tours) { 

                $country = $tours->country->country_name;

                return $country;
            })

        	->editColumn('is_hidden',  function ($tours) { 

        		if($tours->is_hidden == 0)
        		{
        			return '<span class="label label-info">Aktif</span>';
        		}
        		else
        		{
        			return '<span class="label label-primary">Tidak Aktif</span>';
        		}
            })

            ->addColumn('action',  function ($tours) { 

            	$action = '<div class="btn-group"> <a href="tour/create?edit=' . $tours->tour_id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> 
                    <a href="'.action("TourController@hiddentour",  $tours->id).'" data-toggle="tooltip" title="Ubah Status" class="btn btn-xs btn-danger"><i class="fa fa-unlock-alt"></i></a></div>';

                return $action;
            })
            ->rawColumns(['is_hidden','action'])
            ->make(true);

    }

    public function hiddentour($id)
    {

        $tour = tour::findOrFail($id);

        if($tour->is_hidden == '0' or $tour->is_hidden == null){
            $tour->is_hidden = '1';
            $tour->save();
        }else{
            $tour->is_hidden = '0';
            $tour->save();

        }

        \Session::flash('success.message', 'Status Changed');

        return redirect()->back();

    }

    private function resizepostimage($id_tour, $imgWW)
    {

        $tmpFolderPath = 'upload/tour/';

        $tmpSubFolderPath =  date('Y-m-d') . '/' . $id_tour. '/' ;

        $fileName = pathinfo($imgWW->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = pathinfo($imgWW->getClientOriginalName(), PATHINFO_EXTENSION);
        $fullFileName = $fileName . "-" . time() . ".".$imgWW->getClientOriginalExtension();
        $saveFilePath = $tmpFolderPath . $tmpSubFolderPath . $fullFileName;


        $this->makeimagedir($tmpFolderPath . $tmpSubFolderPath);


        if (substr($imgWW, 0, 4) == 'http') {
            $imgWsr = $imgWW;
        } else {

            $imgWsr = substr($imgWW, 1);
        }

        $imorig = Image::make($imgWW)->save($saveFilePath);


        if (env('APP_FILESYSTEM') == "s3") {

            \Storage::disk('s3')->put($saveFilePath, $imorig->stream()->__toString());

            \File::delete(public_path($saveFilePath));


            return $this->s3url . $saveFilePath;
        }


        return $saveFilePath;
    }

    private function makeimagedir($path)
    {
        if (!file_exists(public_path() . '/' . $path)) {
            $oldmask = umask(0);
            mkdir(public_path() . '/' . $path, 0777, true);
            umask($oldmask);
        }
        return;
    }
}
