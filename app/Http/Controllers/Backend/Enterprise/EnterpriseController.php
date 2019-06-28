<?php

namespace App\Http\Controllers\Backend\Enterprise;

use App\Enterprise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnterpriseController extends Controller
{
    public function index(){
        return view('backend.enterprise.all_enterprise');
    }
    public function datatables_all_enterprise (){
        $enterprise = Enterprise::with('user')->get();
        return datatables()->of($enterprise)->toJson();
    }
}
