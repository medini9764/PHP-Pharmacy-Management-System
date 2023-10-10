@extends('layouts.app')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Quotation</h1>
<div class="card w-100 " >
    <div class="card-body">

      <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title">Quotation Details</h5>
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
            <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Drug</th>
                    <th scope="col" class="text-right">Quantity</th>
                    <th scope="col" class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotations  as $quotation)
                    <tr>
                        <td>{{ $quotation->drug }}</td>
                        <td class="text-right">{{  $quotation->price}} * {{ $quotation->quantity}}</td>
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
        @if ($prescription->quotation_accept == 0)
            <div class="row">
                <div class="col-md-2 float-right">
                    <a class="nav-link " href="{{ url('quotation-accept/' . $prescription->id) }}" >
                        <button type="submit" class="btn btn-success btn-lg btn-block " >Accept</button>
                    </a>
                </div>
                <div class="col-md-2 float-right">
                    <a class="nav-link "  href="{{ url('quotation-reject/' . $prescription->id) }}">
                        <button type="submit" class="btn btn-warning btn-lg btn-block " >Reject</button>
                    </a>
                </div>
            </div>
        @elseif($prescription->quotation_accept == 1)
            <div class="col-2">
                <h4><span class="badge badge-success ">Accept</span></h4>
            </div>
        @else
            <div class="col-2">
                <h4><span class="badge badge-warning">Reject</span></h4>
            </div>
        @endif

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
