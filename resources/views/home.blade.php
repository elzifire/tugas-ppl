@extends('layouts.app')

@section('content')

     <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Dashboard Admin</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4><i class="fa-regular fa-user"></i><span>{{ App\Models\Quiz::count() ?? '0' }}</span></h4>
                                                <p class="mb-0">Total User</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            
                                            <h4 class="mb-2">
                                                <i class="fa-solid fa-clipboard-list"></i>
                                                <span>{{ App\Models\Quiz::count() ?? '0' }}</span>
                                            </h4>
                                            <p class="mb-2">
                                                Total Kuis
                                            </p>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- add component here -->
                </div>
            </main>
@endsection

