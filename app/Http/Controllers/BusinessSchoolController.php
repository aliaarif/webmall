<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessSchool;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTraits;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;



class BusinessSchoolController extends Controller
{
    use CommonTraits;

     /**
     * Validate all the user data for login.
     *
     * @param  Request  $request
     * @return JSON|response
     */
    public function validateBusinessSchool(Request $request)
    {
        
        $messages = [
            'student_id.required'        => 'Please enter the correct ID number',
            'email.required_without:dob' => 'Please enter the correct Email Address',
            'dob.required_without:email' => 'Please enter the correct Date of Birth',
        ];
        
        $req = $request->all();
        $this->user_ip = $request->ip();

        $validate_arr = array('student_id' => 'required|numeric');
        if($req['email'])
        {
            $validate_arr['email'] = 'required_without:dob|email';
        }

        if($req['dob'])
        {
            $validate_arr['dob'] = 'required_without:email|date_format:d-m-Y';
        }

        $validator = Validator::make($request->all(), $validate_arr , $messages);

        $request['email'] = $request['email'] ?? "abc@gmail.com"; 
        $st_dob = $request['dob'] ?? "20/02/1995";
        $st_dob = str_replace("/", "-", $st_dob);
        
        $transaction_id = $this->generate_uuid();

        if ($validator->fails()) 
        {
            // log user activity
            $this->logUserActivity(21, $request['student_id'], $transaction_id, $request->ip());
            
            return response()->json(['errors'=>$validator->errors()]);
        }
        else
        {    
            //Order Data Insert   
            $applicant_data = [
                'applicant_id' => $request['student_id'],
                'email' => $request['email'],
                'date_of_birth' => $request['dob']
            ];
            
            // Get api token
            $token = $this->getAuthorisedToken();

            if(isset($token)) 
            {
                $this->logged_user_token =  $token;
                $this->api_id = 4;
                // To Get the data from Middleware Api
                $api_data = $this->callAPI('application-fees/applicant','POST',$applicant_data);
            
                if(!empty($api_data->user_data) && $api_data->status == 1){
                    $data = $api_data->user_data;
                    $firstname = $data->firstname;
                    $surname = $data->surname;
                    $email = $data->email ?? '';
                    $date_of_birth = date('d-m-Y', strtotime($data->date_of_birth)) ?? '';
                }
            
                // To save record
                $record = new BusinessSchool;
                $record->session_id = $transaction_id;
                $record->user_id=$request['student_id'];
                
                $record->save();
                session(['student_key'=> $record->id,'transaction_id'=> $transaction_id,'student_id'=>$request['student_id'],'dob'=>$date_of_birth,'email'=>$email,'fname'=>$firstname,'lname'=>$surname, 'login' => '1']);
                
                $this->addProgramSuiteItems($request['student_id']);
                // log user activity
                $this->logUserActivity(22,$request['student_id'], $transaction_id, $request->ip());

                return response()->json(array('status' => true, 'last_insert_id' => $record->id), 200);
            }
            else 
            {
                return response()->json(['errors' => $this->error_msg]);
            }
        }
    }

    /**
     * Update all the user data in database.
     *
     * @param  Request  $request
     * @return JSON|response
    */

    public function confirmApi(Request $request)
    {
        $transaction_id = $request->session()->get('transaction_id');
        $student_id = $request->session()->get('student_id');
        $this->user_ip = $request->ip();

       /* BusinessSchool::where('session_id', $request->session()->get('transaction_id'))
        ->update(['user_id' => $student_id]); */
        // log user activity
        $this->logUserActivity(23, $student_id, $transaction_id, $request->ip());
        return response()->json(array('status' => true), 200);

    }

     /**
     * Create the Programme Suit Items List
     *
     * @return void
     */

