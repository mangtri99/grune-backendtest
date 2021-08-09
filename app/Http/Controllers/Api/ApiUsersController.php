<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Company;
use App\Http\Controllers\Controller;

use App\Models\Postcode;

class ApiUsersController extends Controller {

    /**
     * Return the contents of User table in tabular form
     *
     */
    public function getUsersTabular() {
        $users = User::orderBy('id', 'desc')->get();
        return response()->json($users);
    }

    public function getCompaniesTabular() {
        $companies = Company::orderBy('id', 'desc')->get();
        return response()->json($companies);
    }

    public function checkPostCode($postcode){
        $postcodes = Postcode::where("postcode",$postcode)->first();
        return response()->json($postcodes);
    }

}
