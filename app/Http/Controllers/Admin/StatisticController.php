<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

use App\Models\Statistic;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::orderBy('count','desc')->take(10)->get();
        return view('admin.statistic.index',compact('statistics'));
    }
}
