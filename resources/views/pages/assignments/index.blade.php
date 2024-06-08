@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Assignments</h5>
      @if(auth()->user()->role->name == 'teacher')
        <a href="{{ route('assignments.create') }}" class="btn btn-primary btn-sm">Create Assignment</a>
      @endif
    </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap p-3">
        <table class="table" id="assignmentsTable">
          <thead>
            <tr class="text-nowrap table-dark">
              <th class="text-white">No</th>
              <th class="text-white">Title</th>
              <th class="text-white">Description</th>
              <th class="text-white">File</th>
              @if(auth()->user()->role->name == 'teacher')
                <th class="text-white">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($assignments as $assignment)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $assignment->title }}</td>
              <td>{{ $assignment->description }}</td>
              <td><a href="{{ Storage::url($assignment->file_path) }}" target="_blank">View File</a></td>
              @if(auth()->user()->role->name == 'teacher')
                <td>
                  <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                  </form>
                </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->
@endsection
