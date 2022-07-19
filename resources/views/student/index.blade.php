@extends('layouts.app')

@section('content')

<div class="row my-5">
    <div class="col-12">
        <div class="col-12">

            <a href="{{route('students.create')}}" class="btn btn-success float-right"> Create new Student</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Student Details</h3>
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
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Gr No</th>
                        <th>Date Of Birth</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Zip Code</th>
                        <th>Parent Contact Number</th>
                        <th>Profile Picture</th>
                        <th width="280px">Action</th>


                    </tr>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->middle_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->gr_no }}</td>
                        <td>{{ $student->dob }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->city}}</td>
                        <td>{{ $student->state }}</td>
                        <td>{{ $student->country }}</td>
                        <td>{{ $student->zipcode }}</td>
                        <td>{{ $student->parent_contact_number }}</td>

                        <td>
                            <img height="50" src="{{ url('student/images/'.$student->profile_pic) }}" alt="Image" />
                        </td>


                        <td>
                            <form action="{{ route('students.destroy',$student->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
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