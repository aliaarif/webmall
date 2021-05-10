<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTraits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use Session;
use Config;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use Auth;

class AuthController extends Controller
{
    use CommonTraits, AuthenticatesUsers;
    
    
    /**
    * Where to redirect users after login.
    *
    * @var string
    */
    protected $redirectTo = RouteServiceProvider::HOME;
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }
    
    public function loginForm() {
        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => 'Login | '.env('APP_NAME', 'Application'),
            'description' => 'This is dummy description for the Application from dynamic'
        ];
        
        $data = [
            'meta' => $meta,
            'auth' => $user,
            'modules' => Config::get('modules', 'default'),
            'responseStatus' => Session::get('status') ?? false
        ];
        return Inertia::render('Login', $data);     
    }
    
    public function login(Request $request) {
        $validate = $this->validate($request, [
            'username' => 'required|string',
            'username' => 'required|string',
            ]);
            if($validate && (
                Auth::attempt(['username' => request('username'), 'password' => request('password')]) ||
                Auth::attempt(['email' => request('username'), 'password' => request('password')]) ||
                Auth::attempt(['mobile' => request('username'), 'password' => request('password')])
                )){
                    return redirect()->route('welcome'); 
                }else{
                    return back()->withStatus(false);
                }        
            }
            
            
            public function redirectToProvider($provider){
                return Socialite::driver($provider)->redirect();
            }
            
            public function handleProviderCallback($provider)
            {
                $user = Socialite::driver($provider)->user();
                $this->_registerOrLoginUser($user, $provider);
                return redirect()->route('dashboard');
            }
            
            
            public function _registerOrLoginUser($data, $provider){
                $user = User::where('email', $data->email)->first();
                if(!$user){
                    $user = new User();
                    $user->name = $data->name;
                    $user->email = $data->email;
                    //$user->provider_id = $data->provider_id;
                    $user->provider = $provider;
                    $user->avatar = $data->avatar;
                    //$user->password = Hash::make(Str::random(10));
                    $user->password = Hash::make('password');
                    $user->email_verified_at = now();
                    $user->save();
                    $userDetails = UserDetail::create(['user_id' => $user->id]);
                    $role = Role::where('name', 'User')->first();
                    $user->roles()->attach($role);
                }
                Auth::login($user);
            }
            
            
            public function logout()
            {
                Auth::logout();
                return redirect()->route('welcome');
            }
            
            
            
            public function purchase(){
                
            }
        }