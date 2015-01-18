<?php
/*
| AuthCentral - Centralised 2-factor authentication
| Copyright (C) 2015 Internet by Design Ltd
|
| This program is free software; you can redistribute it and/or
| modify it under the terms of the GNU General Public License
| as published by the Free Software Foundation; either version 2
| of the License, or (at your option) any later version.
|
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
| GNU General Public License for more details.
|
| You should have received a copy of the GNU General Public License
| along with this program; if not, write to the Free Software
| Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class UsersController extends \BaseController {

  private $authy;

    public function __construct()
    {
      $this->authy = new Authy_Api(Config::get('auth.authy'));
    }

    public function index()
    {
        $users = User::all();

        return View::make('users.index', compact('users'));
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $data['user'] = $user;
        $data['domains'] = $user->domains;

        return View::make('users.show', $data);
    }

    /**
     * Show the form for editing the specified plan.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['plans'] = Plan::lists('name', 'id');

        return View::make('users.edit', $data);
    }

    /**
     * Update the specified plan in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::findOrFail($id);

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'first_name'       => 'required',
            'last_name'       => 'required',
            'email'       => 'required',
        );


        $validator = Validator::make($data = Input::only(['first_name', 'last_name', 'email']), $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user->update($data);

        return Redirect::route('users.index');
    }


	public function login()
	{
		return View::make('users.login');
	}

	public function handleLogin()
	{
		$data = Input::only(['email', 'password']);

		 $validator = Validator::make(
            $data,
            [
                'email' => 'required|email|min:8',
                'password' => 'required',
            ]
        );

        if($validator->fails()){
            return Redirect::route('login')->withErrors($validator)->withInput();
        }

        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            return Redirect::to('/panel');
        }

        return Redirect::route('login')->withInput();

	}

	public function panel()
	{
		return View::make('users.panel');
	}

	public function logout()
	{
		if(Auth::check()){
  			Auth::logout();
		}
 		return Redirect::route('login');
	}

	public function create()
	{
        // load the create form (app/views/domains/create.blade.php)
        return View::make('users.create');
	}

	public function store()
	{
		$data = Input::only(['first_name','last_name','email','password', 'password_confirmation']);

		$validator = Validator::make(
            $data,
            [
                'first_name' => 'required|min:2',
                'last_name' => 'required|min:5',
                'email' => 'required|email|min:5|unquie:useres',
                'password' => 'required|min:5|confirmed',
                'password_confirmation'=> 'required|min:5'
            ]
        );

		if($validator->fails()){
            return Redirect::url('create')->withErrors($validator)->withInput();
        }

        $data['password'] = Hash::make($data['password']);
        $data['plan_id'] = Input::get('plan_id') ? Input::get('plan_id') : 1;

        $newUser = User::create($data);
        if($newUser){
            Auth::login($newUser);
            return Redirect::route('panel');
        }

        return Redirect::route('user.create')->withInput();
	}

}
