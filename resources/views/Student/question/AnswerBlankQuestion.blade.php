@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2 >Answer Question </h2>
           
        </div>
            
                 
    </div>


    <div class="row">
        <table class="table table-bordered">
            
            @foreach($question as $q)
                <tr>
                        <td style="font-size: 0.8em;">{{$q->number}}</td>
                        <td style="font-size: 0.8em;">{{$q->question}}</td>
                        <td style="font-size: 0.8em;">{{$q->score}}</td>
                        <td style="font-size: 0.8em;">{{$q->questions_types_id}}</td>
                

                </tr>
            @endforeach
            
        </table>
        
         
         <hr>
    </div>
    <div class="form-group">
            {{Form::hidden ('1', '1')}}
           
        </div>            
    <div class="form-group">
            {{Form::label('Answer', 'Answer')}}
            {{Form::textarea('Answer', '',['class'=>'form-control','placeholder'=> 'Enter Answer'])}}

    </div>  
    
    
    <div class="form-group">
        <button type="button" class="btn btn-danger">Cencel</button>
        <input class="btn btn-primary" type="submit" value="Submit">
     </div>
</div>

@endsection
