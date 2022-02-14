<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index(Request $request)
    {
        $banks = $this->formatBanks(Bank::get(), $request->lang);

        return response()->json(['banks' => $banks], 200);
    }

    private function formatBanks($banks, $lang){
        $banks_array = [];

        foreach($banks as $bank){
            array_push($banks_array, [
                'id' => $bank->id,
                'name' => isset($lang) && $lang!=null ? $bank->getTranslation('name', $lang) : $bank->name,
                'account_name' => $bank->account_name,
                'account_number' => $bank->account_number,
                'IBAN' => $bank->IBAN,
            ]);
        }

        return $banks_array;
    }
}
