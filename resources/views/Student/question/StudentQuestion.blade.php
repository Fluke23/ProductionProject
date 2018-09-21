@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2 >Question Manager</h2>
           
        </div>
            
                 
  </div>


<div class="row">
        <table class="table table-bordered">
            <tr>
                <th style="font-size: 1em;">Question</th>
                <!-- <th>Description</th> -->
                <!-- <th>Date</th> -->
                <th style="width:50px;">Score</th>
                <th style="width:50px;">Tester</th>
                <th style="width:50px;">min</th>
                <th style="width:50px;">max</th>
                <th style="width:50px;">Avg</th>
                <th></th>
                

            </tr>

            <tbody>
                    @foreach($question as $que)
                <tr>
                        <td style="font-size: 0.8em;">{{$que->question}}</td>
                        <td style="font-size: 0.8em;">{{$que->score}}</td>
                       
                
                        
                    

                        <td >
                            <a href="{{URL::to('/question/'.$que->questions_types_id)}}" class="btn btn-info ">View</a>
                             
                        
                        </td>
                </tr>
                     @endforeach
            </tbody>
 
        </table>
        
         
         <hr>
    </div>
               
    </div>
    


</div>

@endsection
