@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <h1 class="text-center">Add a project</h1>
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="helpTitle"
                    placeholder="Insert a project title">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" name="price" id="price" aria-describedby="helpprice"
                    placeholder="Insert a project price">
            </div>
            <div class="mb-3">
                <label for="thumb" class="form-label">Choose file</label>
                <input type="file" class="form-control" name="thumb" id="thumb" placeholder="Choose file"
                    aria-describedby="fileHelpThumb">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection