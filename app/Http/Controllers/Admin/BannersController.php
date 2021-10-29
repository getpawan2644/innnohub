<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use File;
use Image;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Banner $banner)
    {
        $records = $banner->withTranslation()->sortable(['id' => 'desc']);

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->orWhereTranslationLike('banner_text', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('url', '%'.$request->query('search').'%');
            });
        }

        if($request->sort && $request->direction){
            if(in_array($request->sort, $banner->translatedAttributes)){
                $records->orderByTranslation($request->sort,$request->direction );
            } else {
                $records->orderBy($request->sort,$request->direction );
            }
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        return view('admin.banners.index',['records'=>$records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new Banner;
        return view('admin.banners.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $bannerRequest)
    {
        //dd($bannerRequest->validated());
        $validated=$bannerRequest->validated();
        $locales= config('translatable.locales');
        $unique_name=uniqid();
        foreach($locales as  $language=>$locale){
            if (isset($validated[$locale]['image'])) {
                $image = $validated[$locale]['image'];
                $image_ext = $image->getClientOriginalExtension();
                if (!File::exists(public_path(Banner::IMAGE_PATH))) {
                    File::makeDirectory(public_path(Banner::IMAGE_PATH));
                }

                $destinationImagePath = public_path(Banner::IMAGE_PATH); // upload path
                $image_nn = "Banner_".$locale.'_' . $unique_name. "." . $image_ext;
                $resizing_image = Image::make($validated[$locale]['image']);
                if($validated["banner_position"]==\App\Models\Banner::TOP_BANNER) {
                    $resizing_image->resize(1600, 597);
                }elseif($validated["banner_position"]==\App\Models\Banner::MIDDLE_BANNER){
                    $resizing_image->resize(1600, 528);
                }else{
                    $resizing_image->resize(1385, 333);
                }
//                $resizing_image->resize(570, null, function ($constraint) {
//                    $constraint->aspectRatio();
//                });
                $image->move($destinationImagePath, $image_nn);
                $validated[$locale]['image'] = $image_nn;
            }
        }
        if($validated["banner_position"]!=\App\Models\Banner::TOP_BANNER){
            $validated["have_button"]=0;
            foreach($locales as  $language=>$locale){
                $validated[$locale]["button_label"]="";
                $validated[$locale]["title"]="";
                $validated[$locale]["heading"]="";
                $validated[$locale]["description"]="";
            }

        }
        $banner = Banner::create($validated);
        return redirect()->route('admin.banners.index')->with(['success'=>'Banner added successfully.']);
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
        $record = Banner::findOrFail($id);
//       dd($record->translation->image);
        return view('admin.banners.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        $banner = Banner::findOrFail($id);
        //dd($banner);
        $validated = $request->validated();
        $locales= config('translatable.locales');
        $unique_name=uniqid();
        foreach($locales as  $language=>$locale){
            if (isset($validated[$locale]['image'])) {
                $image = $validated[$locale]['image'];
                $image_ext = $image->getClientOriginalExtension();
                if (!File::exists(public_path(Banner::IMAGE_PATH))) {
                    File::makeDirectory(public_path(Banner::IMAGE_PATH));
                }

                $destinationImagePath = public_path(Banner::IMAGE_PATH); // upload path
                $image_nn = "Banner_".$locale.'_' . $unique_name. "." . $image_ext;
                $resizing_image = Image::make($validated[$locale]['image']);
                $resizing_image->resize(570, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $image->move($destinationImagePath, $image_nn);
//                if (!File::exists(public_path(Banner::IMAGE_PATH.))) {
//                    File::makeDirectory(public_path(Banner::IMAGE_PATH));
//                }
                $validated[$locale]['image'] = $image_nn;
            }
        }
//        dd($validated['have_button']);
        if($validated["have_button"]==='0'){
            $validated["button_url"]="";
            foreach($locales as  $language=>$locale){
                $validated[$locale]["button_label"]="";
            }
        }
        $banner->fill($validated);
        $banner->save();
        //Banner::deleteCache();
        return redirect()->route('admin.banners.index')->with(['success'=>'Banner updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Banner::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Record deleted successfully']);
        } else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }
    public function changeStatus(Request $request)
    {
        $record = Banner::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
            $error = 0;
            $message ='Status changed to <strong>'.$record->status.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change status';
        }
        return response()->json([
            'error' => $error,
            'message' => $message
        ]);
    }
}
