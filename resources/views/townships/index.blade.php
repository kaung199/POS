@extends('layouts.master')

@section('page-content')
    <div class="row">
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <!-- Panel heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">New Townships</h3>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <form role="form" method="POST" action="{{route('t_store')}}" id="demo-password" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="panel-body">
                        <!--IDENTICAL VALIDATOR-->
                        <!--===================================================-->
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-12">Name</label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required autofocus>
                                </div>
                            </div>
                        </fieldset>
                        <!--===================================================-->
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-7 col-sm-offset-2">
                                <button class="btn btn-success" type="submit">Submit</button>
                                <a href="{{route('townships')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-xs-12 col-md-8 col-lg-8">
            <div class="panel">
                <div class="panel-body">
                    <table id="demo-dt-addrow" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center min-tablet">#</th>
                                <th class="min-tablet">Name</th>
                                <th class="min-desktop">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php $i = 1 ?>
                            @foreach($townships as $key => $categories)
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td>{{$categories->name}}</td>
                                    <td>
                                        <div class="col-md-2">
                                            <form action="{{ route('t_delete', $categories->id)}}" method="get">
                                                @csrf
                                                <button class="btn btn-danger btn-icon btn-circle icon-sm fa fa-trash" type="submit" onclick="return confirm('Are you sure to delete?')"></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
