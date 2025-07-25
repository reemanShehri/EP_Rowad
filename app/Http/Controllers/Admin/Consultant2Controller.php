<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User; // نفترض المستشارين في جدول users مع عمود specialization

class Consultant2Controller extends Controller
{
    public function index(Request $request)
{
    $query = User::where('user_type', 'consultant');

    if ($request->has('specialization') && $request->specialization != '') {
        $query->where('specialization', $request->specialization);
    }

    // استبدال get() بـ paginate()
    $consultants = $query->paginate(10); // 10 عناصر لكل صفحة

    $specializations = User::where('user_type', 'consultant')
        ->select('specialization')
        ->distinct()
        ->pluck('specialization');

    return view('consultants.index', compact('consultants', 'specializations'));
}

//     public function index(Request $request)
// {
//     $query = User::where('user_type', 'consultant'); // تحميل العلاقة مسبقاً

//     if ($request->has('specialization') && $request->specialization != '') {
//         $query->where('specialization', $request->specialization);
//     }

//     $consultants = $query->get();

//     $specializations = User::where('user_type', 'consultant')
//         ->select('specialization')
//         ->distinct()
//         ->pluck('specialization');

//     return view('consultants.index', compact('consultants', 'specializations'));
// }
}

