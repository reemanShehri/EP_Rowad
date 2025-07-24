<x-app-layout>


          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">المستشارون</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- نموذج الفلترة -->
            <form method="GET" action="{{ route('consultants.index') }}" class="mb-6">
                <label for="specialization" class="block mb-2 font-medium">اختر التخصص:</label>
                <select name="specialization" id="specialization" class="border rounded p-2 w-full max-w-xs">
                    <option value="">الكل</option>
                    @foreach($specializations as $spec)
                        <option value="{{ $spec }}" {{ request('specialization') == $spec ? 'selected' : '' }}>
                            {{ $spec }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="mt-2 px-4 py-2 bg-beige-600 text-white rounded hover:bg-beige-700">فلتر</button>
            </form>

            <!-- قائمة المستشارين -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($consultants as $consultant)
                    <div class="bg-white p-6 rounded shadow border border-beige-200">
                        <div class="flex items-center space-x-4 space-x-reverse mb-4">
                            <img src="{{ $consultant->avatar ?: asset('images/consultant-default.png') }}" alt="{{ $consultant->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-beige-200">
                            <div>
                                <h3 class="font-semibold text-lg">{{ $consultant->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $consultant->specialization }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit($consultant->bio ?? '', 100) }}</p>
                        <a href="https://wa.me/{{ $consultant->whatsapp }}" target="_blank" class="text-green-600 hover:underline flex items-center">
                            <i class="fab fa-whatsapp ml-2"></i> تواصل عبر واتساب
                        </a>
                    </div>
                @empty
                    <p>لا يوجد مستشارون لهذا التخصص.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
