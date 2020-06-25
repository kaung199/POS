@extends('layouts.master')

@section('page-content')
    <div class="row">
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <!-- Panel heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">New Categories</h3>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <form role="form" method="POST" action="{{route('categories.store')}}" id="demo-password" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="panel-body">
                        <!--IDENTICAL VALIDATOR-->
                        <!--===================================================-->
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-12">Code</label>
                                @if(isset($code))
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="code" id="code" value="{{"00".$code}}" readonly>
                                    </div>
                                @else
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="code" id="code" value="{{"001"}}" readonly>
                                    </div>
                                @endif

                            </div>
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
                                @can('category-create')
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                @endcan
                                <a href="{{route('categories.index')}}" class="btn btn-primary">Cancel</a>
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
                                <th class="min-tablet">Code</th>
                                <th class="min-tablet zawgyi-one">Name</th>
                                <th class="min-desktop">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php $i = 1 ?>
                            @foreach($category as $key => $categories)
                                <tr>
                                    @can('category-list')
                                        <td class="text-center">{{$i}}</td>
                                        <td>{{$categories->code}}</td>
                                        <td>{{$categories->name}}</td>
                                    @endcan
                                    <td>
                                        @can('category-edit')
                                            <div class="col-md-2">
                                                <a href="{{ route('categories.edit',$categories->id) }}" class="btn btn-primary btn-icon btn-circle icon-sm fa fa-edit"></a>
                                            </div>
                                        @endcan
                                        @can('category-delete')
                                            <div class="col-md-2">
                                                <form action="{{ route('categories.destroy', $categories->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-icon btn-circle icon-sm fa fa-trash" type="submit" onclick="return confirm('Are you sure to delete?')"></button>
                                                </form>
                                            </div>
                                        @endcan
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

@section('script')
@endsection
