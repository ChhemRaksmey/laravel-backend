<?php

namespace App\Http\Controllers\aml;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\vwAmlResources;
use App\Models\vwAmlCountries;
use App\Models\vwAmlCustomerType;

class conAmlSanctionWatchList extends Controller
{

    public $var = [];

    public function __construct() {}

    public function submit (Request $request) {

        $this->var['path_route'] = "aml_sanction_watchlist";
        $this->var["path_view"]  = "pages.aml.sanction.watchlist.";
        $this->var["page_title"] = "AML Snaction Watchlist";

        if ($request->{'client-action'} ?? '' !== '') {
            switch ($request->{'client-action'}) {
                case 'pgae_list' : return $this->pgae_list($request); reak;
                case 'pgae_view' : return $this->pgae_view($request); reak;
                case 'save_edit' : return $this->save_edit($request); reak;
            }
        }

        return $this->pgae_list($request);
    }

    public function pgae_list(Request $request) 
    {

        $this->var["data_list"] = vwAmlResources::paginate(10)->appends($request->query());
        
        $this->var["list_customer_type"] = vwAmlCustomerType::get();
        $this->var["list_countries"]     = vwAmlCountries::get();

        return view($this->var["path_view"] . 'list', $this->var);
    }

    public function pgae_view(Request $request) 
    {

        $this->var["data_list"] = vwAmlResources::paginate(10)->appends($request->query());
        
        return view($this->var["path_view"] . 'list', $this->var);
    }

    public function save_edit (Request $request) {
        
        $this->var["recid"] = $request->recid ?? "";

    }

}
