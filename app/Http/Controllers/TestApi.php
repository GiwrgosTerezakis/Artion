<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api;
use App\ModelFilters\ApiFilter;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TestApi extends Controller
{
    function index(){

        return view('getapidata');
    }

    function getData($views,$year,$numberPosts)
    {
                $posts =  DB::table('api')
                    ->whereYear('date_posted','=',$year)
                    ->where('views',$views)
                    ->limit($numberPosts)
                    ->get();

        return Datatables::of($posts)
            ->addIndexColumn()
            ->make(true);


    }
}
