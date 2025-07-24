<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User; // نفترض المستشارين في جدول users مع عمود specialization

class Consultant2Controller extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'consultant'); // جلب المستشارين فقط

        // لو فيه تخصص مختار، نفلتر على أساسه
        if ($request->has('specialization') && $request->specialization != '') {
            $query->where('specialization', $request->specialization);
        }

        // جلب النتائج
        $consultants = $query->get();

        // جلب التخصصات المتوفرة لقائمة الفلترة (اختياري)
        $specializations = User::where('role', 'consultant')
            ->select('specialization')
            ->distinct()
            ->pluck('specialization');

        return view('consultants.index', compact('consultants', 'specializations'));
    }
}

