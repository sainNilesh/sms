@extends('layouts.app')

@section('content')
<div class="row my-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Standard Details</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <div class="input-group-append">
        <a href="{{route('standards.create')}}" class="btn btn-success float-right"> Create new Standard</a>
                               
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
                        <th>Subject Count</th>
                        <th width="280px">Action</th>
                    </tr>

                    @foreach ($standards as $standard)
                    <tr>
                        @php
                         $names = ($standard->total_subjects > 0) ? "(".$standard->names.")" : "" 
                        @endphp
                        <td>{{ $standard->id }}</td>
                        <td>{{ $standard->title }}</td>
                        <td>{{ $standard->total_subjects." ".$names }}</td>  
                        <td>
                            <form action="{{ route('standards.destroy',$standard->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('standards.edit',$standard->id) }}">Edit</a>
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