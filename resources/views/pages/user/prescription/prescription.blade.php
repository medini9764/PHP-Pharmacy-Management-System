@extends('layouts.app')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Prescriptions</h1>
<div class="card w-75 " >
    <div class="card-body">
      <h5 class="card-title">Form</h5>
      <form action="{{ route('add-prescription') }}" method="post"  enctype="multipart/form-data">
        @csrf
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        <!-- Prescription input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form3Example1">Prescription</label>
            <br>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <button class="btn btn-danger"
                            id="DeleteRow"
                            type="button">
                        <i class="bi bi-trash"></i>
                        Delete
                    </button>
                </div>
                <input type="file" id="file" class="x form-control" name="image" value="{{ old('image') }}" />
            </div>
            <span class="text-danger">@error('image'){{ $message }}@enderror</span>
            <div id="newinput"></div>
                    <button id="rowAdder" type="button" class="btn btn-dark">
                        <span class="bi bi-plus-square-dotted">
                        </span> ADD
                    </button>
        </div>

        <!-- Delivery Address input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form3Example1">Delivery Address</label>
            <input type="text" id="form3Example1" class="form-control" name="delivery_address" value="{{ old('delivery_address') }}"/>
            <span class="text-danger">@error('delivery_address'){{ $message }}@enderror</span>
        </div>

        <!-- Delivery Time input -->
        <div class="form-outline mb-4">
            {{-- <label class="form-label" for="form3Example1">Delivery Time</label>
            <input type="text" id="form3Example1" class="form-control" name="delivery_time" value="{{ old('delivery_time') }}"/>
            <span class="text-danger">@error('delivery_time'){{ $message }}@enderror</span> --}}
            <select class="form-control" aria-label="Default select example" name="delivery_time">
                <option selected>Select Delivery Time Slot</option>
                <option value="8.00 am -10.00 am">8.00 am -10.00 am</option>
                <option value="10.00 am -12.00 pm">10.00 am -12.00 pm</option>
                <option value="12.00 pm - 2.00 pm">12.00 pm - 2.00 pm</option>
                <option value="2.00 pm - 4.00 pm">2.00 pm - 4.00 pm</option>
                <option value="4.00 pm - 6.00 pm">4.00 pm - 6.00 pm</option>
              </select>
        </div>

         <!-- Contact Number input -->
         <div class="form-outline mb-4">
            <label class="form-label" for="form3Example1">Note</label>
            <textarea  id="form3Example1" class="form-control" name="note" value="{{ old('note') }}"></textarea>
            <span class="text-danger">@error('note'){{ $message }}@enderror</span>
        </div>


        <!-- Submit button -->
        <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>

      </form>
    </div>
  </div>
  <style>
    .x input[type='file']{
        display: none;
    }
    .image-lable{
        color:white;
        height: 60px;
        width: 250px;
        background-color: #4e73df;
        position: relative;
        margin: auto;
        padding-top: 20px;
        top: 0;,
        bottom: 0;
        left: 0;
        right: 0;
        justify-content: center;
        align-items: bottom;
        vertical-align: bottom;
    }
  </style>

<script type="text/javascript">
    var maxField = 5;
    var x = 1; //Initial field counter is 1
    $("#rowAdder").click(function () {
        if(x < maxField){
            x++; //Increase field counter
            console.log(x);
            newRowAdd =
            '<div id="row"> <div class="input-group mb-2">' +
            '<div class="input-group-prepend">' +
            '<button class="btn btn-danger" id="DeleteRow" type="button">' +
            '<i class="bi bi-trash"></i> Delete</button> </div>' +
            ' <input type="file" id="file" class="x form-control" name="image'+x+'" value="{{ old('image') }}" /> </div> </div>';

            $('#newinput').append(newRowAdd);
        }else{
            alert('A maximum of '+maxField+' fields are allowed to be added. ');
        }

    });

        $("body").on("click", "#DeleteRow", function () {
            x--;
        $(this).parents("#row").remove();
    })


</script>
@endsection
