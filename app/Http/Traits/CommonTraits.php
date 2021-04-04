<?php
namespace App\Http\Traits;
use App\Models\ActivityLog;
use App\Models\ApiToken;
//use App\Models\ApiStatus;
use App\Models\ApiCall;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait CommonTraits
{
    public $logged_user_token = "";
    public $api_id = 0;
    public $error_msg = "Unotherized Access1";

    /**
     * Generate UUID
     */
    public function generate_uuid()
    {
        $data = $data ?? bin2hex(random_bytes(16));
        return  vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Generic funciton to make API calls
     * @param $url, $method, $data
     * @return JSON|response
     */
    public function callAPI($url, $method, $data, $auth_type = 'Bearer')
    {

        

        $curl = curl_init();


        // Set common request headers
        $request_header = array(
            "accept: */*",
            "accept-language: en-US,en;q=0.8",
            'Content-Type: application/json'
        );


    

         // Set Authorization in request header
         if($auth_type == 'Basic')
         {
             $username = config('apiconfig.username');
             $password = config('apiconfig.password');

           

             curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
             curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

           
         }
         else
         {
            array_push($request_header, "Authorization: Bearer ".$this->logged_user_token);
         }


         // Set curl options
         curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_ENDPOINT', 'http://application/api/').$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $request_header
        ));


       
        if($method == "POST")
        {
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        // execute
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $curlinfo = curl_getinfo($curl);
        curl_close($curl);
        // log API request and response into api_log
        $this->logAPICall($data, json_decode($response, true) ,$curlinfo, $request_header);

        return !$err ? json_decode($response) : null;
    }

    /**
     * Get API Auth token to make API calls, returns token from database if exists and still valid
     * else makes API calls to get the new token
     * @return string|token
     */
    public function getAuthorisedToken()
    {
        $token = null;
        // Get token from DB
        $token_data = $this->getTokenFromDB();
        $cur_time = date('Y-m-d H:i:s');
        // check if token exists and still valid (not expired) for API calls
        if(isset($token_data->expire_time) && $token_data->expire_time < $cur_time)
        {
            $token = $token_data->token;
        }
        else
        {
            // Make API call to get the new token
            $data = [];
            $response = $this->callAPI('auth/token','POST', $data, 'Basic');
            //$response = ["token" => md5(uniqid(rand(), true)) , "expires" => date( 'Y-m-d h:i:s', strtotime( date('Y-m-d h:i:s') . ' +1 day' ) ) ];
           
            $response = (array) $response;
            $this->api_id = 1;

            if(isset($response) && !empty($response))
            {
                $token = $response['token'];
                 // Store auth token into api_tokens table
                 $ApiToken = new ApiToken;
                 $ApiToken->token = $token;
                 $ApiToken->expire_time = $response['expires'];
                 $ApiToken->save();
                 $token = $token;
            }
        }
        return $token;
    }


    /**
     * Get API Auth token to make API calls, returns token from database if exists and still valid
     * else makes API calls to get the new token
     * @return string|token
     */
    public function getAuthorisedTokenFromTestAPI($url, $method)
    {
        $curl = curl_init();

        // Set common request headers
        $request_header = array(
            "accept: */*",
            "accept-language: en-US,en;q=0.8",
            'Content-Type: application/json'
        );
         // Set Authorization in request header
        $username = "admin";
        $password = "password";

        curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

         // Set curl options
         curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $request_header
        ));
        // execute
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $curlinfo = curl_getinfo($curl);
        curl_close($curl);

        return !$err ? json_decode($response) : $err;
    }

    /**
     * Get Latest token stored in database
     * @param
     * @return {object}
     */
    private function getTokenFromDB()
    {
        // Get latest token record from DB
        $token_record = null;
        $token_res = ApiToken::orderBy('id', 'desc')->first('token', 'expire_time');
        if(isset($token_res) && !empty($token_res))
        {
            $token_record = $token_res;
        }
        return $token_record;

        
    }

    /**
     * Log API calls details into DB
     * @param $request_arr, $response_arr, $curlinfo, $request_header
     * @return void
     */
    private function logAPICall($request_arr, $response_arr, $curlinfo, $request_header)
    {
        config('key', config('apiconfig.Key'));
        $api_response = new ApiCall();
        $api_response->api_id = $this->api_id;
        $api_response->api_status =  $curlinfo['http_code'];
        $api_response->api_request = Crypt::encryptString(serialize($request_arr));
        $api_response->api_response = Crypt::encryptString(serialize($response_arr));
        $api_response->api_header = Crypt::encryptString(serialize($request_header));
        $api_response->ip_address = $curlinfo['primary_ip'];
        $api_response->save();
    }

    /**
     * Log user activies into DB
     * @param $id, $user_id, $transaction_id
     * @return void
     */
    public function userActivity($id, $user_id, $transaction_id, $client_ip)
    {
        $activity_log = new ActivityLog();
        $activity_log->activity_id = $id;
        $activity_log->session_id = $transaction_id;
        $activity_log->user_id = $user_id;
        $activity_log->ip_address = $client_ip;
        $activity_log->save();
    }
}