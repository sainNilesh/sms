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


                </div>
            </div>
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
                        @if (session('status'))
                            <div class="mb-1 mt-1">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">First Name <span> * </span></label>
                                    <input type="text" name="first_name" id="first_name" class="form-control">
                                    @error('first_name')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="middle_name">Middle Name <span> *</span></label>
                                    <input type="text" name="middle_name" id="middle_name" class="form-control">
                                    @error('middle_name')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name <span> * </span></label>
                                    <input type="text" name="last_name" id="last_name" class="form-control">
                                    @error('last_name')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gr_no">GrNo <span> * </span></label>
                                    <input type="number" name="gr_no" id="gr_no" class="form-control">
                                    @error('gr_no')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date Of Birth <span> * </span></label>
                                    <input type="date" name="dob" id="dob" class="form-control">
                                    @error('dob')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Address <span> * </span></label>
                                    <input type="text" name="address" id="address" class="form-control">
                                    @error('address')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="city">City <span> * </span></label>
                                    <input type="text" name="city" id="city" class="form-control">
                                    @error('city')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="state">State <span> * </span></label>
                                    <input type="text" name="state" id="state" class="form-control">
                                    @error('state')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="country">Country <span> * </span></label>
                                    <input type="text" name="country" id="country" class="form-control">
                                    @error('country')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="zipcode">ZipCode <span> * </span></label>
                                    <input type="text" name="zipcode" id="zipCode" class="form-control">
                                    @error('zipcode')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="parent_contact_number">Parent Contact Number <span> * </span></label>
                                    <input type="number" name="parent_contact_number" id="parent_contact_number"
                                        class="form-control">
                                    @error('parent_contact_number')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="parent_email">Parent Email <span> * </span></label>
                                    <input type="email" name="parent_email" id="parent_email" class="form-control">
                                    @error('parent_email')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="preview">
                                    <label for="ProfilePicture">ProfilePicture <span> * </span></label>
                                    <input type="file" id="profile_pic" accept="image/*"
                                        onchange="showPreview(event);" name="profile_pic">
                                    @error('profile_pic')
                                        {{-- <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div> --}}
                                    @enderror
                                    <img id="image-preview">
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <input type="submit" value="submit" class="btn btn-success float-right">

                                        <a class="btn btn-primary" href="{{ route('students.index') }}"> cancel</a>
                                    </div>


                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @endsection
