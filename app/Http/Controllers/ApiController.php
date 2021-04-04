<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTraits;
use App\Http\Controllers\Exception;

class ApiController extends Controller
{

    public function ApplicantDeposits_Login(Request $request)
    {
        try {
            $applicant_data = [ 
                "firstname" => "John",
                "surname" => "Doe",
                "email" => $request['email'] ?? "user@exaample.com",
                "date_of_birth" => $request['date_of_birth'] ?? "2000-06-23",
                "course" => "N201"
            ];

            return response()->json(array('status' => true, 'applicant_data' => $applicant_data), 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function ApplicantDeposits_Deposits(Request $request)
    {    
        try {
            $deposits = [
                "0" => [
                        'id'=> 1234,
                        'description'=> "Advanced Rent Charge for College Accommodation",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "Advanced Rent Charge for College Accommodation"
                        ],
                "1" => [
                        'id'=> 5678,
                        'description'=> "Visa application tuition deposit",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "Visa application tuition deposit"
                        ],
                "2" => [
                        'id'=> 8910,
                        'description'=> "MBA Tuition Fee first installment",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "MBA Tuition Fee first installment"
                        ],
                "3" => [
                        'id'=> 1357,
                        'description'=> "Tuition Fee Deposit",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "Tuition Fee Deposit"
                        ],
                "4" => [
                        'id'=> 7912,
                        'description'=> "Fudan DBA Deposit",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "Fudan DBA Deposit"
                        ], 
                "5" => [
                        'id'=> 8901,
                        'description'=> "Global DBA Deposit",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "Global DBA Deposit"
                        ],  
                "6" => [
                        'id'=> 1101,
                        'description'=> "Durham DBA Deposit",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "Durham DBA Deposit"
                        ],
                "7" => [
                        'id'=> 1324,
                        'description'=> "Pre-sessional course (payment)",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "Pre-sessional course (payment)"
                        ],
                "8" => [
                        'id'=> 5782,
                        'description'=> "Pre-sessional course (residence)",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "Pre-sessional course (residence)"
                        ],
                "9" => [
                        'id'=> 4576,
                        'description'=> "Pre-sessional course (JB trust fund)",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "Pre-sessional course (JB trust fund)"
                        ],
                "10" => [
                        'id'=> 0342,
                        'description'=> "Pre-sessional course (MCR levy)",
                        'amount'=> number_format(mt_rand(100, 999),2),
                        'note'=> "Pre-sessional course (MCR levy)"
                        ],
                "11" => [
                        'id'=> 5098,
                        'description'=> "Tuition deposit needed for visa application",
                        'amount'=> '',
                        'note'=> "Payment required for visa purpose."
                        ]
    
                        
            ];
    
            function randomGen($min, $max, $quantity) {
                $numbers = range($min, $max);
                shuffle($numbers);
                return array_slice($numbers, 0, $quantity);
            }
            
            $rand_num = randomGen(0,11,6);

            // $num1 = mt_rand(0,11);
            // $num2 = mt_rand(0,11);
            // $num3 = mt_rand(0,11);
            // $num4 = mt_rand(0,11);
            // $num5 = mt_rand(0,11);
            // $num6 = mt_rand(0,11);
    
            $result = array('0' => $deposits[$rand_num[0]], '1' => $deposits[$rand_num[1]], '2'=> $deposits[$rand_num[2]], '3' => $deposits[$rand_num[3]], '4' => $deposits[$rand_num[4]],'5' => $deposits[$rand_num[5]]);
            
            return response()->json(array('status' => true, 'deposits' => $result), 200);
    
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function DepositsTransaction_Details(Request $request)
    {

        try{
            $sucess_msg = 'For successfully received and validated deposit IDs.';
            return response()->json(array('status' => true, 'sucess_msg' => $sucess_msg),200);

        }catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function ApplicationFees_Login(Request $request)
    {
        
        try {
            $user_data = [ 
                "firstname" => "John",
                "surname" => "Doe",
                "email" => $request['email'] ?? "applicant@example.com.com",
                "date_of_birth" => $request['date_of_birth'] ?? "2000-06-23"
            ];

            return response()->json(array('status' => true, 'user_data' => $user_data), 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function ApplicationFees_Deposits(Request $request){
        
        try{

            $applications = [
                [ 
                    'group_id' => 101,
                    'group_title' => "Finance",
                    'programmes'=> [
                        [
                            'id' => 456,
                            'code' => "N3K209",
                            'title'=> "MSc Finance (Accounting & Finance)",
                            'fee'=> number_format(mt_rand(100, 999),2)
                        ],
                        [
                            'id' => 123,
                            'code' => "N5K610",
                            'title'=> "BSc Finance (Accounting & Finance)",
                            'fee'=> number_format(mt_rand(100, 999),2) 
                        ],
                        [
                            'id' => 789,
                            'code' => "N5K611",
                            'title'=> "MBA Marketing",
                            'fee'=> number_format(mt_rand(100, 999),2) 
                        ],
                    ]
                ],
                [ 
                    'group_id' => 102,
                    'group_title' => "Marketing",
                    'programmes'=> [
                        [
                            'id' => 123,
                            'code' => "M3K001",
                            'title'=> "MSc Marketing",
                            'fee'=> number_format(mt_rand(100, 999),2)
                        ],
                        [
                            'id' => 456,
                            'code' => "M3K002",
                            'title'=> "BSc Marketing",
                            'fee'=> number_format(mt_rand(100, 999),2) 
                        ],
                        [
                            'id' => 789,
                            'code' => "M3K003",
                            'title'=> "MBA Marketing",
                            'fee'=> number_format(mt_rand(100, 999),2) 
                        ],
                    ]
                ],
                [ 
                    'group_id' => 103,
                    'group_title' => "Accounting",
                    'programmes'=> [
                        [
                            'id' => 123,
                            'code' => "A3K101",
                            'title'=> "MSc Accounting",
                            'fee'=> number_format(mt_rand(100, 999),2)
                        ],
                        [
                            'id' => 456,
                            'code' => "A3K101",
                            'title'=> "BSc Accounting",
                            'fee'=> number_format(mt_rand(100, 999),2) 
                        ],
                        [
                            'id' => 789,
                            'code' => "A3K103",
                            'title'=> "MBA Accounting",
                            'fee'=> number_format(mt_rand(100, 999),2) 
                        ],
                    ]
                ]
            ];
            return response()->json(array('status' => true, 'applications' => $applications), 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function ApplicationFeesTransaction_Details(Request $request)
    {
        try{
            $sucess_msg = 'For successfully received and validated programme IDs.';
            return response()->json(array('status' => true, 'sucess_msg' => $sucess_msg),200);

        }catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    

    
    
    public function directDebitAuth(Request $request)
    {
        $messages = [
            'required' => ':attribute can not be blank.'
            
        ];
        
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'date_of_birth' => 'required|date_format:d-m-Y',
        ] , $messages);

        $errors = ['errors'=>$validator->errors(),'status'=>false];

        if ($validator->fails()) {
           
            return response()->json(['errors'=>$validator->errors(),'status' => 400]);
            
        }else{
            $jsonArray = [
                "firstname" => "John",
	            "surname"=> "Doe",
	            "addresses" => [
                    "permanent" => "742 Evergreen Terrace, Springfield, USA",
                    "term" => "123 Fake Street, Springfield, USA" ]
                ];
            return response()->json(array('status' => 200, 'response' => $jsonArray), );
            
        }
    }

    public function directDebitValidate(Request $request)
    {
        $messages = [
            'required' => ':attribute can not be blank.'
            
        ];

        $validator = Validator::make($request->all(), [
            'sort_code' => 'required',
            'account_number' => 'required',
        ] , $messages);

        $errors = ['errors'=>$validator->errors(),'status'=>false];
        if ($validator->fails()) {
           
            return response()->json(['errors'=>$validator->errors(),'status' => 400]);
            
        }else{
        $jsonArray = [
            "valid" => true,
                "bank_details"=> [
                "name"=> "MONZO BANK LIMITED",
                "branch"=> "Monzo",
                "address" => "Broadwalk House, 5 Appold Street, London, EC2A2AG",
                "debit_allowed" => true,
                "last_checked" => "2020-12-02T16:22:00.000Z"]
        ];
        return response()->json(array('status' => 200, 'response' => $jsonArray), );
        }
    }

    public function directDebitSave(Request $request,$user)
    {
        $messages = [
            'required' => ':attribute can not be blank.'
            
        ];

        $validator = Validator::make($request->all(), [
            'sort_code' => 'required',
            'account_number' => 'required',
            'account_holder' => 'required',
            'address' => 'required',
            'email' => 'required',
        ] , $messages);

        $errors = ['errors'=>$validator->errors(),'status'=>false];
        if ($validator->fails()) {
           
            return response()->json(['errors'=>$validator->errors(),'status' => 400]);
            
        }else{
            
        return response()->json(array('status' => 200, 'response' => 'successfully saved'), );
        }
    }

    public function printCreditBalance(Request $request,$user)
    {
        
        $jsonArray = [
            "paid"=> "10.00",
            "free"=> "1.00"
        ];
        
        if ($user=="") {
           
            return response()->json(['errors'=>'user id not found','status' => 400]);
            
        }else{
            
        return response()->json(array('status' => 200, 'response' => $jsonArray), );
        }
    }

    public function printCreditSave(Request $request,$user)
    {
        $messages = [
            'required' => ':attribute can not be blank.'
            
        ];

        $validator = Validator::make($request->all(), [
            'value' => 'required'
        ] , $messages);

        $errors = ['errors'=>$validator->errors(),'status'=> 400];
        if ($validator->fails()) {

            return response()->json(['errors'=>$validator->errors(),'status' => 400]);
            
        }else{
            
        return response()->json(array('status' => 200, 'response' =>'successfully received print credits'), );
        }
    }

    public function printCreditTransactions($user)
    {
        $jsonArray =[
            [
                "datetime"=> "2020-11-19T10:01:06.000Z",
                "type"=> "Printing",
                "description"=> "Print: Test.docx",
                "cost"=> "0.20",
                "deposit"=> "0.00",
                "credit"=> [                    
                    "paid"=> "29.10",
                    "free"=> "1.00"
                ]
            ],
            [
                "datetime"=> "2020-11-17T18:43:27.000Z",
                "type"=> "Cashier",
                "description"=> "Online payment",
                "cost"=> "0.00",
                "deposit"=> "5.00",
                "credit"=> [
                    "paid"=> "29.30",
                    "free"=> "1.00"
                ]
            ],
            [
                "datetime"=> "2020-11-17T18:43:27.000Z",
                "type"=> "Printing",
                "description"=> "Print: Test.docx",
                "cost"=> "0.90",
                "deposit"=> "0.00",
                "credit"=> [
                    "paid"=> "24.30",
                    "free"=> "1.00"
                ]
            ],
            [
                "datetime"=> "2020-11-17T18:43:27.000Z",
                "type"=> "Cashier",
                "description"=> "Online payment",
                "cost"=> "0.00",
                "deposit"=> "10.00",
                "credit"=> [
                    "paid"=> "25.20",
                    "free"=> "1.00"
                ]
            ],
            [
                "datetime"=> "2020-11-17T18:43:27.000Z",
                "type"=> "Printing",
                "description"=> "Print: Test.docx",
                "cost"=> "1.00",
                "deposit"=> "0.00",
                "credit"=> [
                    "paid"=> "15.20",
                    "free"=> "1.00"
                ]
            ],                                    
        ];

        if ($user=="") {
           
            return response()->json(['errors'=>'user id not found','status' => 400]);
            
        }else{
            
        return response()->json(array('status' => 200, 'response' => $jsonArray), );
        }
    }

    public function generateToken(Request $request)
    {
        $header = $request->header();
        $uname = $header['php-auth-user'][0];
        $pass = $header['php-auth-pw'][0];

        if($uname == 'admin' && $pass == 'password' )
        {           
            return response()->json(["token" => md5(uniqid(rand(), true)) , "expires" => date( 'Y-m-d h:i:s', strtotime( date('Y-m-d h:i:s') . ' +1 day' ) ) ]);
        }
        else{
            return response()->json(['errors'=> 'Invalid Username Or password']);
        }
    }

    public function updateTransaction(Request $request)
    {
         
        $messages = [
            'required' => ':attribute can not be blank.'
            
        ];
        
        $validator = Validator::make($request->all(), [
            'application' => 'required',
            'transaction' => 'required',
            'value' => 'required'
        ] , $messages);

        

        if ($validator->fails()) {
           
            return response()->json(['errors'=>$validator->errors(),'status' => 400]);
            
        }else{
            return response()->json(array('status' => 200, 'reponse' => 'success') );
        }
    }

    public function getUser(Request $request,$user)
    {
        $jsonArray= [
            "title" => "Mr",
            "firstname" => "Homer",
            "surname" => "Simpson",
            "email" => "chunkylover53@example.com",
            "studentid" => "000123456",
            "staffid" => "7239451"
        ];

        if ($user=="") {
           
            return response()->json(['errors'=>'user not found','status' => 400]);
            
        }else{
            
            return response()->json(array('status' => 200, 'response' => $jsonArray), );
        }
    }

    //  API for BSST 

    public function GetBusinessSchoolStudyTours(Request $request){
        try{
            $suiteItems = [
             [
                "programme_code"=> 1,
                "programme_title"=> "MSc Management",
                "tours"=> [
                    [                    
                        "id"=> 1,
                        "destination"=> "Delhi, India",
                        "schedule" => "March 21, 2021 to March 22, 2021",
                        "fee" => 390
                    ],
                    [                    
                        "id"=> 2,
                        "destination"=> "Mumbai, India",
                        "schedule" => "March 22, 2021 to March 23, 2021",
                        "fee" => 470
                    ],
                    [                    
                        "id"=> 3,
                        "destination"=> "Kathmandu, Nepal",
                        "schedule" => "March 23, 2021 to March 24, 2021",
                        "fee" => 470
                    ],

                ]
            ],

            [
                "programme_code"=> 2,
                "programme_title"=> "Environmental Engg",
                "tours"=> [
                    [                    
                        "id"=> 1,
                        "destination"=> "Kathmandu, Nepal",
                        "schedule" => "March 24, 2021 to March 25, 2021",
                        "fee" => 390
                    ],
                    [                    
                        "id"=> 2,
                        "destination"=> "Mumbai, India",
                        "schedule" => "March 25, 2021 to March 26, 2021",
                        "fee" => 470
                    ],
                    [                    
                        "id"=> 3,
                        "destination"=> "Kathmandu, Nepal",
                        "schedule" => "March 26, 2021 to March 27, 2021",
                        "fee" => 470
                    ],

                ]
            ],

        [
            
            "programme_code"=> 3,
            "programme_title"=> "Art & Environmental Eng",
            "tours"=> [
                [                    
                    "id"=> 1,
                    "destination"=> "Mumbai, India",
                    "schedule" => "March 27, 2021 to March 28, 2021",
                    "fee" => 190
                ],
                [                    
                    "id"=> 2,
                    "destination"=> "Delhi, India",
                    "schedule" => "March 25, 2021 to March 26, 2021",
                    "fee" => 220
                ],
                [                    
                    "id"=> 3,
                    "destination"=> "Mumbai, India",
                    "schedule" => "March 26, 2021 to March 27, 2021",
                    "fee" => 335
                ],

            ]
        ],
        ];
                return response()->json(['status' => true, 'suiteItems' => $suiteItems], 200);
            }catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 500);
            }

    }

    //  API for LP 

    public function GetLibraryPayments(Request $request){
       try{

        $suiteItems1 = [1,2,3,4];
                $suiteItems = [
                        [                    
                                "id"=> 12345,
                                "type"=> "OverdueRenewal 1",
                                "description" => "American psycho 1",
                                "date_assessed" => "March 26, 2021",
                                "charge" => 340
                        ],
                        [                    
                                "id"=> 12346,
                                "type"=> "OverdueRenewal 2",
                                "description" => "American psycho 2",
                                "date_assessed" => "March 27, 2021",
                                "charge" => 350
                        ],
                        [                    
                                "id"=> 12347,
                                "type"=> "OverdueRenewal 3",
                                "description" => "American psycho 3",
                                "date_assessed" => "March 27, 2021",
                                "charge" => 390
                       ],
       
                    ];
                    session(['suiteItems' => $suiteItems1]);
        
        
                return response()->json(['status' => true, 'suiteItems' => $suiteItems], 200);
            }catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
}