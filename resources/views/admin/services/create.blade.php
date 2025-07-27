<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">إضافة خدمة جديدة</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">


        @if ($errors->any())
    <div class="text-red-500 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf

            <x-input-label for="title" value="العنوان" />
            <x-text-input name="title" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('title')" class="mt-1" />

            <x-input-label for="description" value="الوصف" class="mt-4" />
            <textarea name="description" class="block w-full mt-1 rounded">{{ old('description') }}</textarea>

            <x-input-label for="image" value="الصورة" class="mt-4" />
            <input type="file" name="image" class="mt-1" />
<x-input-label for="category" value="الفئة" class="mt-4" />
<select name="category" id="category" class="block w-full mt-1 rounded border-gray-300" required>
    <option value="">اختر الفئة</option>
    <option value="entrepreneurs" {{ old('category') == 'entrepreneurs' ? 'selected' : '' }}>رواد الأعمال</option>
    <option value="consultants" {{ old('category') == 'consultants' ? 'selected' : '' }}>المستشارين</option>
</select>
<x-input-error :messages="$errors->get('category')" class="mt-1" />


           <input type="hidden" name="is_active" value="0">
<input type="checkbox" name="is_active" value="1" checked>


            <x-primary-button class="mt-6">حفظ</x-primary-button>
        </form>
    </div>
</x-app-layout>
