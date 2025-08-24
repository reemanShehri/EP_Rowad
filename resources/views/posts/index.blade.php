<x-app-layout>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <x-slot name="styles">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    </x-slot>

    <style>
        .btn {
            @apply px-4 py-2 rounded text-white bg-blue-600 hover:bg-blue-700;
        }
        .post-container {
            background-color: #f9f9f9; /* لون الخلفية */
        }
    </style>

    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8 post-container">
        <!-- قسم إنشاء منشور سريع -->
        <div class="bg-white rounded-xl shadow-md border border-beige-200 p-6 mb-8">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-start space-x-3 space-x-reverse">
                    <!-- صورة المستخدم -->
                 <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-beige-300 bg-beige-100">
<img src="{{ Auth::user()->avatar ? asset('images/profile_photos/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" alt="صورة المستخدم" class="w-full h-full object-cover">
</div>


                    <!-- حقول النموذج -->
                    <div class="flex-1 space-y-4">
                        <!-- عنوان المنشور -->
                        <div>
                            <input type="text" name="title"
                                   class="w-full px-4 py-3 border border-beige-300 rounded-lg focus:ring-2 focus:ring-beige-300 focus:border-transparent text-lg"
                                   placeholder="عنوان المنشور" required>
                        </div>

                        <!-- محتوى المنشور -->
                        <div>
                            <textarea name="body" rows="5"
                                      class="w-full px-4 py-3 border border-beige-300 rounded-lg focus:ring-2 focus:ring-beige-300 focus:border-transparent"
                                      placeholder="ماذا تريد أن تشارك اليوم؟" required></textarea>
                        </div>

                        <!-- رفع صورة -->
                        <div>
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-beige-300 border-dashed rounded-lg cursor-pointer bg-beige-50 hover:bg-beige-100 transition">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-camera text-beige-600 text-2xl mb-2"></i>
                                    <p class="text-sm text-gray-500">اضغط لرفع صورة أو اسحبها هنا</p>
                                    <p class="text-xs text-gray-400">(اختياري)</p>
                                </div>
                                <input id="post-image" name="image" type="file" class="hidden" accept="image/*">
                            </label>
                            <div id="image-preview" class="mt-3 hidden">
                                <img id="preview-image" class="max-h-48 rounded-lg shadow-sm">
                                <button type="button" id="remove-image" class="text-red-500 hover:text-red-700 mt-2 text-sm">
                                    <i class="fas fa-times mr-1"></i> إزالة الصورة
                                </button>
                            </div>
                        </div>
<script>
    const imageInput = document.getElementById("post-image");
    const imagePreview = document.getElementById("image-preview");
    const previewImage = document.getElementById("preview-image");
    const removeImage = document.getElementById("remove-image");

    // عند اختيار صورة
    imageInput.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imagePreview.classList.remove("hidden");
            }
            reader.readAsDataURL(file);
        }
    });

    // زر إزالة الصورة
    removeImage.addEventListener("click", function() {
        imageInput.value = ""; // تفريغ حقل رفع الملف
        previewImage.src = "";
        imagePreview.classList.add("hidden");
    });
</script>

                        <!-- رابط خارجي -->
                        <div>
                            <input type="url" name="link"
                                   class="w-full px-4 py-2 border border-beige-300 rounded-lg focus:ring-2 focus:ring-beige-300 focus:border-transparent"
                                   placeholder="أضف رابطًا خارجيًا (اختياري)">
                        </div>

                        <!-- خيارات إضافية -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3 space-x-reverse">
                                <!-- هل هو سؤال؟ -->

                            </div>

                            <!-- زر النشر -->
                            <button type="submit"
                                    class="bg-beige-600 hover:bg-beige-700 text-white px-6 py-2 rounded-lg transition-colors flex items-center">
                                <i class="fas fa-paper-plane ml-2"></i> نشر
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- قائمة المنشورات -->
        <div class="space-y-30"> <!-- زيادة الفراغ بين المنشورات -->
            @forelse ($posts as $post)
            <div class="bg-white rounded-xl shadow-md border border-beige-200 overflow-hidden" style="width: calc(100% - 32px); margin: 0 auto;">
                <!-- رأس المنشور -->
                <div class="p-4 border-b border-beige-200 flex items-start justify-between">
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <!-- صورة المستخدم -->
                     <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-beige-300 bg-beige-100">
    <img src="{{ $post->user->avatar ? asset('images/profile_photos/' . $post->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}" alt="صورة المستخدم" class="w-full h-full object-cover">
