@extends('layouts.app')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Quotations</h1>
<div class="card w-100 " >
    <div class="card-body">
        <h5 class="card-title">Quotation Form</h5>
        <div class="row">
            <div class="col-md-7">
                    {{-- Images --}}
                    <div class="imgBox">
                    <img src="{{ asset('storage/'.$prescription->image_1) }}" alt="Prescription Image">
                    </div>
                    <ul class="thumb">
                    <li><a href="{{ asset('storage/'.$prescription->image_1) }}" target="imgBox">
                            <img src="{{ asset('storage/'.$prescription->image_1) }}" max-width="100%" height="120px" alt="Prescription Image">
                    </a></li>
                    <li>
                        @if(isset($prescription->image_2))
                            <a href="{{ asset('storage/'.$prescription->image_2) }}" target="imgBox">
                            <img src="{{ asset('storage/'.$prescription->image_2) }}" max-width="100%" height="120px" alt="Prescription Image">
                        @else
                            <a href="{{ asset('img/noImage.webp') }}" target="imgBox">
                            <img src="{{ asset('img/noImage.webp') }}" alt="Prescription No Image" max-width="100%" height="120px">
                        @endif
                    </a></li>
                    <li>
                        @if($prescription->image_3)
                            <a href="{{ asset('storage/'.$prescription->image_3) }}" target="imgBox">
                            <img src="{{ asset('storage/'.$prescription->image_3) }}" max-width="100%" height="120px" alt="Prescription Image">
                        @else
                            <a href="{{ asset('img/noImage.webp') }}" target="imgBox">
                            <img src="{{ asset('img/noImage.webp') }}" alt="Prescription No Image" max-width="100%" height="120px">
                        @endif
                    </a></li>
                    <li>
                        @if($prescription->image_4)
                            <a href="{{ asset('storage/'.$prescription->image_4) }}" target="imgBox">
                            <img src="{{ asset('storage/'.$prescription->image_4) }}" max-width="100%" height="120px" alt="Prescription Image">
                        @else
                            <a href="{{ asset('img/noImage.webp') }}" target="imgBox">
                            <img src="{{ asset('img/noImage.webp') }}" alt="Prescription No Image" max-width="100%" height="120px">
                        @endif
                    </a></li>
                    <li>
                        @if($prescription->image_5)
                            <a href="{{ asset('storage/'.$prescription->image_5) }}" target="imgBox">
                            <img src="{{ asset('storage/'.$prescription->image_5) }}" max-width="100%" height="120px" alt="Prescription Image">
                        @else
                            <a href="{{ asset('img/noImage.webp') }}" target="imgBox">
                            <img src="{{ asset('img/noImage.webp') }}" alt="Prescription No Image" max-width="100%" height="120px">
                        @endif
                    </a></li>
                    </ul>

            </div>
            <div class="col-md-5">
                <div class="x" style="margin-bottom: 300px">
                    <div class="card ">
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                            @endif
                            <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Drug</th>
                                            <th scope="col" class="text-right">Quantity</th>
                                            <th scope="col"class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($quotations  as $quotation)
                                            <tr>
                                                <td>{{ $quotation->drug }}</td>
                                                <td class="text-right" >{{  $quotation->price}} * {{ $quotation->quantity}}</td>
                                                <td class="text-right">{{ $quotation->total_amount }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td class="text-right"><b>Total</b></td>
                                            <td class="text-right">{{ $total }}</td>
                                        </tr>
                                    </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{  $quotations->links('pagination::bootstrap-5')  }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="y" >
                    <table class="table table-borderless drug-form">
                        <form action="{{ route('add-quotation') }}" method="post"  enctype="multipart/form-data">
                            @csrf

                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Drug</td>
                                    <td>
                                        <input type="text" id="form3Example1" class="form-control" name="drug" value="{{ old('drug') }}"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td >
                                        <input type="text" id="form3Example1" class="form-control" name="price" value="{{ old('price') }}"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td >
                                        <input type="text" id="form3Example1" class="form-control" name="quantity" value="{{ old('quantity') }}"/>
                                    </td>
                                </tr>
                                <input type="hidden" id="form3Example1" class="form-control" name="pres_id" value="{{ $prescription->id }}"/>
                                <tr>
                                    <td></td>
                                    <td >
                                        <button type="submit" class="btn btn-success btn-lg btn-block">Add</button>
                                    </td>
                                </tr>
                            </tbody>
                        </form>
                    </table>
                </div>
            </div>
        </div>
        <!-- Divider -->
        <hr class="sidebar-divider my-2">

        {{-- Submit Quotation --}}
        <div class="col-md-4 float-right">
            <a class="nav-link " href="{{ url('quotation-email/' . $prescription->id) }}" >
                <button type="submit" class="btn btn-success btn-lg btn-block " >Sent Quotation</button>
            </a>
        </div>



    </div>
</div>
<style>
    .imgBox {
        width: 500px; /* Set the maximum width */
        margin: 10px auto 20px;
    }

    .imgBox img {
        max-width: 100%;
        max-height: 600px;  /* Ensure the image doesn't exceed its original size */
        height: auto; /* Maintain the aspect ratio */
        display: block; /* Remove extra space below the image */
        border: 4px solid #fff;
    }
    ul.thumb
    {
        margin: 0 auto;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    ul.thumb li
    {
        list-style: none;
        margin: 0 10px;
    }
    ul.thumb li img
    {
        border: 4px solid #fff;
        box-shadow: 0 5px 25px rgba(0,0,0,.1);
    }
    .drug-form{
        position: absolute;
        bottom: 0;
        width: 100%;
        padding-right: 5px;
    }

</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.thumb a').click(function(e){
            e.preventDefault();
            $('.imgBox img').attr("src", $(this).attr("href"));
        })
    })
</script>
@endsection
