@extends('layouts.frontend')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Note-Manage Application</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
@if ($noteDatas->isEmpty() && request()->is('notes/search'))
<div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Creation Time</th>
                        <th scope="col">Update Time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="6" style="color: red;text-align: center;text-transform: uppercase;font-family: sans-serif;">No data found</td>
                  </tr>
                </tbody>
            </table>
        </div>
@else
    @if (!$noteDatas->isEmpty())
    <h2>Your Notes</h2>
    @if (Session::has('success'))
    <div id="successMessage" class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('notes.search') }}" method="GET" class="d-flex">
                    <input type="text" class="form-control me-2" name="search" placeholder="Search...">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Creation Time</th>
                        <th scope="col">Update Time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($noteDatas as $noteData)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $noteData->title }}</td>
                        <td>{{ $noteData->content }}</td>
                        <td>{{ $noteData->created_at }}</td>
                        <td>{{ $noteData->updated_at }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $noteData->id }}">
                                Edit
                            </button>
                            <hr>
                            <form action="{{ route('note.destroy', $noteData->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $noteData->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form method="POST" action="{{ route('notes.update', $noteData->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ $noteData->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea class="form-control" id="content" name="content">{{ $noteData->content }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Note</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    @else
    <h1 style="color: red">Please Create Your First Note... <a href="{{ route('user.create_note') }}">go through the link</a></h1>
    @endif
    @endif
</main>

@endsection