</div>


                        <div>
                               <a href="{{ route('profile.show', $post->user->id) }}" class="text-blue-600 hover:underline">
 <h4 class="font-semibold text-gray-800">{{ $post->user->name }}</h4>
                               </a>
                            <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <!-- خيارات المنشور -->
                    @if($post->user_id == auth()->id())
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <!-- زر التعديل -->
                        <a href="{{ route('posts.edit', $post) }}"
                           class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md text-sm transition-colors">
                            <i class="fas fa-edit mr-1"></i> تعديل
                        </a>

                        <!-- زر الحذف -->
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md text-sm transition-colors"
                                    onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                <i class="fas fa-trash mr-1"></i> حذف
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

                <!-- محتوى المنشور -->
                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $post->body }}</p>

                    <!-- صورة المنشور -->
                    @if($post->image)
                    <div class="mt-4 rounded-lg overflow-hidden">
                        <img src="{{ asset($post->image) }}" alt="صورة المنشور" class="w-full h-auto max-h-96 object-contain mx-auto">
                    </div>
                    @endif

                    <!-- رابط المنشور -->
                    @if($post->link)
                    <div class="mt-4 p-3 bg-beige-50 rounded-lg border border-beige-200">
                        <a href="{{ $post->link }}" target="_blank" class="text-beige-600 hover:text-beige-800 break-all">
                            <i class="fas fa-link mr-1"></i> {{ $post->link }}
                        </a>
                    </div>
                    @endif
                </div>

                <!-- إحصائيات المنشور -->
                {{-- <div class="px-4 py-2 border-t border-beige-200 flex items-center text-sm text-gray-500">
                    <span class="mr-3"><i class="far fa-heart mr-1"></i> {{ $post->likes_count }} إعجاب</span>
                    <span><i class="far fa-comment mr-1"></i> {{ $post->comments_count }} تعليق</span>
                </div> --}}

                <!-- أزرار التفاعل -->
                <div class="px-4 py-2 border-t border-beige-200 flex space-x-4 space-x-reverse">
    {{-- <form method="POST" action="{{ route('like') }}"> --}}
    <form method="POST" action="{{ route('posts.like', ['post' => $post->id]) }}">

        @csrf
    <input type="hidden" name="id" value="{{ $post->id }}">
    <input type="hidden" name="type" value="post">


  {{-- <button type="submit" class="text-red-600" >
        ❤️ {{ $post->likes()->count() }} like
    </button> --}}

</form>
{{--
         <div class="flex items-center space-x-2">
    <button class="like-btn flex items-center {{ $post->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-600' }}"
            onclick="toggleLike({{ $post->id }})"
            data-post-id="{{ $post->id }}">
        @if($post->isLikedBy(auth()->user()))
            <i class="fas fa-heart mr-1"></i> <span></span>
        @else
            <i class="far fa-heart mr-1"></i> <span></span>
        @endif
    </button>

    <span class="likes-count text-sm text-gray-700" id="likes-count-{{ $post->id }}">
        {{ $post->likes->count() }}
    </span>
</div> --}}

<div class="flex items-center space-x-2 space-x-reverse">
    <!-- زر اللايك -->
    <button class="like-btn flex items-center {{ $post->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-600' }}"
            onclick="toggleLike({{ $post->id }})"
            data-post-id="{{ $post->id }}">
        @if($post->isLikedBy(auth()->user()))
            <i class="fas fa-heart mr-1"></i>
        @else
            <i class="far fa-heart mr-1"></i>
        @endif
    </button>

    <!-- عدد اللايكات -->
    <span class="likes-count text-sm text-gray-700" id="likes-count-{{ $post->id }}">
        {{ $post->likes->count() }}
    </span>

    <!-- أيقونة العين لعرض المستخدمين -->
    <button onclick="toggleLikesModal({{ $post->id }})" class="text-gray-600 hover:text-gray-800">
        <i class="fas fa-eye"></i>
    </button>
</div>

<!-- المودال لإظهار المستخدمين -->
<div id="likes-modal-{{ $post->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-4 w-80">
        <div class="flex justify-between items-center mb-2">
            <h3 class="font-bold text-lg">أعجبوا بهذا المنشور</h3>
            <button onclick="closeLikesModal({{ $post->id }})" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>
        <ul class="divide-y divide-gray-200 max-h-60 overflow-y-auto" id="likes-users-list-{{ $post->id }}">
            @foreach($post->likes as $like)
<li class="py-1">
    <a href="{{ route('profile.show', $like->user->id) }}" class="text-blue-600 hover:underline">
        {{ $like->user->name }}
    </a>
</li>
            @endforeach
        </ul>
    </div>
</div>

