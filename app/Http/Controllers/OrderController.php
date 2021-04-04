<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CampusCard;
use App\Mail\PaymentSuccess;
use App\Mail\BusinessApplicationFeesPaymentSuccess;
use App\Mail\CampusCardMail;
use App\Http\Traits\CommonTraits;
use Mail;
use Session;

class OrderController extends Controller
{
    use CommonTraits;

    public function updateSuccessPayment(Request $request)
    {
        $this->user_ip = $request->ip();
        $transaction_id = $_GET['transaction_id'];
        $student_id = Session::get('student_id');


        $orderData = Order::where('session_id', $transaction_id)->get()->toArray();
        $orderData = $orderData[0];

        $oitemsObj = new OrderItemsController();
        $item_data = $oitemsObj->getOrderItemsArray($orderData['order_id']);
        $finalOrderData = array('orderDetails' => $orderData, 'itemDetails' => $item_data);

        // Get api token
        $token = $this->getAuthorisedToken();
        if(isset($token))
        {
            $this->logged_user_token =  $token;
        }
        else
        {
            return response()->json(['errors' => $this->error_msg]);
        }

        if($orderData['module_name'] == 'SD')
        {
            $item_no_arr = $_GET['paid_deposits'];

            $this->api_id = 9;
            $transaction_data = [
                'transaction' => $transaction_id,
                'paid_deposits' => $item_no_arr
            ];
            $transaction_details = $this->callAPI('deposits/'.Session::get('student_id'),'POST',$transaction_data);


            $this->logUserActivity(18, Session::get('student_id'), $transaction_id, $request->ip());

            Mail::to(['test@example.com'])->send(new PaymentSuccess());
            Session::flush();
            Session::put('Module','SD');

            if($transaction_details->status == 1){
                return redirect('/student-deposits/thank-you');
            }
        }

        if($orderData['module_name'] == 'BASF')
        {

            $item_no_arr = $_GET['paid_programmes'];

            $transaction_data = [
                'transaction' => $transaction_id,
                'paid_programmes' => $item_no_arr
            ];

            $this->api_id = 6;
            $transaction_details = $this->callAPI('application-fees/'.$student_id,'POST',$transaction_data);
            // log user activity
            $this->logUserActivity(26,$student_id, $transaction_id, $request->ip());
            // send confirmation email
            $this->sendEmail(
                ['test@example.com'],[],
                new BusinessApplicationFeesPaymentSuccess($finalOrderData)
            );
            Session::flush();
            Session::put('Module','BASF');

            if($transaction_details->status == 1)
            {
                return redirect('/business-school-application-fees/thank-you');
            }
        }

        if($orderData['module_name'] == 'CCR')
        {

            CampusCard::where('session_id', $transaction_id)
            ->update(['type_flag' => 1]);
            $campusData = CampusCard::where('session_id', $transaction_id)->get()->toArray();

            $campusData = ['transaction_id' => $transaction_id, 'username'=> Session::get('username'),'student_id' => Session::get('student_id'), 'transaction_id' => $transaction_id, 'name' => Session::get('name'), 'forename' => Session::get('forename'), 'surname' => Session::get('surname'), 'email' => Session::get('email'), 'college' =>Session::get('college'), 'department' => Session::get('department'), 'type_flag' => 1];

            $transaction_data = array('application' => 'campus-card', 'transaction' => $transaction_id, 'value' => '10.00');
            $this->callAPI('transactions/'.$student_id ,'POST',$transaction_data);
            // log user activity
            $this->logUserActivity(34,$student_id, $transaction_id,$request->ip());
            // send confirmation email
            $this->sendEmail(
                ['test@example.com'],
                [],
                new CampusCardMail($campusData)
            );
            Session::flush();
            Session::put('Module','CCR');
            Session::put('typeFlag','1');

            return redirect('/campus-card-replacement/thank-you');
        }

        if($orderData['module_name'] == 'PCP')
        {
            $this->logged_user_token =  $token;
            $transaction_data = array('application' => 'print-credit', 'transaction' => $transaction_id, 'value' => '10.00');
            // API call
            $this->callAPI('transactions/'.$student_id ,'POST',$transaction_data);

            Session::flush();
            Session::put('Module','PPC');

            return redirect('/print-credit-purchase/thank-you');
        }


        if($orderData['module_name'] == 'BSST')
        {
            $this->logged_user_token =  $token;
            $transaction_data = array('application' => 'business-school-study-tours', 'transaction' => $transaction_id, 'value' => '10.00');
            // API call
            $this->callAPI('transactions/'.$student_id ,'POST',$transaction_data);

            // log user activity
            $this->logUserActivity(163, $request->session()->get('student_id'), $request->session()->get('transaction_id'), $request->ip());

            Session::flush();
            Session::put('Module','BSST');

            return redirect('/business-school-study-tours/thank-you');
        }

        if($orderData['module_name'] == 'LP')
        {
            $this->logged_user_token =  $token;
            $transaction_data = array('application' => 'library-payments', 'transaction' => $transaction_id, 'value' => '10.00');
            // API call
            $this->callAPI('transactions/'.$student_id ,'POST',$transaction_data);

            // log user activity
            $this->logUserActivity(171, $request->session()->get('username'), $request->session()->get('transaction_id'), $request->ip());

            Session::flush();
            Session::put('Module','LP');

            return redirect('/library-payments/thank-you');
        }
    }

    /**
     * Sends confirmation email
     */
    public function sendEmail($email_to, $email_cc, $email_body)
    {
        Mail::to($email_to)->cc($email_cc)->send($email_body);
    }

    /**
     * Returns module specific thank you message
     * @param @module
     * @return string
     */
    public static function getThankYouMsg($module)
    {

        if($module == 'SD')
        {
            $msg = "Your Student Deposit Payment has been received.";
            $class = "student-banner";
            $head_msg = "Student Deposits";
            $span_message1 = "Individual Services";
            $span_message2 = "Student Deposits";
        }
        else if($module == 'BASF')
        {
            $msg = "Your Application Fee(s) payment has been received.";
            $class = "basf-banner";
            $head_msg = "Business School Application Fees";
            $span_message1 = "Individual Services";
            $span_message2 = "Business School Application Fees";
        }

        $thanksData = ['msg' =>  $msg ,'class' => $class ,'head_msg' => $head_msg ,'span_message1'=> $span_message1 ,'span_message2' => $span_message2];

        return $thanksData;
    }

}
