<?php

namespace App\Http\Controllers\Auth;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $guard = 'web';
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
     public function showLoginForm()
    {
        return view('pages.login');
    }
    public function guard()
    {
        return auth()->guard('web');
    }
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
    public function login(Request $request)
    {
        $okay = Validator::make($request->all(), [
            'username' => 'required|string', 'password' => 'required',
        ]);

        if($okay->fails()){
            return array('errors' => $okay->errors()->first());
        }


        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            if(Auth::user()->user_type == 1){
                $employee = DB::table("employee")
                        ->join('division', 'employee.division_id', "=", "division.id")
                        ->select('employee.*', 'division.name')
                        ->where('employee.id', Auth::user()->employee_id)->first();
                $request->session()->put([
                    'no_reg' => $employee->no_reg,
                    'employee_name' => $employee->first_name." ".$employee->last_name,
                    'division_id' => $employee->division_id,
                    'division_name' => $employee->name
                ]);
            }
            return redirect('home');
        }
        else
        {
            Session::flash('error.message', 'Username or Password are wrong.');
            return redirect('/');
        }


    }
}
