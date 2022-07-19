@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">student Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Student edit Details</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('students.update',$student->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Fname">First Name</label>
                            <input type="text" name="Fname" id="Fname" class="form-control" value="{{ $student->first_name }}">
                        </div>
                        <div class="form-group">
                            <label for="Mname">Middle Name</label>
                            <input type="text" name="Mname" id="Mname" class="form-control" value="{{ $student->middle_name }}">
                        </div>
                        <div class="form-group">
                            <label for="Lname">Last Name</label>
                            <input type="text" name="Lname" id="Lname" class="form-control" value="{{ $student->last_name }}">
                        </div>
                        <div class="form-group">
                            <label for="GrNo">GrNo</label>
                            <input type="text" name="GrNo" id="GrNo" class="form-control" value="{{ $student->gr_no }}">
                        </div>
                        <div class="form-group">
                            <label for="DOB">Date Of Birth</label>
                            <input type="date" name="DOB" id="DOB" class="form-control" value="{{ $student->dob }}">
                        </div>
                        <div class="form-group">
                            <label for="Address">Address</label>
                            <input type="text" name="Address" id="Address" class="form-control"value="{{ $student->address }}">
                        </div>
                        <div class="form-group">
                            <label for="City">City</label>
                            <input type="text" name="City" id="City" class="form-control" value="{{ $student->city }}">
                        </div>
                        <div class="form-group">
                            <label for="State">State</label>
                            <input type="text" name="State" id="State" class="form-control" value="{{ $student->state }}">
                        </div>
                        <div class="form-group">
                            <label for="Country">Country</label>
                            <input type="text" name="Country" id="Country" class="form-control" value="{{ $student->country }}">
                        </div>
                        <div class="form-group">
                            <label for="ZipCode">ZipCode</label>
                            <input type="text" name="ZipCode" id="ZipCode" class="form-control" value="{{ $student->zipcode }}">
                        </div>
                        <div class="form-group">
                            <label for="ParentContactNumber">Parent Contact Number</label>
                            <input type="number" name="ParentContactNumber" id="ParentContactNumber" class="form-control" value="{{$student->parent_contact_number }}"> 
                        </div>
                        <div class="form-group">
                            <label for="ProfilePicture">ProfilePicture</label>
                            <input type="file" name="ProfilePicture" value="{{ $student->profile_pic }}" onchange="showPreview(event);">
                            @if(!empty($student->profile_pic))
                               <img id="image-preview" src="{{ url('student/images/'.$student->profile_pic) }}">
                            @else   
                               <img id="image-preview">
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="submit" value="submit" class="btn btn-success float-right">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            

            @endsection