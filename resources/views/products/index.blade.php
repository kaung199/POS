@extends('layouts.master')

@section('page-content')
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
        
        @can('products-create')
            @if(Auth::user()->id == 1 || Auth::user()->id == 6)
                <button type="button" id="demo-custom-toolbar2" class="btn btn-pink table-toolbar-left" data-toggle="modal" data-target="#ModalExample">
                    <i class="fa fa-save fa-fw"></i> New Product
                </button>
            @endif
        @endcan

        <div class="panel-body">
            <table id="demo-dt-addrow" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>

                    <th class="min-tablet">Photo</th>

                    <th class="min-tablet">Code</th>

                    <th class="min-tablet">Name</th>
                    <th class="min-tablet">Category</th>
                    <th class="min-tablet">Quantity</th>
                    <th class="min-tablet">Sale Price</th>

                    <th class="min-desktop">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @foreach ($products as $key => $product)
                {{-- {{ dd($product->photos[0]->filename) }} --}}
                    <tr>
                        @can('products-list')
                            <td>{{$i}}</td>
                            <td>
                            @foreach($product->photos as $photo) 
                                <img src="{{ asset('storage/' . $photo->filename) }}" alt="" style="width:30px; height:30px;">
                            @endforeach
                            </td>
                            <td>{{ $product->code }}</td>
                            <td class="zawgyi-one">{{ $product->name }}</td>
                            <td class="zawgyi-one">{{ $product->category->name }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ $product->sale_price }}</td>
                        @endcan
                        <td>
                            @can('products-edit')
                                @if(Auth::user()->id == 1 ||Auth::user()->id == 6)
                                    <div class="col-md-2">
                                    <!-- {{ url('products.edit',$product->id) }} -->
                                        <a href="#" class="btn btn-primary  btn-circle"
                                        data-toggle="modal" data-target="#modal-edit{{ $product->id }}" id="modal-edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                @endif
                            @endcan

                            @can('products-delete')
                                @if(Auth::user()->id == 1 )
                                    <div class="col-md-2">
                                        <form action="{{ route('products.destroy', $product->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-circle" type="submit" onclick="return confirm('Are you sure to delete?')"> <i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>
                                @endif
                            @endcan

                            <div class="col-md-2">
                                <a href="{{route('detail', $product->id)}}" class="btn btn-primary  btn-circle"><i class="fa fa-list"></i></a>
                            </div>
                        </td>

                        <!-- edit users -->
                        <div id="modal-edit{{ $product->id }}" class="modal fade edit">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-xs-center">Edit Products Management</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="post" action="{{route('products.update', $product->id)}}"  enctype='multipart/form-data'>
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input type="text" class="form-control" name="code" id="code" value="{{$product->code}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName">Name</label>
                                                <input type="text" class="form-control" id="inputName" placeholder="Enter your name" name="name" value="{{$product->name}}" required/>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select class="form-control js-example-basic-single" data-live-search="true" name="category_id" style="width: 100%" required>
                                                    @foreach($categories as $cate)
                                                    <option value="{{ $cate->id }}" {{($product->category_id == $cate->id) ? 'selected = "true" ' : ''}}>
                                                        {{ $cate->code }} | {{ $cate->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if(Auth::user()->id == 1)
                                            <div class="form-group">
                                                <label for="sale_price">Qty</label>
                                                <input type="decimal" class="form-control" id="sale_price" placeholder="Enter Qty" name="qty" value="{{ $product->qty }}" required/>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="sale_price">SalePrice</label>
                                                <input type="decimal" class="form-control" id="sale_price" placeholder="Enter your name" name="sale_price" value="{{ $product->sale_price }}" required/>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea rows="2" class="form-control" id="description" placeholder="Enter your description" name="description" required>{{ $product->description }}</textarea>
                                            </div>
                                            
                                            <label for="photos">Photos</label>
                                            <div class="form-group">
                                                <input type="file"  value="{{ $product->photos }}" name="photos[]" class="form-control" multiple>
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
                </tbody>
            </table>
        </div>
    </div>

    <!-- create users -->
    <div id="ModalExample" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-xs-center">Create Products</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('products.store')}}" enctype='multipart/form-data'>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Code</label>
                            @if(isset($code))
                                <input type="text" class="form-control" name="code" id="code" value="{{"000".$code}}" readonly>
                            @else
                                <input type="text" class="form-control" name="code" id="code" value="{{"0001"}}" readonly>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Enter your name" name="name" required/>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control selectpicker" data-live-search="true" name="category_id" required>
                                @foreach($categories as $cate)
                                <option value="{{ $cate->id }}">
                                    {{$cate->code}} | {{ $cate->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sale_price">SalePrice</label>
                            <input type="number" class="form-control" id="sale_price" placeholder="Enter your name" name="sale_price" required/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="2" class="form-control" id="description" placeholder="Enter your description" name="description" required/></textarea>
                        </div>

                        
                        <div class="form-group">
                            <label for="photos">Photos</label>
                            <input type="file" id="photos" name="photos[]" class="form-control" multiple>
                        </div>

                        {{-- <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control">
                        </div> --}}

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-info btn-block">SUBMIT</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#ModalExample").on('shown.bs.modal', function(){
                $(this).find('#inputName').focus();
                $('#code').prop("disabled",false);
            });

            $(".edit").on('shown.bs.modal', function(){
                $(this).find('#inputName').focus();
            });

            $(".js-example-basic-single").select2();
        });

        (function ($) {
            $.fn.enter = function (func) {
                this.bind('keypress', function (e) {
                    if (e.keyCode == 13) func.apply(this, [e]);
                });
                return this;
            };
        })(jQuery);
    </script>
@endsection
