@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Standard Edit</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Standard edit Details</h3>
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
                        <form action="{{ route('standards.update', $standard->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title <span> * </span></label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ $standard->title }}">
                                    @error('title')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>subject <span> * </span></label>
                                    <select class="form-control subjects" name="subjects[]"
                                        data-placeholder="Select a subject" multiple="multiple" style="width: 100%;">
                                        @if (!empty($subjects))
                                            @foreach ($subjects as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ in_array($value->id, $standardSubjects) ? 'selected' : '' }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('subject')
                                        <div class="mt-1 mb-1">
                                            <span class="validation-msg"> {{ $message }} </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="submit" value="submit" class="btn btn-success float-right">
                                        <a class="btn btn-primary" href="{{ route('standards.index') }}"> cancel</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>


        @endsection
