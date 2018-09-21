@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-4">
            <h2 > True/False Question</h2>
            </div>
            <div class="col-md-8">
                <a href="#" class="btn btn-success btn-sm float-right">Add Qestion</a>
                </div>   
    </div>
    
    <div class="row">
           <form action="">
               <div class="form-group col-md-12">

                    {{-- Question 1 --}}
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 ">
                                   {{-- id question means question name --}}
                                   <label for="question">1.Plase Enter your Question:</label>
                            </div>
                        </div>

                        <div class="row mt-2">
                                <input type="text" class="form-control" id="#" name="#" value="" style="width:600px;">
                        </div>    
                         
                                
                            {{-- Multiple Choice --}}
                            <div class="row">
                                    <div class="mt-2">
                                            <div class="checkbox mt-3">
                                                    <label><input type="radio" name="optradio">
                                                    <input type="text" name="" id="" value="" class="ml-2">
                                                    </label>
                                            </div>
        
                                            <div class="checkbox mt-3">
                                                    <label><input type="radio" name="optradio">
                                                        <input type="text" name="" id="" value="" class="ml-2">
                                                    </label>
                                            </div>
                                    </div>
                            </div>
                         
                            <br>
                            {{-- score --}}
                            <div class="row">
                                    <div class="col-md-10">
                                            <label for="question">Score:</label><br>
                                            <input type="text" class="" id="#" name="#" value="" style="width:100px;">
                                        </div>
                            </div>       
                    </div>  
                    <hr>
                    <br>
                     <button type="submit" class="btn btn-primary btn-lg float-right"><i class="fa fa-save"></i>Next -></button>
               </div>
           </form>
    </div>



    @endsection