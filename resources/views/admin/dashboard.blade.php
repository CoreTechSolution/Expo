@extends('layouts.admin')

@section('content')
                <!-- end: sidebar -->

                <section role="main" class="content-body">
                    <header class="page-header">
                        <h2>Dashboard</h2>
                    
                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="{{ route('admin.dashboard') }}">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li><span>Dashboard</span></li>
                            </ol>
                    
                            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                        </div>
                    </header>
                    <div class="row">
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            
                                                <p>You are in admin dashboard now!</p>
                                            
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        
                    </div>

                </section>
@endsection
