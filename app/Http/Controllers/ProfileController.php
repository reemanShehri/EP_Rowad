<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    // public function update(Request $request)
    // {
    //     $user = $request->user();

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,'.$user->id,
    //         'bio' => 'nullable|string',
    //         'specialization' => 'nullable|string|max:100',
    //         'experience' => 'nullable|integer',
    //         'whatsapp' => 'nullable|string|max:20',
    //         'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    //     ]);

    //     // تحديث الصورة الشخصية
    //     if ($request->hasFile('profile_photo')) {
    //         $this->updateProfilePhoto($request, $user);
    //     }

    //     // تحديث البيانات الأخرى
    //     $user->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'bio' => $request->bio,
    //         'specialization' => $request->specialization,
    //         'experience' => $request->experience,
    //         'whatsapp' => $request->whatsapp
    //     ]);

    //     return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    // }

// public function update(Request $request)
// {
//     $user = $request->user();

//     $validatedData = $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:users,email,'.$user->id,
//         'bio' => 'nullable|string',
//         'specialization' => 'nullable|string|max:100',
//         'experience' => 'nullable|integer|min:0|max:70',
//         'whatsapp' => 'nullable|string|max:20',
//         'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
//     ]);

//     // تحديث الصورة إذا تم رفعها
//     if ($request->hasFile('profile_photo')) {
//         $image = $request->file('profile_photo');
//         $imageName = time().'_'.$user->id.'.'.$image->extension();

//         // احفظ الصورة في المجلد العام
//         $image->move(public_path('images/profile_photos'), $imageName);

//         // احفظ المسار في قاعدة البيانات
//         $validatedData['avatar'] = 'images/profile_photos/'.$imageName;
//     }

//     $user->update($validatedData);

//     return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
// }
public function update(Request $request)
{
    $user = $request->user();

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'bio' => 'nullable|string',
        'specialization' => 'nullable|string|max:100',
        'experience' => 'nullable|integer|min:0',
        'whatsapp' => 'nullable|string|max:20'
    ]);

    // معالجة الصورة
     if ($request->hasFile('profile_photo')) {
        $image = $request->file('profile_photo');
        $imageName = time().'_'.$user->id.'.'.$image->extension();

        // احفظ الصورة في المجلد العام
        $image->move(public_path('images/profile_photos'), $imageName);

        // احفظ المسار في قاعدة البيانات
$validatedData['avatar'] = $imageName;
     }

    $user->update($validatedData);

    return back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
}
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }




public function updatePhoto(Request $request)
{
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();

    // حذف الصورة القديمة لو موجودة
    if ($user->avatar && File::exists(public_path('images/profile_photos/' . $user->avatar))) {
        File::delete(public_path('images/profile_photos/' . $user->avatar));
    }

    // حفظ الصورة الجديدة
    $image = $request->file('profile_photo');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('images/profile_photos'), $imageName);

    // تحديث مسار الصورة في جدول المستخدم
    $user->avatar = $imageName;
    $user->save();

    return redirect()->back()->with('success', 'تم تحديث صورة البروفايل.');
}

}
