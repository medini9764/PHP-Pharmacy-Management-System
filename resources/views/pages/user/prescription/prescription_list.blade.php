@extends('layouts.app')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Prescriptions</h1>
<div class="card w-100 " >
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title">List</h5>
        <a class="nav-link " href="{{ url('prescription')}}" >
            <button id="rowAdder" type="button" class="btn btn-dark ml-auto">
                <span class="bi bi-plus-square-dotted">
                </span> ADD
            </button>
        </a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact No</th>
                        <th scope="col">email</th>
                        <th scope="col">Delivery Time</th>
                        <th scope="col">Action</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1 @endphp
                    @foreach($prescriptions  as $prescription)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $prescription->user->name }}</td>
                        <td>{{ $prescription->user->contact_no }}</td>
                        <td>{{ $prescription->user->email }}</td>
                        <td>{{ $prescription->delivery_time }}</td>
                        <td>
                            <!-- Use a hyperlink with the prescription ID in the URL -->
                            <a href="prescription-view/{{ $prescription->id }}" class="btn btn-success ml-auto">
                                <span class="bi bi-plus-square-dotted"></span> View
                            </a>
                        </td>
                        <!-- Add more table cells based on your prescription model fields -->
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{  $prescriptions->links('pagination::bootstrap-5')  }}
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
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 20px 0; /* Adjust the margin as needed */
    }

    .pagination li {
        margin: 0 5px; /* Adjust the margin as needed */
    }

    .pagination a {
        display: block;
        padding: 0.5rem 1rem;
        text-decoration: none;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .pagination .active a {
        background-color: #007bff;
        color: #fff;
    }
  </style>



@endsection
