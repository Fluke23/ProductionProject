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

            <div>
                <h6>Enter Your Question</h6>
                    <input type="text" class="form-control" id="#" placeholder="" name="#">
                    
                <!-- check-box -->
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">1</label>
                </div>

                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">2</label>
                </div>

                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">3</label>
                </div>

                <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">4</label>
                </div>
            </div>   

            <button type="reset" class="btn btn-danger">ยกเลิก</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
        </form>
    </div>
</div>
@endsection