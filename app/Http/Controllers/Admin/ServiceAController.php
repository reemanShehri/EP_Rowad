<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServiceAController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

   public function create()
{
    $categories = Category::whereIn('slug', ['entrepreneurs', 'consultants'])->get();

    return view('admin.services.create', compact('categories'));
}


  public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category' => 'required|string',
        'is_active' => 'nullable|boolean',
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('services', 'public');
        $validated['image'] = $path;
    }

    $validated['is_active'] = $request->has('is_active') ? 1 : 0;
    $validated['order'] = 0;

    Service::create($validated);

    return redirect()->route('admin.services.index')->with('success', 'تم الحفظ بنجاح');
}


    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'تم تعديل الخدمة بنجاح.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'تم حذف الخدمة.');
    }
}
