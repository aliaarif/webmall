<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LibraryPayment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use App\Http\Traits\CommonTraits;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\LibraryPaymentMail;
use Mail;
use Session;
use Inertia\Inertia;
use App\Models\Role;
use App\Models\User;

use Config;

use Auth;

class LibraryPaymentsController extends Controller
{
    use CommonTraits;


    public function lpValidateLogin(Request $request)
    {
        $validate = $this->validate($request, [
            'username' => 'required|string',
            'username' => 'required|string',
        ]);
        if($validate && (
            Auth::attempt(['username' => request('username'), 'password' => request('password')]) ||
            Auth::attempt(['email' => request('username'), 'password' => request('password')]) ||
            Auth::attempt(['mobile' => request('username'), 'password' => request('password')])
        )){
            session(
                [
                'username' => Auth::id(),
                'transaction_id'=> $this->generate_uuid(),
                'tab' => 'Library Charges'
                ]
            );

            // log user activity
            $this->userActivity(167, $request->session()->get('username'), $request->session()->get('transaction_id'), $request->ip());

            // log user activity
            $this->userActivity(169, $request->session()->get('username'), $request->session()->get('transaction_id'), $request->ip());

            return back();
        }else{
            //$this->userActivity(166, $request->session()->get('username'), $request->session()->get('transaction_id'), $request->ip());

            return back()->withStatus(false);
        }
    }


    public function lpOrder(Request $request)
    {
        $card_payment = $request->session()->get('card_payment');

        $objOrder = new Order();
        $objOrder->session_id = $request->session()->get('transaction_id');
        $objOrder->user_id = $request->session()->get('username');
        $objOrder->amount = $card_payment;
        $objOrder->module_name = 'LP';
        $objOrder->ip_address = $request->ip();
        $objOrder->save();

        $orderid = $objOrder->order_id;

        $items = Session::get('SelectedSuite_items');
        $amount = 0;
        foreach($items as $key => $item){
        $item_arr =
        [
            'order_id' => $orderid,
            'item_id' => $item['Item_no'],
            'item_name' => 'Library Payments - '.$item['description'],
            'item_price' => $item['charge'],
            'item_notes' => $item['description'] .' - '.$item['description'],
            'Item_qty' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];
        $amount = $amount + $item['charge'];
        OrderItems::insert($item_arr);
    }
        // log user activity
        $this->userActivity(170, $request->session()->get('username'), $request->session()->get('transaction_id'), $request->ip());

        //Mail::to(['admin@example.com'])->cc(['test@example.com'])->send(new LibraryPaymentMail($objOrder, $amount));

        //Mail::to(['test@example.com'])->send(new LibraryPaymentMail($objOrder, $amount, $items));


        return \Redirect::route('payment_confirmation', ['transaction_id' => $request->session()->get('transaction_id')]);
    }

 

    public  function lpThankYou(Request $request) {
        $data = ["page_title" => "Thank You !!"];
        return view('library-payments.lp-thank-you', $data);
    }
}