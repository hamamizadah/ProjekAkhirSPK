@extends('layouts.masterlayouts')
@section('content')



<!-- Page Heading -->
<div class="d-sm-flex align-items-left ">
    <i class="fa fa-home fa-2x mr-3 mb-3" aria-hidden="true"></i>
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    
</div>
    <!-- Content Row -->
    @if(auth()->user()->level == 0)
     <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Jumlah Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span class="card-body-number">
                                    {{ \App\Models\D_Siswa::count() }}
                                    <small>Siswa</small></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        <!-- Data User -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Jumlah User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span class="card-body-number">
                                    {{ \App\Models\User::count() }}
                                    <small>User</small></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else  
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Jumlah Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span class="card-body-number">
                                    {{ \App\Models\D_Siswa::count() }}
                                    <small>Siswa</small></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endif            
@endsection