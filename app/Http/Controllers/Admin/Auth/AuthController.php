<?php

namespace App\Http\Controllers\Admin\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/admin';
    protected $guard = 'admin';
    
    /*
	    Login
    */

    public function getLogin() {
    	return $this->showLoginForm();
    }

    public function showLoginForm() {
    	if (\Auth::guard($this->guard)->check())
		{
			return redirect()->route('admin.index');
		}
	    return view('admin.auth.login');
    }

    public function postLogin(Request $request) {
    	return $this->login($request);
    }

    public function login(Request $request) {
    	$validator = $this->validateLogin($request->all());
    	if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
    	$credentials = [
    		'email' 	=> $request->email,
    		'password' 	=> $request->password,
            'active'    => 1
    	];

        if( \Auth::guard($this->guard)->attempt($credentials) ) {
        	if($request->_url) {
	            $url = $request->_url;
	    		return redirect($url);
        	}else {
        		return redirect($this->redirectTo);
        	}
    	} else {
    		return redirect()->back()->withErrors(['email' => 'Tài khoản không chính xác!'])->withInput();
    	}
    }
	
	protected function validateLogin(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
    }

	/*
	    Register
    */

    public function getRegister() {
    	return $this->showRegistrationForm();
    }

	public function showRegistrationForm()
	{
		return view('admin.auth.register');
	}

	public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    public function register(Request $request)
    {
        $validator = $this->RegValidator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(\Auth::guard($this->guard)) $this->create($request->all());

        if($request->_url) {
            $url = $request->_url;
            return redirect($url);
        }else {
            return redirect($this->redirectTo);
        }
    }

	protected function RegValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return \App\Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'active'    => 1,
            'role'  => 'admin'
        ]);
    }

	/*
	    Reset password
    */

    public function getReset()
    {
        return view('auth.passwords.email');
    }

	/*
	    Logout
    */

	public function logout() {
		\Auth::guard($this->guard)->logout();
		return redirect()->route('admin.login');
	}
}
