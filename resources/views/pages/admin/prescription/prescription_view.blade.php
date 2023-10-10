@extends('layouts.app')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Prescriptions</h1>
<div class="card w-100 " >
    <div class="card-body">

      <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title">Prescriptions Details</h5>
        @if($data->user_role == 1)
        <a class="nav-link " href="{{ url('quotation/' . $prescription->id) }}" >
          <button id="rowAdder" type="button" class="btn btn-dark ml-auto">
              <span class="bi bi-plus-square-dotted">
              </span> Quotation
            </button>
        </a>
        @endif

      </div>
      {{-- Prescription Details --}}
        <table class="table table-borderless ">
        <thead>
        </thead>
            <tbody>
                <tr>
                    <td class="px-0">Name</td>
                    <td class="px-0">{{ $prescription->user->name }}</td>
                </tr>
                <tr>
                    <td class="px-0">Email</td>
                    <td class="px-0">{{ $prescription->user->email }}</td>
                </tr>
                <tr>
                    <td class="px-0">Contact</td>
                    <td class="px-0">{{ $prescription->user->contact_no }}</td>
                </tr>
                <tr>
                    <td class="px-0">Deliver Address</td>
                    <td class="px-0">{{ $prescription->delivery_address }}</td>
                </tr>
                <tr>
                    <td class="px-0">Deliver Time</td>
                    <td class="px-0">{{ $prescription->delivery_time }}</td>
                </tr>
            </tbody>
        </table>
        <div class="ms-2"> <p><b>Images</b></p></div>

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
                <img src="{{ asset('storage/'.$prescription->image_3) }}" width="120px" max-width="100%"  alt="Prescription Image">
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
</div>
<style>
    .imgBox
    {
        width: 500px;
        margin: 50px auto 20px;
    }
    .imgBox img
    {
        max-width: 100%;
        max-height: 500px;
        border: 4px solid #fff;
        box-shadow: 0 5px 25px rgba(0,0,0,.1);
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
