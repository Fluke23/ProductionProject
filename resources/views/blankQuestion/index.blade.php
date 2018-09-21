@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2 >Add Question</h2>
            </div>
            <div class="col-md-9">
            
                </div>   
    </div>

    <div class="row">
    <form action="{{URL::to('question/saveQestion')}}" method="post">
        @csrf
        <input type="checkbox" name="vehicle" value="Bike"> I have a bike<br>
        <input type="checkbox" name="vehicle" value="Car" checked> I have a car<br>
        <input type="submit" value="Submit">

    </form>
    </div>


</div>
@endsection