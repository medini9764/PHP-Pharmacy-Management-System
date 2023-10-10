 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            @if ($data->user_role == 2)
                User
            @else
                Admin
            @endif
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @if($data->user_role == 2)
    <li class="nav-item">
        <a class="nav-link " href="{{ url('prescription_list')}}" >
            <i class="fas fa-fw fa-cog"></i>
            <span>Prescriptions</span>
        </a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link " href="{{ url('user-prescription-list')}}" >
            <i class="fas fa-fw fa-cog"></i>
            <span>Prescriptions</span>
        </a>
    </li>
    @endif
    {{-- Quotation --}}
    @if($data->user_role == 2)
    <li class="nav-item">
        <a class="nav-link " href="{{ url('quotation_list')}}" >
            <i class="fas fa-fw fa-cog"></i>
            <span>Quotations</span>
        </a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link " href="{{ url('admin-quotation_list')}}" >
            <i class="fas fa-fw fa-cog"></i>
            <span>Quotations</span>
        </a>
    </li>
    @endif
</ul>
<!-- End of Sidebar -->
