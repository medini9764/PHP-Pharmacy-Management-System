@extends('layouts.app')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Quotation</h1>
<div class="card w-100 " >
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title">List</h5>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Quotation Number</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1 @endphp
                    @foreach($quotations  as $quotation)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $quotation->id }}</td>
                        <td>
                            @if($quotation->quotation_accept == 1)
                                <div class="col-2">
                                    <h4><span class="badge badge-success ">Accept</span></h4>
                                </div>
                            @elseif ($quotation->quotation_accept == 2)
                                <div class="col-2">
                                    <h4><span class="badge badge-warning">Reject</span></h4>
                                </div>
                            @else
                                <div class="col-2">
                                    <h4><span class="badge badge-secondary">Decision pending</span></h4>
                                </div>
                            @endif
                        </td>
                        <td>
                            <!-- Use a hyperlink with the prescription ID in the URL -->
                            <a href="quotation-view/{{ $quotation->id }}" class="btn btn-success ml-auto">
                                <span class="bi bi-plus-square-dotted"></span> View
                            </a>
                        </td>
                        <!-- Add more table cells based on your prescription model fields -->
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{  $quotations->links('pagination::bootstrap-5')  }}
            </div>
        </div>
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
