<h2>رسالة جديدة من نموذج التواصل</h2>

<p><strong>الاسم:</strong> {{ $data['name'] }}</p>
<p><strong>البريد الإلكتروني:</strong> {{ $data['email'] }}</p>
<p><strong>الهاتف:</strong> {{ $data['phone'] ?? 'غير مدخل' }}</p>
<p><strong>الموضوع:</strong> {{ $data['subject'] }}</p>
<p><strong>الرسالة:</strong><br> {{ $data['message'] }}</p>