    public function addProgramSuiteItems($applicant_id)
    {
        // get api token
        $token = $this->getAuthorisedToken();

        if(isset($token))
        {
            $this->logged_user_token =  $token;
            $this->api_id = 5;
            // To Get Programme Suit Items from Middleware Api
            $data = [];
            $Programms_list = $this->callAPI('application-fees/'.$applicant_id,'GET',$data);
            $suite_items = array();

            if(!empty($Programms_list->applications) && $Programms_list->status == 1){
                $suite_items = $Programms_list->applications;
            }
        
            $sort_suit = array();
            $sortsuit_items = array();
            foreach($suite_items as $suit => $items)
            {
                $sort_suit[$suit]  = $items ->group_title;
                foreach($items ->programmes as $key => $value)
                {
                    $sortsuit_items[$key]  = $value ->fee;
                }   
                array_multisort($sortsuit_items, SORT_DESC, $items ->programmes);  
            } 
            array_multisort($sort_suit, SORT_ASC, $suite_items);

            $suite_arr_json = json_encode($suite_items); 
            session(['Suite_items' => $suite_arr_json]);
        }
        else 
        {
            return response()->json(['errors' => $this->error_msg]);
        }
    }

     /**
     * Get the Selected Suite Items List
     *
     * @param  Request  $request
     * @return JSON|response
     */

    public function suiteItemsDetail(Request $request)
    {
        $this->user_ip = $request->ip();
        session(['SelectedSuite_items' => $request['SelectedSuite_items']]);  
        $transaction_id = $request->session()->get('transaction_id');
        $student_id = $request->session()->get('student_id');
        // log user activity
        $this->logUserActivity(24, $student_id, $transaction_id, $request->ip());
        return response()->json(array('status' => true,'SelectedSuite_items'=>$request['SelectedSuite_items']), 200);
    }

     /**
     * To logout the user and flush session
     *
     * @param  Request  $request
     * @return void
    */

    public function logout(Request $request)
    {
        $this->user_ip = $request->ip();
        $transaction_id = $request->session()->get('transaction_id');
        $student_id = $request->session()->get('student_id');
        
        
        $this->logUserActivity(28, $student_id, $transaction_id, $request->ip());
        $request->session()->flush();
       return redirect('/');
    }


    /**
     * Update the Programme and items data
     *
     * @param  Request  $request
     * @return void
    */

    public function businessApplicationOrder(Request $request)
    {
        $this->user_ip = $request->ip();
        $transaction_id = $request->session()->get('transaction_id');
        $student_id = $request->session()->get('student_id');
        
        $application_arr = $request->session()->get('SelectedSuite_items');
        
        $programme_arr = array_column($application_arr, 'programme');
      
        $item_desc_arr = array_column($application_arr, 'Description');
       
        $item_no_arr = array_column($application_arr, 'Item_no');

        $amountpaid_arr = array_column($application_arr, 'amount');
        $amount_paid = array_sum($amountpaid_arr);
        
        $orderData = ['session_id' => $transaction_id, 'user_id' => $student_id, 'amount' => $amount_paid, 'module_name' => 'BASF', 'ip_address' => $this->user_ip];
        
        $objOrder = new Order();
        $objOrder->session_id = $orderData['session_id'];
        $objOrder->user_id = $orderData['user_id'];
        $objOrder->amount = $orderData['amount'];
        $objOrder->module_name = 'BASF';
        $objOrder->ip_address = $orderData['ip_address'];
        $orderid = $objOrder->save();

        $item_arr = [];
        $i = 0;
        
        foreach($programme_arr as $val)
        {
            array_push($item_arr, ['order_id' => $orderid, 'item_name' => $val, 'item_price' => $amountpaid_arr[$i] , 'item_notes' => $item_desc_arr[$i], 'Item_qty' => 1,'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s') ]);

            $i++;
        }
        
        
        OrderItems::insert($item_arr);
        $student_id = $request->session()->get('student_id');
        // log user activity
        $this->logUserActivity(25, $student_id, $transaction_id, $request->ip());

        return \Redirect::route('payment_confirmation', ['transaction_id' => $transaction_id ,'paid_programmes' => $item_no_arr]);
       
    }
}