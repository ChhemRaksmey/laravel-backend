<?php

namespace App\Http\Controllers\aml;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\vwAmlResources;


class conAmlResources extends Controller
{

    public $var = [];

    public function __construct() {}

    public function submit (Request $request) {

        $this->var['path_route'] = "aml_resources";
        $this->var["path_view"]  = "pages.aml.resources.";
        $this->var["page_title"] = "AML Resources";

        if ($request->{'client-action'} ?? '' !== '') {
            switch ($request->{'client-action'}) {
                case 'pgae_list' : return $this->pgae_list($request); reak;
                case 'pgae_view' : return $this->pgae_view($request); reak;
            }
        }

        return $this->pgae_list($request);
    }


    public function pgae_list (Request $request) {
        $this->var["data_list"] = vwAmlResources::get();
        return view($this->var["path_view"] . 'list', $this->var);
    }
    
    public function pgae_view (Request $request) {
        $this->var["recid"]       = $request->recid ?? "";
        $this->var["data_master"] = vwAmlResources::where('recid', $this->var["recid"])->first();
        
        return view($this->var["path_view"] . 'view', $this->var);
    }

}
