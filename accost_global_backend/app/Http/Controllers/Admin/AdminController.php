<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\Validators\ChangePasswordValidators;
use App\Traits\BooleanToggleTrait;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {
	use BooleanToggleTrait;
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		if (\Auth::guard()->check()) {
			return redirect()->route('admin-dashboard');
		}
		return redirect()->route('login');
	}
	/**
	 * view admin dashboard
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * updated: 21-Nov-2019
	 */
	public function viewDashboard() {
		$this->setNavigation(['menu-item-dashboard']);
		return view('admin.dashboard');
	}
	/**
	 * view admin setting password_get_info(hash)
	 * updated: 21-Nov-2019
	 */
	public function viewAccountSetting() {
		$this->setNavigation(['menu-item-dashboard']);
		return view('admin.settings');
	}
	/**
	 * update auth user password
	 * @param Request $request
	 */
	public function updateAuthUserPassword(Request $request) {
		$this->validate($request, ChangePasswordValidators::CHANGE_PASSWORD);
		$user = User::find(Auth::id());
		if (Hash::check($request->current, $user->password)) {
			$user->password = bcrypt($request->password);
			$user->save();
			flash('Password changed Successfully')->success();
			return redirect()->back();
		}
		flash('Current password did not matched.')->error();
		return redirect()->back()->withInput();
	}
	/**
	 * toggle status of of any bool column
	 * updated: 26-nov-2019
	 * @param $id,$model, $column,
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function toggleStatus($model, $column, $id, $msg = '', $redirect_page = '') {
		$this->toggleBool($model, $column, $id);
		if (!empty($msg)) {
			flash($msg)->success();
			return redirect()->route($redirect_page);
		} else {
			flash('Status updated successfully.')->success();
			return redirect()->back();
		}

	}
	/**
	 * edit admin profile
	 * @param ''
	 * @return edit blade view
	 */
	public function editAdminProfile() {
		$this->setNavigation(['menu-item-dashboard']);
		$user = User::find(Auth::id());
		$user_profile = $user->user_profile()->first();
		return view('admin.edit_profile', compact('user_profile'));
	}
	/**
	 * update Admin profile
	 * @param Request $request,
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateAdminProfile(Request $request) {
		$this->setNavigation(['menu-item-dashboard']);
		$this->validate($request,
			[
				'first_name' => 'required|max:256|string',
				'last_name' => 'required|max:256|string',
				'gender' => 'required',
				'contact_number' => 'required',
			]
		);
		$userData = [
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'gender' => $request->gender,
			'contact_number' => $request->contact_number,
		];
		$user = User::find(Auth::id());
		$user_profile = UserProfile::where('user_id', $user->id)->update($userData);
		flash('Admin profile updated successfully.')->success();
		return redirect()->back();
	}
	public function get_msg_notification() {
		return view('layouts.admin_header', compact('msg_notification1'));
	}
}