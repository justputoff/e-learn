@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Materials</h5>
      @if(auth()->user()->role->name == 'teacher')
        <a href="{{ route('materials.create') }}" class="btn btn-primary btn-sm">Create Material</a>
      @endif
    </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap p-3">
        <table class="table" id="materialsTable">
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
            @foreach ($materials as $material)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $material->title }}</td>
              <td>{{ $material->description }}</td>
              <td><a href="{{ Storage::url($material->file_path) }}" target="_blank">View File</a></td>
              @if(auth()->user()->role->name == 'teacher')
                <td>
                  <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <form action="{{ route('materials.destroy', $material->id) }}" method="POST" style="display:inline-block;">
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
