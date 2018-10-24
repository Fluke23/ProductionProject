

@extends('layouts.main')

@section('content')
{{--  Head  --}}
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="{{URL::route('userManager.index')}}">User Manager</a></li>
             <li class="breadcrumb-item"><a href="{{URL::route('importFile')}}">Import File Contact</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show File Contact</li>
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
    <table class="table">
        <tr>
            <th>Username</th>
            <th>Remark</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Password</th>
        </tr>

        @foreach ($data as $row)
            <tr>
            @foreach ($row as $key => $value)
                <td>{{ $value }}</td>
            @endforeach
            </tr>
        @endforeach
        
    </table>
{{--  
    <button type="submit" class="btn btn-primary">
        Import Data
    </button>  --}}

 </div>

<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/bootstrap.min.css"/>

@if(session('success'))
<script type="text/javascript">
        $(document).ready(function(){
            alertify.success('{{session('success')}}');
        });
</script>
@endif

 @endsection
    