<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\Http\Controllers\Controller;
use App\Lib\Validators\StaticPageValidators;
use App\StaticPage;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * view list of static pages
     * updated: 25-nov-2019
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPages()
    {
        $this->setNavigation(['menu-item-pages-banners']);
        return view('admin.Pages.list');
    }
    /**
     * return data to jquery data-table
     * updated: 25-nov-2019
     * @return \Illuminate\Http\JsonResponse
     */
    public function pageData()
    {
        $this->setNavigation(['menu-item-pages-banners']);
        return datatables(StaticPage::latest())
            ->addColumn('action', function ($id) {
                return '<a href="'.route('view-static-pages',$id).'"><i class="fas fa-eye"></i></a>&nbsp&nbsp
                <a href="'.route('edit-static-pages',$id).'"><i class="fas fa-edit"></i></a>
                  '; })
            ->toJson();
    }
    /**
     * view edit form
     * updated: 25-nov-2019
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setNavigation(['menu-item-pages-banners']);
        try {
            $static_page = StaticPage::where('id',$id)->firstOrFail();
            return view('admin.Pages.edit', compact('static_page'));
        } catch (\Exception $e) {
            flash('Invalid static pages.')->error();
            return redirect()->route('list-pages');
        }
    }
    /**
     * Update static page contents
     * updated: 25-nov-2019
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->setNavigation(['menu-item-pages-banners']);
        $this->validate($request, StaticPageValidators::STATIC_PAGE);
        try {
            StaticPage::where('id',$id)->update($request->except('_token'));
            flash('Page updated successfully.')->success();
            return redirect()->route('list-pages');
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back();
        }
    }
    /**
     * view static page details
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function view($id)
    {
        $this->setNavigation(['menu-item-pages-banners']);
        try {
            $static_page = StaticPage::where('id',$id)->firstOrfail();
            return view('admin.Pages.detail',compact('static_page'));
        } catch (\Exception $e) {
            flash('Invalid static page #id.')->error();
            return redirect()->route('list-pages');
        }
    }

    public function newFaq(Request $request)
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-manage-faq']);
        try {
            if ($request->isMethod('POST')) {
                $values = [
                    'question' => $request->question,
                    'answer' => $request->answer
                ];
                Faq::create($values);
                flash('Question Added successfully.')->success();
                return redirect()->back();
            }
            $faqs = Faq::orderBy('id','DESC')->get();
            return view('admin.Faq.faq', compact('faqs'));
        } catch (\Exception $e) {
            return redirect()->route('list-pages');
        }
    }

    public function listFaq()
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-manage-faq']);
        try {
            $faqs = Faq::orderBy('id','DESC')->get();
            return view('admin.Faq.list', compact('faqs'));
        } catch (\Exception $e) {
            return redirect()->route('list-pages');
        }
    }

    public function editFaq(Request $request, $id)
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-manage-faq']);
        try {
            if ($request->isMethod("POST")) {
                Faq::where('id', '=', $id)->update($request->except('_token'));
                flash('FAQ updated successfully.')->success();
                return redirect()->back();
            }
            $faq = Faq::where('id','=',$id)->first();
            return view('admin.Faq.edit-faq', compact('faq'));
        } catch (\Exception $e) {
            return redirect()->route('list-pages');
        }
    }

    public function viewFaq($id)
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-manage-faq']);
        try {
            $faq = Faq::where('id','=',$id)->first();
            return view('admin.Faq.view', compact('faq'));
        } catch (\Exception $e) {
            return redirect()->route('list-pages');
        }
    }

    public function deleteFaq($id)
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-manage-faq']);
        try {
            $faq = Faq::where('id','=',$id)->delete();
            flash('FAQ updated successfully.')->success();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('list-pages');
        }
    }

    public function faqData()
    {
        $this->setNavigation(['menu-item-pages-banners','menu-item-manage-faq']);
        $data = Faq::all();
        return datatables()->Collection($data)
            ->addColumn('action', function ($modal) {
                $statusIcon = ($modal->status == 0) ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>';
                return '<a href="'.route('view-faq-pages',$modal->id).'"><i class="fas fa-eye"></i></a>&nbsp&nbsp
                <a href="'.route('toggle-status',['model'=>'Faq','column'=>'status','id'=>$modal->id]).'" data-toggle="tooltip" title="Change Status">'.$statusIcon.'</a>&nbsp
                <a href="'.route('edit-view-faq-pages',$modal->id).'"><i class="fas fa-edit"></i></a>&nbsp
                <a href="'.route('delete-faq-pages',$modal->id).'" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fas fa-trash text-danger"></i></a>
                  '; })
            ->addIndexColumn()
            ->toJson();
    }
}