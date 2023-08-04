<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GetJsonDataController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dataArray = json_decode(file_get_contents(storage_path('app/public/data0.json')), true);

        $columnsToSave = ['createdByUser', 'lastModifiedByUser', 'user'];
        $selectedColumns = [];

        for ($i = 0; $i < count($dataArray); $i++) {
            foreach ($columnsToSave as $key => $value) {
                array_push($selectedColumns, $dataArray[$i][$value]);
                // $selectedColumns[$i] = $dataArray[$i][$value];
            }
        }

        $mergedArray = [];

        for ($i = 0; $i < count($selectedColumns); $i += 3) {
            $merged = array_merge($selectedColumns[$i], $selectedColumns[$i + 1], $selectedColumns[$i + 2]);

            $mergedArray[] = $merged;
        }

        // dd($mergedArray);

        return view('show-json-data',compact('mergedArray'));
    }


}
