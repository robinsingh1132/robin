<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Lib\Validators\TaxesValidation;
use App\Product;
use App\ProductCategory;
use App\ProductType;
use App\State;
use App\Tax;
use App\Zipcode;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * @method      : listTaxes
     * @params      : []
     * @created_date: 21-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To list taxes
     * @return_type : view
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function listTaxes(){
        $this->setNavigation(['menu-item-taxes']);
        try{
            return view('admin.Taxes.list');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
     * @method      : addTaxes
     * @params      : []
     * @created_date: 21-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To add taxes
     * @return_type : view
     */
    public function addTaxes(){
        $this->setNavigation(['menu-item-taxes']);
        try{
            $productType = ProductType::all();
            $countries = Country::all();
            return view('admin.Taxes.new', compact('productType','countries'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : saveTaxes
     * @params      : $request
     * @created_date: 22-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To save taxes
     * @return_type : view
     */
    public function saveTaxes(Request $request){
        $this->setNavigation(['menu-item-taxes']);
        $this->validate($request, TaxesValidation::TAX_ADD);
        try{
            $requestData = $request->all();
            $data = [
                'country_id' => $requestData['country'],
                'state_id' => $requestData['state'],
                'tax' => $requestData['tax'],
                'tax_product_type_id' => $requestData['product_type'],
            ];
            $tax = Tax::create($data);
            flash('Tax added successfully.')->success();
            return redirect()->route('list-taxes');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : taxesData
     * @params      : []
     * @created_date: 22-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To get tax data for data tables
     * @return      : json
     */
    public function taxesData()
    {
        $this->setNavigation(['menu-item-taxes']);
        try{
            $data = Tax::with(['country','state','product_type']);
            return datatables()->eloquent($data)
                ->addColumn('action', function ($id) {
                    return '<a href="'.route('view-taxes',$id).'" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp
                <a href="'.route('edit-taxes',$id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-taxes',$id).'" onclick="return confirm(\'All associated zipcodes will be deleted for this record. Are you sure you want to delete this record?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  ';})
                ->addIndexColumn()
                ->toJson();
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : viewTaxes
     * @params      : id
     * @created_date: 22-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To view taxes
     * @return_type : view
     */
    public function viewTaxes($id){
        $this->setNavigation(['menu-item-taxes']);
        try{
            $productType = ProductType::all();
            $countries = Country::all();
            $states = State::all();
            $tax = Tax::whereId($id)->first();
            if(empty($tax)){
                flash('Invalid Tax #id.')->error();
                return redirect()->route('list-taxes');
            }
            return view('admin.Taxes.details', compact('productType','countries','states','tax'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : editTaxes
     * @params      : id
     * @created_date: 22-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To edit taxes
     * @return_type : view
     */
    public function editTaxes($id){
        $this->setNavigation(['menu-item-taxes']);
        try{
            $productType = ProductType::all();
            $countries = Country::all();
            $tax = Tax::whereId($id)->first();
            if(empty($tax)){
                flash('Invalid Tax #id.')->error();
                return redirect()->route('list-taxes');
            }
            return view('admin.Taxes.edit', compact('productType','countries','tax'));
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : updateTaxes
     * @params      : $request,id
     * @created_date: 22-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To update taxes
     * @return_type : view
     */
    public function updateTaxes(Request $request, $id){
        $this->setNavigation(['menu-item-taxes']);
        $this->validate($request, TaxesValidation::TAX_ADD);
        try{
            $tax = Tax::whereId($id)->firstOrFail();
            $tax->country_id = $request['country'];
            $tax->state_id = $request['state'];
            $tax->tax = $request['tax'];
            $tax->tax_product_type_id = $request['product_type'];
            $tax->update();            
            flash('Tax updated successfully.')->success();
            return redirect()->route('list-taxes');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : deleteTaxes
     * @params      : id
     * @created_date: 22-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To delete Taxes
     * @return_type : route
     */
    public function deleteTaxes($id)
    {
        $this->setNavigation(['menu-item-taxes']);
        try{
            $tax = Tax::find($id)->delete();
            flash('Tax deleted successfully.')->success();
            return redirect()->route('list-taxes');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }

    /**
     * @method      : addCountry
     * @params      : id
     * @created_date: 22-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To delete Taxes
     * @return_type : route
     */
    public function addCountry(Request $request)
    {
        $this->setNavigation(['menu-item-taxes']);
        try{
            $alreadyExists = Country::where('name',$request['country'])->first('id');
            if(!$alreadyExists){
                $country = Country::create(['name'=>$request['country']]);
                if($country){
                    return response()->json('Country added successfully.', 200);
                }else{
                    return response()->json('There is something wrong.', 500);
                }
            }else{
                return response()->json('Entered country already exists in our records.', 403);
            }
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @method      : addState
     * @params      : id
     * @created_date: 22-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To delete Taxes
     * @return_type : route
     */
    public function addState(Request $request)
    {
        $this->setNavigation(['menu-item-taxes']);
        try{
            $alreadyExists = State::where(['country_id'=>$request['country_id'],'name'=>$request['state']])->first('id');
            if(!$alreadyExists){
                $state = State::create(['country_id'=>$request['country_id'],'name'=>$request['state']]);
                if($state){
                    return response()->json('State added successfully.', 200);
                }else{
                    return response()->json('There is something wrong.', 500);
                }
            }else{
                return response()->json('Entered state already exists in our records.', 403);
            }
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @method      : getRelatedStates
     * @params      : country_id
     * @created_date: 27-01-2020 (dd-mm-yyyy)
     * @developer   :
     * @purpose     : To get states
     * @return_type : route
     */
    public function getRelatedStates(Request $request){
        $this->setNavigation(['menu-item-taxes']);
        try{
            $states = State::whereCountryId($request['country_id'])->get();
            if($states){
                return response()->json($states, 200);
            }else{
                return response()->json('Country related states not found.', 404);
            }
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    /**
     * @method      : verifyUniqueTaxes
     * @params      : Request $request
     * @developer   :
     * @purpose     : check unique taxes
     * @return_type : json response
     */
    public function verifyUniqueTaxes(Request $request){
        if($request->prev_tax_id!=0){
            $taxes=Tax::find($request->prev_tax_id);
            if($taxes->tax_product_type_id==$request->productType && $taxes->country_id==$request->country && $taxes->state_id==$request->state){
                return response()->json(['status'=>0,'message'=>"Previous Tax."], 200);
            }
        }
        $taxes=Tax::where([['tax_product_type_id',$request->productType],['country_id',$request->country],['state_id',$request->state]])->get();
        if($taxes->count()>0){
            return response()->json(['status'=>1,'message'=>"Tax already Exist."], 200);
        }else{
            return response()->json(['status'=>0,'message'=>"Tax not Exist."], 200);
        }
    }
}
