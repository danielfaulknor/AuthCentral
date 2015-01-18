<?php

class SettingsController extends \BaseController {


	private $authy;

	public function __construct()
	{
		$this->authy = new Authy_Api(Config::get('auth.authy'));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$data = array(
									'MultiFactorMethods' => Multifactormethod::all(),
									'UserMethods' => Auth::user()->multifactorMethods()->orderBy('multifactormethod_user.order', 'asc')->get()
		);
		return View::make('settings.index', $data);
	}

	public function authyRegister()
	{

	  return View::make('settings.authy_views.register');

	}

	public function authyRegisterStore()
	{
		$data = Input::only(['country', 'phone']);

		$validator = Validator::make(
		$data,
		[
			'country' => 'required|min:1',
			'phone' => 'required|min:6',
			]
		);

		if($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		print_r($data);
	}


}
