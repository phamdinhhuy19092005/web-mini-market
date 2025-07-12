@extends('backoffice.layouts.master')

@section('content_body')
<div class="container">
    <h3>Gửi Email tới Subscriber</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.emails.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subject">Tiêu đề</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="body">Nội dung</label>
            <textarea name="body" class="form-control" rows="6" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Gửi email</button>
    </form>
</div>
@endsection
