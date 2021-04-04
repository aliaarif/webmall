<?php

namespace Database\Seeders;

use App\Models\Api;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apis = [
            ['url' => '/auth/token', 'name' => 'Authentication - TOKEN_GENERATE', 'method' => 'POST'],
            ['url' => '/auth/invalidate-token', 'name' => 'Authentication -INVALIDATE_TOKEN',  'method' => 'POST'],
            ['url' => '/auth/keep-alive', 'name' => 'Authentication - GENERATE_NEW_TOKEN', 'method' => 'POST'],
            ['url' => '/application-fees/applicant', 'name' => 'Application Fees - APPLICANT_DETAILS', 'method' => 'POST'],
            ['url' => '/application-fees/:applicant-id', 'name' => 'Application Fees - APPLICANT_PROGRAMMES', 'method' => 'GET'],
            ['url' => '/application-fees/:applicant-id', 'name' => 'Application Fees - PAYMENT_SUCCESS', 'method' => 'POST'],
            ['url' => '/deposits/applicant', 'name' => 'Student Deposit - LOGIN', 'method' => 'POST'],
            ['url' => '/deposits/:applicant-id', 'name' => 'Student Deposit - GET_ALL_DEPOSITS', 'method' => 'GET'],
            ['url' => '/deposits/:applicant-d', 'name' => 'Student Deposit - PAYMENT_SUCCESS', 'method' => 'POST'],
            ['url' => '/direct-debits/user', 'name' => 'Direct Debits - LOGIN', 'method' => 'POST'],
            ['url' => '/direct-debits/validate-account', 'name' => 'Direct Debits - VALIDATE_ACCOUNT', 'method' => 'POST'],
            ['url' => '/direct-debits/:user-id', 'name' => 'Direct Debits - PAYMENT_SUCCESS', 'method' => 'POST'],
            ['url' => '/print/:user-id/credit', 'name' => 'Print Credit - GET_PRINT_CREDIT', 'method' => 'GET'],
            ['url' => '/print/:user-id/credit', 'name' => 'Print Credit - PAYMENT_SUCCESS', 'method' => 'POST'],
            ['url' => '/print/:user-id/transactions', 'name' => 'Print Credit - GET_STATEMENT', 'method' => 'GET'],
            ['url' => '/transactions/:user-id', 'name' => 'Transaction - PAYMENT_SUCCESS', 'method' => 'POST'],
            ['url' => '/user/:user-id', 'name' => 'USER - GET_DETAILS', 'method' => 'GET'],
            ['url' => '/user/:user-id/addresses', 'name' => 'USER - GET_ADRESSES', 'method' => 'GET'],
            ['url' => '/study-tours/:user-id', 'name' => 'BSST - APPLICANT_TOURS', 'method' => 'GET'],
            ['url' => '/study-tours/:user-id', 'name' => 'BSST - PAYMENT_SUCCESS', 'method' => 'POST'],
            ['url' => '/library-payments/:user-id', 'name' => 'LP - APPLICANT_LP', 'method' => 'GET'],
            ['url' => '/library-payments/:user-id', 'name' => 'LP - PAYMENT_SUCCESS', 'method' => 'POST']

        ];
        foreach($apis as $data)
        {
            Api::create([
               'url' => $data['url'],
               'name' => $data['name'],
               'method' => $data['method']
            ]);
        }
    }
}