<?php

namespace App\Http\Controllers\Admin;

use App\Imports\DealersImport;
use App\Dealer;
use Illuminate\Http\Request;
use App\Exports\DealersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Lib\Validators\DealerValidator;

class DealerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
       * @method:    addDealer
       * @purpose:   add new dealer view
       * @param nyll
       * @return add dealer view
    */
    public function addDealer(){
        $this->setNavigation(['menu-item-dealers']);
        try{
            return view('admin.Dealers.new');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
       * @method:    saveDealer
       * @purpose:   dealer record save
       * @param Request $request
       * @return list blade
    */
    public function saveDealer(Request $request){
        $this->setNavigation(['menu-item-dealers']);
        $this->validate($request, DealerValidator::DEALER_ADD);
        try{            
            $dealerData = [
                'first_name' =>$request->first_name,
                'last_name' => $request->last_name,
                'contact_number' =>$request->contact_number,                
                'email' =>$request->email,
                'address' =>$request->address
            ];
            $dealer = Dealer::create($dealerData); 
            flash('Dealer created successfully.')->success();
            return redirect()->route('list-dealer');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
       * @method:    listDealer
       * @purpose:   list view of dealer
       * @param null
       * @return list blade
    */
    public function listDealer(){
        $this->setNavigation(['menu-item-dealers']);
        try{
            $dealers = Dealer::all();
            if($dealers){
                return view('admin.Dealers.list', compact('dealers'));
            }
            return redirect()->back();
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
       * @method:    dealerData
       * @purpose:   dealer data for dealer list view
       * @param Request $request
       * @return json response
    */
    public function dealerData(Request $request)
    {
        $this->setNavigation(['menu-item-dealers']);
        $data = Dealer::all();
        return datatables()->Collection($data)
            ->addColumn('action', function ($modal) {                
                return '<a href="'.route('view-dealer',$modal->id).'" data-toggle="tooltip" title="View Dealer"><i class="fas fa-eye"></i></a>&nbsp
                <a href="'.route('edit-dealer',$modal->id).'" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-dealer',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this dealer?\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                  '; })
            ->addIndexColumn()
            ->toJson();
    }
    /**
       * @method:    viewDealer
       * @purpose:   details of dealer
       * @param $id
       * @return detail blade
    */
    public function viewDealer($id){
        $this->setNavigation(['menu-item-dealers']);
        try{
            $dealer = Dealer::whereId($id)->firstOrFail();
            if($dealer){
                return view('admin.Dealers.detail', compact('dealer'));
            }else{
                flash('Dealer detail not found.')->info();
                return redirect()->back();
            }
        }catch(\Exception $e){
            flash('Invalid dealers #id.')->error();
            return redirect()->route('list-dealer');
        }
    }
    /**
       * @method:    editDealer
       * @purpose:   edit dealer data
       * @param $id
       * @return edit blade
    */
    public function editDealer($id){
        $this->setNavigation(['menu-item-dealers']);
        try{
            $dealer = Dealer::whereId($id)->firstOrFail();
            if($dealer){
                return view('admin.Dealers.edit', compact('dealer'));
            }else{
                flash("Dealer's detail not found.")->info();
                return redirect()->back();
            }
        }catch(\Exception $e){
            flash('Invalid dealers #id.')->error();
            return redirect()->route('list-dealer');
        }
    }
    /**
       * @method:    updateDealer
       * @purpose:   update dealer data
       * @param Request $request,$id
       * @return list blade
    */
    public function updateDealer(Request $request,$id){
        $this->setNavigation(['menu-item-dealers']);
        $this->validate($request, DealerValidator::DEALER_ADD);
        try{
            $dealer = Dealer::whereId($id)->firstOrFail();
            if($dealer){
                $dealer->first_name = $request->first_name;
                $dealer->last_name = $request->first_name;
                $dealer->contact_number = $request->contact_number;
                $dealer->email = $request->email;
                $dealer->address = $request->address;
                $dealer->update();
                flash('Dealer updated successfully.')->success();
                return redirect()->route('list-dealer');
            }else{
                flash("Dealer's detail not found.")->info();
                return redirect()->back();
            }
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
       * @method:    deleteDealer
       * @purpose:   delete dealer
       * @param $id
       * @return null
    */
    public function deleteDealer($id){
        $this->setNavigation(['menu-item-dealers']);
        try{
            $dealer = Dealer::find($id);
            $dealer->delete();
            flash('Dealer deleted successfully.')->success();
            return redirect()->back();
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
       * @method:    importExportView
       * @purpose:   blade view for import and export functionality
       * @param null
       * @return \Illuminate\Support\Collection
     */
    public function importExportView()
    {
        $this->setNavigation(['menu-item-dealers']);
        try{
            return view('import');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
       * @method:    export
       * @purpose:   export dealer data
       * @param null     
       * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        $this->setNavigation(['menu-item-dealers']);
        try{
            return Excel::download(new DealersExport, 'Dealers.xlsx');
        }catch(\Exception $e){
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }   
    /**
       * @method:    import
       * @purpose:   import files for dealer data
       * @param Request $request
       * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)

    {
        if ($request->isMethod('GET')) {
            return redirect('admin/dealers/list');
        }
        $this->setNavigation(['menu-item-dealers']);
        $this->validate($request, DealerValidator::DEALER_ADD_IMPORTFILE);
        $duplicate_records = array();
        try{
            $records = Excel::toArray(new DealersImport,request()->file('dealer_file'));
            foreach ($records[0] as $record) {
                    # check if email is duplicate
                    $check = Dealer::where('email', $record['email'])->count();
                    if($check){
                        array_push($duplicate_records, $record);
                        continue;
                    }
                    $check = Dealer::where('contact_number')->count();
                    if($check){
                        array_push($duplicate_records, $record);
                        continue;
                    }
                    Dealer::create($record);
            }
            flash('Excel file uploaded successfully.')->success();

        }catch(\Exception $e){
            flash('Empty xlsx file is not allowed.')->error();            
        }
        return view('admin.Dealers.list', compact('duplicate_records'));
    }
}