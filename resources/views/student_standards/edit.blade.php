@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>student standard Edit</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> student standard edit Details</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        @if (session('status'))
                            <div class="mb-1 mt-1">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('student_standards.update', $student_standard->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Student Id <span> *</span></label>
                                    <select class="form-control" name="student_id">
                                        @if (!empty($students))
                                            @foreach ($students as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $student_standard->student_id ? 'selected' : '' }}>
                                                    {{ $value->first_name . ' ' . $value->middle_name . ' ' . $value->last_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Standard Id <span> *</span></label>
                                    <select class="form-control" name="standard_id">
                                        @if (!empty($standards))
                                            @foreach ($standards as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $student_standard->standard_id ? 'selected' : '' }}>
                                                    {{ $value->title }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="year">Year <span> *</span></label>
                                    <input type="text" name="year" id="year" class="form-control"
                                        value="{{ $student_standard->year }}">
                                    @error('year')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="submit" value="submit" class="btn btn-success float-right">
                                        <a class="btn btn-primary" href="{{ route('student_standards.index') }}">
                                            cancel</a>
                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>

        @endsection
