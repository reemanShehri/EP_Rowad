<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">تعديل خدمة</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <x-input-label for="title" value="العنوان" />
            <x-text-input name="title" class="mt-1 block w-full" value="{{ $service->title }}" />
            <x-input-error :messages="$errors->get('title')" class="mt-1" />

            <x-input-label for="description" value="الوصف" class="mt-4" />
            <textarea name="description" class="block w-full mt-1 rounded">{{ $service->description }}</textarea>




     
            </label>

            <x-primary-button class="mt-6">تحديث</x-primary-button>
        </form>
    </div>
</x-app-layout>
