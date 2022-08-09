@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Exam Add</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Exam Deatils</h3>
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
                        <form action="{{ route('exams.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title <span> *</span></label>
                                    <input type="text" name="title" id="title" class="form-control">
                                    @error('title')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Standard <span> *</span> </label>
                                    <select class="form-control" name="standard_id" style="width: 100%;">
                                        @if (!empty($standards))
                                            @foreach ($standards as $value)
                                                <option value="{{ $value->id }}">{{ $value->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>subject <span> *</span></label>
                                    <select class="form-control" name="subject_id" style="width: 100%;">
                                        @if (!empty($subjects))
                                            @foreach ($subjects as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                    <div class="form-group">
                                        <label for="date">Date <span> *</span></label>
                                        <input type="date" name="date" id="date" class="form-control">
                                        @error('date')
                                            <div class="mt-1 mb-1">
                                                <span class="validation-msg"> {{ $message }} </span>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="time">Time <span> *</span></label>
                                        <input type="time" name="time" id="time" class="form-control">
                                        @error('time')
                                            <div class="mt-1 mb-1">
                                                <span class="validation-msg"> {{ $message }} </span>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="duration">Duration <span> *</span></label>
                                        <input type="number" name="duration" id="duration" placeholder="in-minutes"
                                            class="form-control">
                                        @error('duration')
                                            <div class="mt-1 mb-1">
                                                <span class="validation-msg"> {{ $message }} </span>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="total_marks">Total Marks <span> *</span></label>
                                        <input type="number" name="total_marks" id="total_marks" class="form-control">
                                        @error('total_marks')
                                            <div class="mt-1 mb-1">
                                                <span class="validation-msg"> {{ $message }} </span>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <input type="submit" value="submit" class="btn btn-success float-right">
                                            <a class="btn btn-primary" href="{{ route('exams.index') }}"> cancel</a>
                                        </div>
                                    </div>

                        </form>
                    </div>
                </div>
            </div>

        @endsection
