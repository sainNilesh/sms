@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subject Add</h1>
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
                        <h3 class="card-title">Subject Deatils</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">

                            </button>
                        </div>
                    </div>
                    @if(session('status'))
                    <div class="mb-1 mt-1">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('subjects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Subject Name <span> * </span> </label>
                                <input type="text" name="name" id="name" class="form-control">
                                @error('name')
                                <div class="mt-1 mb-1">
                                    <span class="validation-msg"> {{ $message }} </span>
                                  </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" value="submit" class="btn btn-success float-right">
                                    <a class="btn btn-primary " href="{{ route('subjects.index') }}"> cancel</a>
                                </div>
                            </div>
                        </div>
                        @endsection