<script>
function toggleLikesModal(postId) {
    const modal = document.getElementById(`likes-modal-${postId}`);
    modal.classList.toggle('hidden');
    modal.classList.toggle('flex');
}

function closeLikesModal(postId) {
    const modal = document.getElementById(`likes-modal-${postId}`);
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>


<script>
function toggleLike(postId) {
    const likeBtn = $(`button[data-post-id="${postId}"]`);

    $.ajax({
        url: `/posts/${postId}/toggle-like`,
        type: 'POST',
        data: {
            post_id: postId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            likeBtn.prop('disabled', true).addClass('loading');
        },
        success: function(response) {
            if (response.success) {
                updateLikeUI(postId, response);
            } else {
                showError(response.message || 'حدث خطأ غير متوقع');
            }
        },
        error: function(xhr) {
            const errorMsg = xhr.responseJSON?.message || 'فشل الاتصال بالخادم';
            showError(errorMsg);
        },
        complete: function() {
            likeBtn.prop('disabled', false).removeClass('loading');
        }
    });
}

function updateLikeUI(postId, data) {
    const likeBtn = $(`button[data-post-id="${postId}"]`);
    const likesCount = $(`#likes-count-${postId}`);
    const likedUsersDiv = $(`#liked-users-${postId}`);
    const usersListDiv = $(`#users-list-${postId}`);

    likeBtn.text(data.isLiked ? ' ❤️ UnLike' : ' ❤️ Like')
           .toggleClass('liked', data.isLiked);

    likesCount.text(data.likesCount);

    if (data.likesCount > 0) {
        likedUsersDiv.show();
        usersListDiv.empty();
        data.likedUsers.forEach(user => {
            usersListDiv.append(`<span class="user-badge">${user.name}</span>`);
        });
    } else {
        likedUsersDiv.hide();
    }
}

function showError(message) {
    alert(message);
    console.error('Error:', message);
}
</script>


{{-- <button type="button"
        class="text-red-600 like-btn"
        data-id="{{ $post->id }}">
    ❤️ <span id="likes-count-{{ $post->id }}">{{ $post->likes()->count() }}</span> like
</button> --}}


{{-- <script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', async () => {
            const postId = button.getAttribute('data-id');

            const response = await fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const data = await response.json();

            // حدّث العدد على الصفحة بدون reload
            document.getElementById(`likes-count-${postId}`).innerText = data.likes_count;
        });
    });
});
</script> --}}






                 <button class="comment-btn flex items-center py-2 text-gray-600 hover:text-beige-600 transition-colors">
    <i class="far fa-comment mr-1"></i>
    <span id="comments-count-{{ $post->id }}">
        {{ $post->comments_count }}
    </span>
</button>

                </div>



                <!-- قسم التعليقات -->
                <div class="bg-beige-50 p-4 border-t border-beige-200">
                    <!-- عرض بعض التعليقات -->
                {{-- كل التعليقات مخفية بشكل افتراضي --}}
<div id="all-comments-{{ $post->id }}" style="display:none;">
@foreach($post->comments as $comment)
    <div class="mb-3 flex items-start" id="comment-{{ $comment->id }}">
        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-beige-300 bg-beige-100 flex-shrink-0">
            <img src="{{ $comment->user->avatar ? asset('images/profile_photos/' . $comment->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
                 class="w-full h-full object-cover" alt="Profile Photo">
        </div>
        <div class="mr-3 bg-white p-3 rounded-lg border border-beige-200 flex-1">
            <div class="flex justify-between items-center mb-1">
                    <a href="{{ route('profile.show', $comment->user->id) }}" class="text-blue-600 hover:underline">

                <span class="font-semibold text-sm">{{ $comment->user->name }}</span>
                    </a>
                <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </div>

            <!-- نص التعليق -->
            <p class="text-gray-700 text-sm comment-body">{{ $comment->body }}</p>

            <div class="flex items-center space-x-2 space-x-reverse mt-2">
                <!-- زر تعديل -->


                <!-- زر حذف -->
                @if(auth()->id() === $comment->user_id || auth()->id() === $post->user_id)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline-block delete-comment-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline text-sm">     <i class="fas fa-trash-alt"></i></button>
                </form>
                @endif
            </div>
        </div>
    </div>
@endforeach
</div>






