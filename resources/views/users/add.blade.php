@extends('layout.master')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">إضافة مستخدم</h4>

    <form id="addUserForm" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">الاسم</label>
                <input type="text"
                       name="name"
                       id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="اكتب الاسم"
                       value="{{ old('name') }}">
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email"
                       name="email"
                       id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="example@mail.com"
                       value="{{ old('email') }}">
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="major" class="form-label">التخصص</label>
                @php $maj = old('major'); @endphp
                <select id="major"
                        name="major"
                        class="form-select @error('major') is-invalid @enderror">
                    <option value="" {{ $maj ? '' : 'selected' }} disabled>اختر التخصص</option>
                    <option value="IT" {{ $maj==='IT' ? 'selected' : '' }}>IT</option>
                    <option value="CS" {{ $maj==='CS' ? 'selected' : '' }}>CS</option>
                    <option value="IS" {{ $maj==='IS' ? 'selected' : '' }}>IS</option>
                    <option value="SE" {{ $maj==='SE' ? 'selected' : '' }}>SE</option>
                </select>
                @error('major')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="image" class="form-label">الصورة (اختياري)</label>
                <input class="form-control @error('image') is-invalid @enderror"
                       name="image"
                       type="file"
                       id="image"
                       accept="image/*">
                @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">حفظ</button>
            <a href="{{ route('users.view') }}" class="btn btn-secondary">رجوع</a>
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
        </div>
    @endif
</div>
@endsection
