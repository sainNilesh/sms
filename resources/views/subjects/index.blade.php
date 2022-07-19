@extends('layouts.app')

@section('content')

<div class="row my-5">
    <div class="col-12">
        <div class="col-12">

            <a href="{{route('subjects.create')}}" class="btn btn-success float-right"> Create new Subject</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Subject Details</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject Name</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($subjects as $subject)
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>
                            <form action="{{ route('subjects.destroy',$subject->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('subjects.edit',$subject->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </thead>
                <div class="row">

            </table>

        </div>
        <!-- /.card-body -->
    </div>

    <!-- /.card -->
</div>
</div>
@endsection