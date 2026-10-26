<?php

namespace App\Http\Controllers\aml;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\AmlRiskCountries;
use App\Models\vwAmlCustomerType;
use App\Models\VwAmlCountries;
use App\Models\vwAmlRiskCountries;


class conAmlRiskLevel extends Controller
{

    public $var = [];

    public function __construct() {}

    public function submit (Request $request) {

        $this->var['path_route'] = "aml_risk_level";
        $this->var["path_view"]  = "pages.aml.risk_level.";
        $this->var["page_title"] = "AML Risk Level";

        if ($request->{'client-action'} ?? '' !== '') {
            switch ($request->{'client-action'}) {
                
                case 'pgae_list'      : return $this->pgae_list($request); reak;
                case 'pgae_create'    : return $this->pgae_create($request); reak;
                case 'pgae_edit'      : return $this->pgae_edit($request); reak;
                case 'pgae_view'      : return $this->pgae_view($request); reak;
                case 'pgae_authorize': return $this->pgae_authorize($request); reak;
                
                case 'save_edit'      : return $this->save_edit($request); reak;
                case 'save_delete'    : return $this->save_delete($request); reak;
                case 'save_authorize' : return $this->save_authorize($request); reak;
                case 'save_cancel'    : return $this->save_cancel($request); reak;

            }
        }

        return $this->pgae_list($request);
    }


    public function pgae_list (Request $request) {
        $this->var["data_list"] = vwAmlCustomerType::get();
        return view($this->var["path_view"] . 'list', $this->var);
    }

    public function pgae_edit (Request $request) {
        $this->var["recid"]         = $request->recid ?? "";
        $this->var["data_master"]   = VwAmlCustomerType::where('recid', $this->var["recid"])->first();
        $this->var["data_list"]     = VwAmlCountries::orderby('full_name')->get();
        $this->var["ris_countries"] = VwAmlRiskCountries::where('recid', $this->var['recid'])
            ->pluck('risk_country')
            ->all();
        ;
        return view($this->var["path_view"] . 'edit', $this->var);
    }

    public function pgae_view (Request $request) {
        $this->var["recid"]       = $request->recid ?? "";
        $this->var["data_master"] = VwAmlCustomerType::where('recid', $this->var["recid"])->first();
        
        
        $riskSub = VwAmlRiskCountries::query()
            ->select('recid', 'risk_country')
            ->where('recid', $this->var['recid'])
        ;
        
        $countriesSub = VwAmlCountries::query()
            ->select('recid', 'code3', 'full_name')
            ->whereIn(
                'recid',
                VwAmlRiskCountries::query()
                    ->select('risk_country')
                    ->where('recid', $this->var['recid'])
            )
        ;
        
        $this->var['data_list'] = DB::query()
            ->select('c1.recid', 'c1.code3', 'c1.full_name')
            ->fromSub($countriesSub, 'c1')
            ->joinSub($riskSub, 'c2', function ($join) {
                $join->on('c2.risk_country', '=', 'c1.recid');
            })
            ->orderby('c1.full_name')
            ->get()
        ;

        return view($this->var["path_view"] . 'view', $this->var);
    }

    public function save_edit (Request $request) {
        
        $this->var["recid"] = $request->recid ?? "";
        $countris_items = [];

        foreach ($request->countries as $key => $value) {
            $countris_items[] = $key;
        }

        if (AmlRiskCountries::where('recid', $this->var["recid"])->exists()) {
            AmlRiskCountries::where('recid', $this->var["recid"])
                ->update([
                    'json_data' => [
                        'recid' => $this->var["recid"],
                        'c1' => $countris_items,
                        'audit' => [
                            'current.number' => "",
                            'record.status'  => "",
                            'override'       => "",
                            'inputter'       => "",
                            'datetime'       => date('Y-m-d H:i:s'),
                            'authorisers'    => "",
                        ]
                    ]
                ])
            ;
        } else {
            AmlRiskCountries::create([
                'recid' => $this->var["recid"],
                'json_data' => [
                    'recid' => $this->var["recid"],
                    'c1'    => $countris_items,
                    'audit' => [
                        'current.number' => "",
                        'record.status'  => "",
                        'override'       => "",
                        'inputter'       => "",
                        'datetime'       => date('Y-m-d H:i:s'),
                        'authorisers'    => "",
                    ]
                ]
            ]);
        }

        return redirect()
            ->route(
                $this->var['path_route'],
                [
                    'recid' => $this->var[ "recid"],
                    "client-action" => "pgae_view",
                ])
            ->with('success', 'record updated successfully.')
        ;
    }

}
