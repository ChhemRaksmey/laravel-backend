<?php

namespace App\Http\Controllers\fas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class conFasModel extends Controller
{

    public $path_route = "fas_models_";
    public $path_view  = "pages.fas_model.";
    public $page_title = "Fixed Asset Models";

    public function __construct() {}


    public function pgae_list (Request $request) {
        $page_title = $this->page_title;
        $page_route = $this->path_route;
        return view($this->path_view . 'list', compact(['page_title', 'page_route']));
    }

    public function pgae_create (Request $request) {
        $page_title = $this->page_title;
        $page_route = $this->path_route;
        return view($this->path_view . 'create', compact(['page_title', 'page_route']));
    }

    public function pgae_edit (Request $request) {
        $page_title = $this->page_title;
        $page_route = $this->path_route;
        return view($this->path_view . 'edit', compact(['page_title', 'page_route']));
    }

    public function pgae_view (Request $request) {
        $page_title = $this->page_title;
        $page_route = $this->path_route;
        return view($this->path_view . 'view', compact(['page_title', 'page_route']));
    }

    public function pgae_authorize (Request $request) {
        $page_title = $this->page_title;
        $page_route = $this->path_route;
        return view($this->path_view . 'authorize', compact(['page_title', 'page_route']));
    }
    

    public function save_create (Request $request) {
        switch ($request->input('client-action', '')) {

            case 'create':
                return redirect()
                    ->route($this->path_route . 'list')
                    ->with('success', 'record created successfully.')
                ;
            break;
        
            case 'cancel':
                return $this->save_cancel($request);
            break;
            
        }
    }

    public function save_edit (Request $request) {
        switch ($request->input('client-action', '')) {

            case 'edit':
                return redirect()
                    ->route($this->path_route . 'view')
                    ->withInput([ 'recid' => 12312 ])
                    ->with('success', 'record updated successfully.')
                ;
            break;
        
            case 'cancel':
                return $this->save_cancel($request);
            break;
            
        }
    }

    public function save_authorize (Request $request) {
        switch ($request->input('client-action', '')) {

            case 'approve':
                return redirect()
                    ->route($this->path_route . 'view')
                    ->withInput([ 'recid' => 12312 ])
                    ->with('success', 'record approve successfully.')
                ;
            break;

            case 'delete':
                return redirect()
                    ->route($this->path_route . 'view')
                    ->withInput([ 'recid' => 12312 ])
                    ->with('success', 'record deleted successfully.')
                ;
            break;
        
            case 'cancel':
                return $this->save_cancel($request);
            break;
            
        }
    }

    public function save_cancel (Request $request) {
        return redirect()->route($this->path_route . 'list');
    }

}
