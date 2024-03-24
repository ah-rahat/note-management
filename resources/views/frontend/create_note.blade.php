@extends('layouts.frontend')

@section('content')
<div class="container" style="max-width: 500px;">
  <h2 class="text-center mb-4">Create Your Note</h2>
  <form action="{{ route('create.note') }}" method="post">
    @csrf
    @if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('fail'))
    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
    @endif
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title" value="{{ old('title') }}">
      @error('title')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="content" class="form-label">Content</label>
      <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5" placeholder="Enter content">{{ old('content') }}</textarea>
      @error('content')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">View Daily Notes</a>
  </form>
</div>
@endsection
