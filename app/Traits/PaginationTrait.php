<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits;


trait PaginationTrait
{

    public function get_options($results , $request = null , $except = [])
    {
        $except = array_merge($except ,['user', 'page'] );
        $filters = !empty(http_build_query($request->except($except))) ? "&".http_build_query($request->except($except)) : '';

        $data['current_page'] = $results->currentPage();
        $data['next_page_url'] = $results->nextPageUrl() ? $results->nextPageUrl()."".$filters:$results->nextPageUrl() ;
        $data['prev_page_url'] = $results->previousPageUrl() ? $results->previousPageUrl()."".$filters: $results->previousPageUrl();
        $data['first_page'] = $results->onFirstPage();
        $data['last_page'] = $results->lastPage();
        $data['count'] = $results->count();
        $data['per_page'] = $results->perPage();
        $data['total'] = $results->total();

        return $data;
    }
    public function get_options_v2($results , $filters = null)
    {

        $filters = $filters ? $filters : "";
//        $data['pagination'] = $results->nextPageUrl() ? $results->nextPageUrl()."".$filters:$results->nextPageUrl() ;
////        $data['page_count'] = $results->lastPage();
//        $data['page_next']=$results->currentPage();
//        $data['result_count'] = $results->total();
        $data['current_page'] = $results->currentPage();
        $data['next_page_url'] = $results->nextPageUrl() ? $results->nextPageUrl()."".$filters:null ;
        $data['prev_page_url'] = $results->previousPageUrl() ? $results->previousPageUrl()."".$filters: null;
        $data['first_page'] = $results->onFirstPage();
        $data['last_page'] = $results->lastPage();
        $data['count'] = $results->count();
        $data['per_page'] = $results->perPage();
        $data['total'] = $results->total();
        return $data;
    }


}
