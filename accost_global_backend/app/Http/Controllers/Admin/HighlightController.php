<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\Validators\HighlightValidator;
use App\Highlight;
use App\HighlightsSubCategory;
use App\ProductCategory;
use App\ProductSubcategory;
use App\ProductHighlight;

class HighlightController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
       * @method:    newHighlight
       * @purpose:   add highlight
       * @param null
       * @return new blade
    */
    public function newHighlight()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-highlights']);
        $subcategories=ProductSubcategory::with('ProductCategory')->latest()->get();
        return view('admin.Highlight.new',compact('subcategories'));
    }
    /**
       * @method:    saveHighlight
       * @purpose:   save highlight details
       * @param Request $request
       * @return list blade
    */
    public function saveHighlight(Request $request)
    {
        $this->validate($request, HighlightValidator::SAVE_HIGHLIGHT,HighlightValidator::SAVE_HIGHLIGHT_MSG);
        try {
            $highlight = Highlight::where('name',$request->name)->first();
            if(!empty($highlight)){
                flash('Highlight name already exists.')->error();
                return redirect()->back();
            }else{
                $highlight=Highlight::create($request->all());
                if(!empty($highlight)){
                    $sub_cat_ids=explode(',', $request->selected_subcat);
                    //dd($sub_cat_ids);
                    foreach($sub_cat_ids as $sub_cat_id){
                        $category=ProductSubcategory::with('ProductCategory')->where('id',$sub_cat_id)->get()->first();
                        $highlight_relation = new HighlightsSubCategory;
                        $highlight_relation->highlight_id=$highlight->id;
                        $highlight_relation->product_categories_id=$category->product_category_id;
                        $highlight_relation->product_subcategories_id=$sub_cat_id;
                        $highlight_relation->status=1;
                        $highlight_relation->save();
                    }
                    flash('Highlight saved and added successfully for choosen subcategories.')->success();
                    return redirect()->route('list-highlight');
                }
            }
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
       * @method:    edit
       * @purpose:   edit view of highlight
       * @param $id
       * @return edit blade
    */
    public function edit($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-highlights']);
        try {
            $highlight_subcat_ids=array();
            $highlight = Highlight::where('id',$id)->firstOrFail();
            $highlight_subcategories = HighlightsSubCategory::where('highlight_id', $highlight->id)->get();
            foreach($highlight_subcategories as $high_subcat){
                $highlight_subcat_ids[]=$high_subcat->product_subcategories_id;
            }
            $highlight_subcat_hidden_ids=implode(',',$highlight_subcat_ids);
            $subcategories=ProductSubcategory::all();
            return view('admin.Highlight.edit', compact('highlight','subcategories','highlight_subcategories','highlight_subcat_hidden_ids'));
        } catch (\Exception $e) {
            flash('Invalid Highlight #id')->error();
            return redirect()->route('list-highlight');
        }
    }
    /**
       * @method:    update
       * @purpose:   update highlight details
       * @param Request $request,$id
       * @return null
    */
    public function update(Request $request, $id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-highlights']);
        $this->validate($request, HighlightValidator::SAVE_HIGHLIGHT,
        HighlightValidator::SAVE_HIGHLIGHT_MSG);
        try {
            $highlight = Highlight::where('id',$id)->firstOrFail();
            $highlight->name = $request->name;
            $highlight->save();
            ProductHighlight::where('highlight_id',$id)->update(['highlight_name'=>$request->name]);
            HighlightsSubCategory::where('highlight_id',$id)->delete();
            $sub_cat_ids=explode(',', $request->selected_subcat);;
                foreach($sub_cat_ids as $sub_cat_id){
                    $category=ProductSubcategory::with('ProductCategory')->where('id',$sub_cat_id)->get()->first();
                    $highlight_relation = new HighlightsSubCategory;
                    $highlight_relation->highlight_id=$id;
                    $highlight_relation->product_categories_id=$category->product_category_id;
                    $highlight_relation->product_subcategories_id=$sub_cat_id;
                    $highlight_relation->status=1;
                    $highlight_relation->save();
                }
                flash('Highlight updated with updated subcategories.')->success();
                return redirect()->route('list-highlight');
        } catch (\Exception $e) {
            flash('Invalid Highlight')->error();
            return redirect()->back();
        }
    } 
    /**
       * @method:    listHighlight
       * @purpose:   list view of highlight
       * @param null
       * @return list blade
    */   
    public function listHighlight(){  
        $this->setNavigation(['menu-item-catalog','menu-item-highlights']);   
        try{
            $highlights=Highlight::with('highlightSubcategories','highlightSubcategories.productSubCategory')->latest()->get();
            return view('admin.Highlight.list',compact('highlights'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('list-highlight');
        }
    }
    /**
       * @method:    highlightData
       * @purpose:   data for list view
       * @param null
       * @return json response
    */
    public function highlightData()
    {
        $this->setNavigation(['menu-item-catalog','menu-item-highlights']);
        $data = Highlight::with('ProductSubcategory')->latest();
        return datatables()->eloquent($data)
            ->addColumn('action', function ($modal) {
                return '<a href="'.route('view-highlight',$modal->id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp                           
                <a href="'.route('edit-highlight',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-highlight',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this Highlight?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  '; })
            ->addIndexColumn()
            ->toJson();
    }
    /**
       * @method:    viewHighlight
       * @purpose:   view details of highlight
       * @param $id
       * @return detail blade
    */
    public function viewHighlight($id){
        $this->setNavigation(['menu-item-catalog','menu-item-highlights']);
        try{
            $highlight = Highlight::whereId($id)->first();
            if(empty($highlight)){
                flash('Invalid Highlight #id.')->error();
                return redirect()->route('list-highlight');
            }
            $highlight_subcategories=HighlightsSubCategory::with('productSubCategory')->where('highlight_id',$id)->get();
            return view('admin.Highlight.detail',compact('highlight','highlight_subcategories'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('list-highlight');
        }
    }
    /**
       * @method:    deleteHighlight
       * @purpose:   delete highlight
       * @param $id
       * @return null
    */
    public function deleteHighlight($id)
    {
        $this->setNavigation(['menu-item-catalog','menu-item-highlights']);
        try{
            HighlightsSubCategory::where([['highlight_id',$id]])->delete();
            ProductHighlight::where([['highlight_id',$id]])->delete();
            $highlight = Highlight::whereId($id)->delete();            
            if($highlight){
                flash('Highlight deleted successfully.')->success();
                return redirect()->back();
            }else{
                flash('There is something wrong.')->error();
                return redirect()->back();
            }
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->route('list-highlight');
        }
    }
    /**
       * @method:    findUniqueHighlight
       * @purpose:   check unique highlight
       * @param Request $request
       * @return json response
    */    
    public function findUniqueHighlight(Request $request){
        $this->setNavigation(['menu-item-catalog','menu-item-highlights']);
        if($request->prev_highlight_id!=0){
            $highlights=Highlight::find($request->prev_highlight_id);
            if($highlights->name==$request->highlight_name){
                return response()->json(['status'=>0,'message'=>"Previous Highlight."], 200);
            }
        }
        $highlight_name= Highlight::whereName($request->highlight_name)->get();
        if(count($highlight_name)>0){
            return response()->json(['status'=>'error','message'=>'Highlight name already exist.']);
        }else{
            return response()->json(['status'=>'success']);
        }        
    }   
}