<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Response;
use Redirect;
use App\Models\{Country, State, City};

class DropdownController extends Controller
{
    public function index()
    {
        $data['countries'] = Country::get(["name", "id"]);
        return view('welcome', $data);
    }
    
    public function fetchState(Request $request)
    {
        $states = State::where("country_id",$request->countryId)->get(["name", "id"]);
        return response()->json(['status' => true, 'states' => $states], 200);
    }
    
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
}