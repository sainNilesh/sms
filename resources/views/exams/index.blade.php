@extends('layouts.app')

@section('content')
<div class="row my-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Exam Details</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <div class="input-group-append">
        <a href="{{route('exams.create')}}" class="btn btn-success float-right"> Create new Exam</a>
                               
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
                        <th>Title</th>
                        <th>Standard ID</th>
                        <th>Subject ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Duration</th>
                        <th>Total Marks</th>
                        <th width="280px">Action</th>
                    </tr>

                    @foreach ($exams as $exam)
                    <tr>
                        <td>{{ $exam->id }}</td>
                        <td>{{ $exam->title }}</td>
                        <td>{{ $exam->standard_title}}</td>
                        <td>{{ $exam->subject_name}}</td>
                        <td>{{ $exam->date}}</td>
                        <td>{{ $exam->time}}</td>
                        <td>{{ $exam->duration}}</td>
                        <td>{{ $exam->total_marks}}</td>

                        <td>
                            <form action="{{ route('exams.destroy',$exam->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('exams.edit',$exam->id) }}">Edit</a>
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