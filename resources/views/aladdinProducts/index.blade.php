@extends('layouts.master')
@section('head')
@endsection
@section('page-content')
    @include('sweet::alert')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Products List</h3>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Auth::user()->id == 1)
            <br/>
            <div class="col-md-1">
                <form action="{{route('sync_product')}}" method="get">
                    <span class="input-group-btn">
                    <button  id="sync_button" class="btn btn-group btn-fill pull-right btn-primary" type="submit" title="Sync">
                    <span class="glyphicon glyphicon-ok-circle"></span> Sync
                    </button>
                </span>
                </form>
            </div>
        @endif

        <div class="panel-body">
            <table id="demo-dt-addrow" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>

                    <th class="min-tablet">Photo</th>

                    <th class="min-tablet">Code</th>

                    <th class="min-tablet">Name</th>
                    <th class="min-tablet">Quantity</th>
                    <th class="min-tablet">Sale Price</th>

                    <th class="min-desktop">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @if(isset($products))
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{$i}}</td>
                            <td>
                                @foreach($product->photos as $photo)
                                    <img src="{{ $photo->filename }}" alt="" style="width:30px; height:30px;">
                                @endforeach
                            </td>
                            <td>{{ $product->code }}</td>
                            <td class="zawgyi-one">{{ $product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                @can('products-edit')
                                    @if(Auth::user()->id == 1)
                                        <div class="col-md-2">
                                        <!-- {{ url('products.edit',$product->id) }} -->
                                            <a href="#" class="btn btn-primary  btn-circle"
                                               data-toggle="modal" data-target="#modal-edit{{ $product->id }}" id="modal-edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    @endif
                                @endcan
                            </td>

                            <!-- edit products -->
                            <div id="modal-edit{{ $product->id }}" class="modal fade edit">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-xs-center">Edit Products Management</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="post" action="{{route('updateProducts', $product->id)}}"  enctype='multipart/form-data'>
                                                @csrf
                                                <input name="id" value="{{$product->id}}" hidden>
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="decimal" class="form-control" id="price" name="price" value="{{ $product->price }}" required autofocus/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-info btn-block">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        </tr>
                        <?php $i++ ?>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>


@endsection
@section('script')

@endsection