{{-- <div id="all-comments-{{ $post->id }}" style="display:none;">
    @foreach($post->comments as $comment)
        <div class="mb-3 flex items-start">
            <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-beige-300 bg-beige-100 flex-shrink-0">
                <img src="{{ $comment->user->avatar
                    ? asset('images/profile_photos/' . $comment->user->avatar)
                    : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
                     class="w-full h-full object-cover" alt="Profile Photo">
            </div>

            <div class="mr-3 bg-white p-3 rounded-lg border border-beige-200 flex-1">
                <div class="flex justify-between items-center mb-1">
                    <span class="font-semibold text-sm">{{ $comment->user->name }}</span>
                    <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                </div>

                <p class="text-gray-700 text-sm">{{ $comment->body }}</p>

                <div class="flex items-center mt-2 space-x-2">
                    <!-- زر الإعجاب -->
                    <form method="POST" action="{{ route('like') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $comment->id }}">
                        <input type="hidden" name="type" value="comment">
                        <button type="submit" class="text-red-600">
                            ❤️ {{ $comment->likes()->count() }}
                        </button>
                    </form>

                    <!-- خيارات صاحب التعليق -->
                    @if(auth()->id() === $comment->user_id)
                        <a href="{{ route('comments.edit', $comment) }}" class="text-blue-600 hover:underline text-sm">تعديل</a>
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">حذف</button>
                        </form>
                    <!-- خيار صاحب البوست فقط -->
                    @elseif(auth()->id() === $post->user_id)
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">حذف</button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    @endforeach
</div> --}}


{{-- زر عرض/إخفاء التعليقات --}}
@if($post->comments->count() > 0)
   <button
    id="toggle-comments-btn-{{ $post->id }}"
    onclick="
        let comments = document.getElementById('all-comments-{{ $post->id }}');
        if (comments.style.display === 'none') {
            comments.style.display = 'block';
            this.innerText = 'إخفاء التعليقات';
        } else {
            comments.style.display = 'none';
            this.innerText = 'عرض جميع التعليقات ({{ $post->comments->count() }})';
        }
    "
    class="text-gray-600 mt-2 px-3 py-1 rounded hover:bg-gray-100 transition-colors"
>
    عرض جميع التعليقات ({{ $post->comments->count() }})
</button>

@endif





                    <!-- نموذج إضافة تعليق جديد -->
                    <form action="{{ route('comments.store') }}" method="POST" class="flex items-center space-x-3 space-x-reverse">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <div class="flex-1">
                            <input type="text" name="content" placeholder="أكتب تعليق..."
                                   class="w-full px-4 py-2 border border-beige-300 rounded-full focus:outline-none focus:ring-2 focus:ring-beige-300 mt-10" required>
                        </div>
                        <button type="submit" class="text-beige-600 hover:text-beige-800 bt-5n" style="margin-top: 32px;">
                            <i class="fas fa-paper-plane text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-md border border-beige-200 p-8 text-center">
                <p class="text-gray-600">لا توجد منشورات لعرضها</p>
                <p class="text-sm text-gray-500 mt-2">كن أول من ينشر مشاركة!</p>
            </div>
            @endforelse
        </div>

        <!-- الترقيم -->
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>

    @push('scripts')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // معاينة الصورة قبل الرفع
            const imageUpload = document.getElementById('post-image');
            const imagePreview = document.getElementById('image-preview');
            const previewImage = document.getElementById('preview-image');
            const removeImage = document.getElementById('remove-image');

            if(imageUpload) {
                imageUpload.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            previewImage.src = event.target.result;
                            imagePreview.classList.remove('hidden');
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            if(removeImage) {
                removeImage.addEventListener('click', function() {
                    imageUpload.value = '';
                    previewImage.src = '';
                    imagePreview.classList.add('hidden');
                });
            }

            // عرض/إخفاء حقل الرابط
            const toggleLink = document.getElementById('toggle-link');
            const linkField = document.getElementById('link-field');

            if(toggleLink && linkField) {
                toggleLink.addEventListener('click', function() {
                    linkField.classList.toggle('hidden');
                });
            }

            // تفعيل القائمة المنسدلة
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const button = dropdown.querySelector('button');
                const menu = dropdown.querySelector('.dropdown-menu');

                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // إغلاق جميع القوائم الأخرى أولاً
                    document.querySelectorAll('.dropdown-menu').forEach(m => {
                        if(m !== menu) m.classList.add('hidden');
                    });
                    menu.classList.toggle('hidden');
                });
            });

            // إغلاق القوائم عند النقر خارجها
            document.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            });

            // نظام الإعجابات
            const likeButtons = document.querySelectorAll('.like-btn');
            likeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const postId = this.getAttribute('data-post-id');
                    // هنا يمكنك إضافة كود AJAX لتسجيل الإعجاب
                    this.classList.toggle('text-red-500');
                    this.classList.toggle('text-gray-600');

                    const icon = this.querySelector('i');
                    if(icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                    }
                });
            });
        });
    </script>

    @endpush
</x-app-layout>
