<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

use Illuminate\Validation\ValidationException;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTraits;

use Session;
use Config;
use Inertia\Inertia;
use Auth;
use App\Models\User;




class AddressController extends Controller
{
    
    
    public function address(){
        
        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => env('APP_NAME', 'Application') . ' | Home',
            'description' => 'This is dummy description for the Application from dynamic'
        ];
        
        
        
        $countries = Country::with('states:id,name')->get();
        //$states = State::with(['country', 'cities:id,name'])->get();
        //$cities = City::with(['country', 'state'])->get();
        
        //dd($countries);
        
        $data = [
            'meta' => $meta,
            'auth' => $user,
            'countries' => $countries,
            //'states' => $states,
            //'cities' => $cities,
            
        ];
        
        return Inertia::render('Address/Index', $data);
    }
    
    
    public function saveAddress(Request $request)
    {
        //dd(1);
        
        $address = new Address();
        $address->user_id = Auth::id();
        $address->type = $request->addressType;
        $address->person_name = $request->personName;
        $address->save();
        return redirect()->route('cart.checkout');
    }
    
}