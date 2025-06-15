<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Export;

use App\ServiceInterfaces\Export\Exportable;

trait ExportTrait
{
    public function export(Exportable $exportable ,$data) {
        $exportable->export($data);
    }

    // data for all type (pdf , excel , print)
    public function setPdfData($view , $data , $title , $output) {
        return [
            'view' => $view ,
            'data' => $data ,
            'title' => $title,
            'output' => $output
        ];
    }

    public function setExcelData($view , $data , $title , $output) {
        return [

        ];
    }}