<?php


namespace App\Http\Controllers;
use Fomvasss\Dadata\Facades\DadataSuggest;
use Illuminate\Http\Request;

class DadataController
{
    public function getCompany(Request $request)
    {

        $result = DadataSuggest::partyById($request->id, ["branch_type"=>"MAIN"]);
        return response()->json($result);
    }
}
