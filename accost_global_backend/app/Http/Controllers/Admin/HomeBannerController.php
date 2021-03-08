<?php

namespace App\Http\Controllers\Admin;

use App\HomeBanner;
use App\Http\Controllers\Controller;
use App\Lib\Validators\HomeBannerValidators;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class HomeBannerController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * view add new banner form
     * updated: 25-nov-2019
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newBanner()
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-home-banners']);
        $allPosition=array();
        $position=HomeBanner::where('status',1)->get('position');
        foreach ($position as $position_number) {
          $allPosition[]=$position_number->position;
        }
        return view('admin.HomeBanner.new-banner',compact('allPosition'));
    }

    /**
     * save new home page banner
     * updated: 25-nov-2019
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-home-banners']);
        $this->validate($request, HomeBannerValidators::HOME_BANNER,HomeBannerValidators::HOME_BANNER_MSG);
        try {
            # upload image
            $file_name = $this->uploadOne($request->file('image_link'),'/banner');
            $mobile_file_name = $this->uploadOne($request->file('mobile_image_link'),'/banner');
            $file_name =$this->OptimizedHomeBannerImage($file_name);
            $mobile_file_name =$this->OptimizedHomeBannerImage($mobile_file_name);
            $value = [
                'name' => $request->name,
                'image_link' => $file_name,
                'mobile_image_link' => $mobile_file_name,
                'image_alt' => $request->image_alt,
                'position' => $request->position,
                'url' => $request->url,
                'status' => $request->status,
            ];            
            HomeBanner::create($value);
            flash('Home page banner added successfully.')->success();
            return redirect()->route('list-home-banner');
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
     * optimize home banner image
     * @param $image_name
     * @return image name
    */
    public function OptimizedHomeBannerImage($image_name)
    {
        try {
            $img_name_only = explode('.', $image_name);            
            //$img_ext_only=   $img_name_only[1];
            $img_name_only = $img_name_only[0];
            $image = new \Imagick(public_path('banner/'.$image_name));           
            $image_height=$image->getImageHeight();
            $image_width=$image->getImageWidth();            
            if(($image_height >'400' || $image_height <'390') && ($image_width>'1600' || $image_width<'1590'))
            {
                return $image_name;
            }
            // Set to use jpeg compression
            $image->setImageCompression(\Imagick::COMPRESSION_JPEG);
            // Set compression level (1 lowest quality, 100 highest quality)
            $image->setImageCompressionQuality(45);
            // Strip out unneeded meta data
            $image->stripImage();
            // Writes resultant image to output directory
            $image->writeImage(public_path('banner/'.$img_name_only.'.jpeg'));
            $image->destroy();
            return $img_name_only.'.jpeg';
        } catch (\Exception $e) {
            echo $e->getMessage()."\n";
            return false;
        }
    }
    /**
     * show list of home page banners
     * updated: 25-nov-2019
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listCategory()
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-home-banners']);
        return view('admin.HomeBanner.list');
    }

    /**
     * return home banner data for data-table
     * updated: 25-nov-2019
     * @return JsonResponse
     */
    public function homeBannerData()
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-home-banners']);
        $data = HomeBanner::all();
        return datatables()->Collection($data)
            ->addColumn('action', function ($modal) {
                $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
                return '<a href="'.route('view-home-banner',$modal->id).'"><i class="fas fa-eye"></i></a>&nbsp&nbsp
                <a href="'.route('toggle-status',['model'=>'HomeBanner','column'=>'status','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp
                <a href="'.route('edit-home-banner',$modal->id).'"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-home-banner',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fas fa-trash text-danger"></i></a>
                  '; })
            ->addIndexColumn()
            ->toJson();
    }

    /**
     * show edit form for updating home page banner
     * updated: 25-nov-2019
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-home-banners']);
        try {
            $home_banner = HomeBanner::where('id','=',$id)->firstOrfail();
            //dd($home_banner->position);
            $allPosition=array();
            $position=HomeBanner::where([['status','=',1],['id','!=',$id]])->get('position');
            foreach ($position as $position_number) {
              $allPosition[]=$position_number->position;
            }
            //dd($allPosition);
            return view('admin.HomeBanner.edit', compact('home_banner','allPosition'));
        } catch (\Exception $e) {
            flash('Invalid home banner #id')->error();
            return redirect()->route('list-home-banner');
        }
    }

    /**
     * update the home banner data
     * updated: 25-nov-2019
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-home-banners']);
        $this->validate($request, HomeBannerValidators::UPDATE_HOME_BANNER);
        try {
            HomeBanner::where('id',$id)->update($request->except(['_token', 'image_link']));
            if ($request->hasFile('image_link')) {
                $file_name = $this->uploadOne($request->file('image_link'), '/banner');
                $file_name =$this->OptimizedHomeBannerImage($file_name);
                HomeBanner::where('id',$id)->update(['image_link' => $file_name]);
            }
            if ($request->hasFile('mobile_image_link')) {
                $mobile_file_name = $this->uploadOne($request->file('mobile_image_link'), '/banner');
                $mobile_file_name =$this->OptimizedHomeBannerImage($mobile_file_name);
                HomeBanner::where('id',$id)->update(['mobile_image_link' => $mobile_file_name]);
            }
            flash('Home banner updated successfully.')->success();
            return redirect()->route('list-home-banner');
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * delete home page banner data
     * updated: 25-nov-2019
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-home-banners']);
        HomeBanner::where('id',$id)->delete();
        flash('Home Banner deleted successfully.')->success();
        return redirect()->back();
    }
    /**
     * show home page banner data
     * updated: 25-nov-2019
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view($id)
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-home-banners']);
        try {
            $home_banner = HomeBanner::where('id',$id)->firstOrFail();
            return view('admin.HomeBanner.detail', compact('home_banner'));
        } catch (\Exception $e) {
            flash('Invalid home banner #id')->error();
            return redirect()->route('list-home-banner');
        }
    }
}