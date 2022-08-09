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
                    @if(session('status'))
                    <div class="mb-1 mt-1">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('students.update',$student->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="first_name">First Name <span> * </span></label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $student->first_name }}">
                                @error('first_name')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Middle Name <span> * </span></label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ $student->middle_name }}">
                                @error('middle_name')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name <span> * </span></label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $student->last_name }}">
                                @error('last_name')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gr_no">GrNo <span> * </span></label>
                                <input type="text" name="gr_no" id="gr_no" class="form-control" value="{{ $student->gr_no }}">
                                @error('gr_no')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
            
                            <div class="form-group">
                                <label for="dob">Date Of Birth <span> * </span></label>
                                <input type="date" name="dob" id="dob" class="form-control" value="{{ $student->dob }}">
                                @error('dob')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address <span> * </span></label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $student->address }}">
                                @error('address')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label for="city">City <span> * </span></label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ $student->city }}">
                                @error('city')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="state">State <span> * </span></label>
                                <input type="text" name="state" id="state" class="form-control" value="{{ $student->state }}">
                                @error('state')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="country">Country <span> * </span></label>
                                <input type="text" name="country" id="country" class="form-control" value="{{ $student->country }}">
                                @error('country')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="zipcode">ZipCode <span> * </span></label>
                                <input type="text" name="zipcode" id="zipcode" class="form-control" value="{{ $student->zipcode }}">
                                @error('zipcode')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="parent_contact_number">Parent Contact Number <span> * </span></label>
                                <input type="number" name="parent_contact_number" id="parent_contact_number" class="form-control" value="{{$student->parent_contact_number }}">
                                @error('parent_contact_number')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="parent_email">Parent Email <span> * </span></label>
                                <input type="email" name="parent_email" id="parent_email" class="form-control" value="{{$student->parent_email }}">
                                @error('parent_email')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ProfilePicture">ProfilePicture <span> * </span></label>
                                <input type="file" name="ProfilePicture"  onchange="showPreview(event);">
                                @error('ProfilePicture')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                                @if(!empty($student->profile_pic))
                                <img id="image-preview" src="{{ url('student/images/'.$student->profile_pic) }}">
                                @else
                                <img id="image-preview">
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" value="submit" class="btn btn-success float-right">
                                    <a class="btn btn-primary" href="{{ route('students.index') }}"> cancel</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>


        @endsection