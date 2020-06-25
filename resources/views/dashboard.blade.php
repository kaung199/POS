@extends('layouts.master')
@section('page-content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9 col-sm-9 col-xs-10">
                            <h3 class="mar-no"> <span class="counter">50.5 GB</span></h3>
                            <p class="mar-ver-5"> Traffic this month </p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-2"> <i class="fa fa-shopping-cart fa-3x text-info"></i> </div>
                    </div>
                    <div class="progress progress-striped progress-sm">
                        <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar"> <span class="sr-only">60% Complete</span> </div>
                    </div>
                    <p> 4% higher than last month </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9 col-sm-9 col-xs-10">
                            <h3 class="mar-no"> <span class="counter">26.8%</span></h3>
                            <p class="mar-ver-5">Server Load</p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-2"> <i class="fa fa-envelope fa-3x text-danger"></i> </div>
                    </div>
                    <div class="progress progress-striped progress-sm">
                        <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-danger"> <span class="sr-only">60% Complete</span> </div>
                    </div>
                    <p> 4% higher than last month </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel widget">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9 col-sm-9 col-xs-10">
                            <h3 class="mar-no"> <span class="counter">$14,500</span></h3>
                            <p class="mar-ver-5"> Total Sales </p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-2"> <i class="fa fa-users fa-3x text-success"></i> </div>
                    </div>
                    <div class="progress progress-striped progress-sm">
                        <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-success"> <span class="sr-only">60% Complete</span> </div>
                    </div>
                    <p> 4% higher than last month </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel widget">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9 col-sm-9 col-xs-10">
                            <h3 class="mar-no"> <span class="counter">65</span>%</h3>
                            <p class="mar-ver-5"> Search Traffic</p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-2"> <i class="fa fa-search fa-3x text-info"></i> </div>
                    </div>
                    <div class="progress progress-striped progress-sm">
                        <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-warning"> <span class="sr-only">60% Complete</span> </div>
                    </div>
                    <p> 4% higher than last month </p>
                </div>
            </div>
        </div>
    </div>
@endsection
