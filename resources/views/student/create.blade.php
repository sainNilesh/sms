@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Add</h1>
                </div>
                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">
                      
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
                        <h3 class="card-title">Student Deatils</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="Fname">First Name</label>
                                <input type="text" name="Fname" id="Fname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Mname">Middle Name</label>
                                <input type="text" name="Mname" id="Mname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Lname">Last Name</label>
                                <input type="text" name="Lname" id="Lname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="GrNo">GrNo</label>
                                <input type="number" name="GrNo" id="GrNo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="DOB">Date Of Birth</label>
                                <input type="date" name="DOB" id="DOB" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="text" name="Address" id="Address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="City">City</label>
                                <input type="text" name="City" id="City" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="State">State</label>
                                <input type="text" name="State" id="State" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Country">Country</label>
                                <input type="text" name="Country" id="Country" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="ZipCode">ZipCode</label>
                                <input type="text" name="ZipCode" id="ZipCode" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="ParentContactNumber">Parent Contact Number</label>
                                <input type="number" name="ParentContactNumber" id="ParentContactNumber" class="form-control" required>
                            </div>
                            <div class="preview">
                                <label for="ProfilePicture">ProfilePicture</label>
                                <input type="file" id="ProfilePicture" accept="image/*" onchange="showPreview(event);" name="ProfilePicture" required>
                                <img id="image-preview">
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