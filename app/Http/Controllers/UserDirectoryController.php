<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserDirectoryController extends Controller
{
    //


     public function index(Request $request)
    {
        $specialization = $request->input('specialization');

        $query = User::query()->whereNotNull('email'); // فلترة مبدئية، عدّل حسب الحاجة

        if ($specialization) {
            $query->where('specialization', $specialization);
        }

        $users = $query->latest()->paginate(12);

        $specializations = User::select('specialization')
            ->whereNotNull('specialization')
            ->distinct()
            ->pluck('specialization');

        return view('users.index', compact('users', 'specializations'));
    }


    public function show($id)
{
    $user = User::findOrFail($id);
    return view('users.show', compact('user'));
}

}


