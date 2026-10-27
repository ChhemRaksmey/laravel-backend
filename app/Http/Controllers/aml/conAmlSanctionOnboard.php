<?php

namespace App\Http\Controllers\aml;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\vwAmlResources;
use App\Models\vwAmlCountries;
use App\Models\vwAmlCustomerType;

class conAmlSanctionOnboard extends Controller
{

    public $var = [];

    public function __construct() {}

    public function submit(Request $request) 
    {
        $this->var['path_route'] = "aml_sanction_onboard";
        $this->var["path_view"]  = "pages.aml.sanction.onboard.";
        $this->var["page_title"] = "AML Resources";

        $this->var["data_list"] = vwAmlResources::paginate(10)->appends($request->query());
        
        $this->var["list_customer_type"] = vwAmlCustomerType::get();
        $this->var["list_countries"]     = vwAmlCountries::get();

        return view($this->var["path_view"] . 'list', $this->var);
    }

}
