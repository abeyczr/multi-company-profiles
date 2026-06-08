<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Http\Requests\UsersRegisterRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller{
	

	/**
     * Authenticate and login user
     * @return \Illuminate\Http\Response
     */
	function login(Request $request){
		$username = $request->username;
		$password = $request->password;
		if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
			Auth::attempt(['email' => $username, 'password' => $password]); //login with email 
		} 
		else {
			Auth::attempt(['username' => $username, 'password' => $password]); //login with username
		}
        if (!Auth::check()) {
            return redirect("index/login")->withErrors("Username or password not correct");
        }
		$user = auth()->user();
		return $this->redirectIntended("/home", "Login completed");
	}
	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function logout(Request $request){
		Auth::logout();
		return redirect('/');
	}
	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function accountcreated(Request $request){
		return view("pages.index.accountcreated");
	}
	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function accountblocked(Request $request){
		return view("pages.index.accountblocked");
	}
	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function accountpending(Request $request){
		return view("pages.index.accountpending");
	}
}
