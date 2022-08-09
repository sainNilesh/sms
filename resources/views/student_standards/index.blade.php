@extends('layouts.app')

@section('content')
<div class="row my-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Student Standard Details</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <div class="input-group-append">
        <a href="{{route('student_standards.create')}}" class="btn btn-success float-right"> Create new Student Standard</a>
                               
                    </div>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Standard ID</th>
                        <th>Year</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($studentStandard as $stu)
                    <tr>
                        <td>{{ $stu->id }}</td>
                        <td>{{ $stu->first_name }}</td>
                        <td>{{ $stu->standard_id }}</td>
                        <td>{{ $stu->year }}</td>
                        <td>
                            <form action="{{ route('student_standards.destroy',$stu->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('student_standards.edit',$stu->id) }}">Edit</a>
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