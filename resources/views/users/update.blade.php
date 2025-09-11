@extends('layout.master')

@section('content')
<div class="container mt-4" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="d-flex align-items-center mb-3">
                <h4 class="mb-0">تعديل مستخدم</h4>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="اكتب الاسم الكامل"
                                value="{{ old('name', $user->name) }}"
                                required
                            >
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="name@example.com"
                                value="{{ old('email', $user->email) }}"
                                required
                            >
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="major" class="form-label">التخصص </label>
                            @php $maj = old('major', $user->major); @endphp
                            <select
                                id="major"
                                name="major"
                                class="form-select @error('major') is-invalid @enderror"
                                required
                            >
                                <option value="" disabled {{ !$maj ? 'selected' : '' }}>اختر التخصص</option>
                                <option value="IT" {{ $maj === 'IT' ? 'selected' : '' }}>IT</option>
                                <option value="CS" {{ $maj === 'CS' ? 'selected' : '' }}>CS</option>
                                <option value="IS" {{ $maj === 'IS' ? 'selected' : '' }}>IS</option>
                                <option value="SE" {{ $maj === 'SE' ? 'selected' : '' }}>SE</option>
                            </select>
                            @error('major') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">الصورة (اختياري)</label>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                class="form-control @error('image') is-invalid @enderror"
                                accept="image/*"
                            >
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

                            <div class="mt-3 d-flex align-items-center gap-3">
                                <div class="border rounded p-2" style="width:120px; height:120px; display:flex; align-items:center; justify-content:center;">
                                    <img id="imagePreview"
                                         src="{{ $user->image ? asset($user->image) : '' }}"
                                         alt="Preview"
                                         style="max-width:100%; max-height:100%; {{ $user->image ? '' : 'display:none;' }}">
                                    <span id="noImageText" class="text-muted small" style="{{ $user->image ? 'display:none;' : '' }}">لا توجد صورة.</span>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-success px-4" id="saveBtn">
                                حفظ التعديلات
                            </button>
                            <a href="{{ route('users.view') }}" class="btn btn-secondary">رجوع</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
