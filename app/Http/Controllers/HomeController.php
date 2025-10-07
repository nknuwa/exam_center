<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\User;
use App\Models\ExamData;
use Illuminate\Http\Request;

class HomeController extends ParentController
{
    public function index() {
        $response['exam_data'] = ExamData::count();
        $response['exam'] = Exam::count();
        $today = Carbon::now()->format('Y-m-d');
        $response['today'] = Exam::whereDate('created_at', $today)->count();

        $response['users'] = User::count();

        return view ('pages.home.index')->with($response);
    }
}
