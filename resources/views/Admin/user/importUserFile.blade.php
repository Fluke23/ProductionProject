@extends('layouts.main')

@section('content')
{{--  Head  --}}


    
<div class="container">

     <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">User Manager</a></li>
            <li class="breadcrumb-item active" aria-current="page">Import File Contact</li>
        </ol>
    </nav>

    <div class="row mb-2">
        <div class="col-md-4">
            <h2 >Import File Contact</h2>
            </div>
            <div class="col-md-8">
                
            </div>   
    </div>
</div>
 {{--  Head  --}}  
 
 

    
 
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <div class="card ">
                    <div class="card-header">{{ __('CSV File Inport') }}</div>
                    <div class="card-body">
                        <form class="form-group" method="POST" action="{{ route('parseImport') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }} p-3">
                                
                                <div class="col-md-6">
                                    <input id="csv_file" type="file" class="form-control-file" name="csv_file" required>

                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="header" checked> File contains header row?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Import CSV
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection