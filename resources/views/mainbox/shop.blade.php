@extends('layouts.master')

@section('page-content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">
                @if(isset($local))
                    {{ $local }}
                @endif
                @if(isset($online))
                    {{ $online }}
                @endif
            </h3>
        </div>

        @include('sweet::alert')
        

        <div class="panel-body">
            @can('mainBox-create')
                <div>
                    <button type="button" class="btn btn-pink table-toolbar-left" data-toggle="modal" data-target="#ModalExample">
                        <i class="fa fa-save fa-fw"></i> Import
                    </button>
                </div>                      
            @endcan
            <table id="demo-dt-addrow" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="min-tablet">Code</th>
                    <th class="min-tablet">Barcode</th>
                    <th class="min-tablet">ProductName</th>
                    <th class="min-tablet">Qty</th>
                    <th class="min-tablet">Type</th>
                    <th class="min-desktop">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @foreach ($mainboxes as $key => $mb)
                    <tr>
                        @can('mainBox-list')
                            <td>{{$i}}</td>
                            <td>{{ $mb->code }}</td>
                            <td>{{ $mb->Barcode }}</td>
                            <td>{{$mb->product->code}} | {{ $mb->product->name }}</td>
                            <td>{{ $mb->qty }}</td>
                            <td>{{ $mb->type }}</td>
                        @endcan
                        <td>
                            @can('mainBox-delete')
                                <div class="col-md-2">
                                    <form action="{{ route('mainBox.destroy', $mb->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-circle" type="submit" onclick="return confirm('Are you sure to delete?')"> <i class="fa fa-trash-o"></i></button>
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

    <!-- create users -->
    <div id="ModalExample" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-xs-center">Import MainBox</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('w_status') }}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select class="form-control selectpicker" data-live-search="true" name="mainbox_id" id="qty" required>
                                @foreach($MW as $m)
                                    <option value="{{ $m->id }}">
                                        {{$m->product->name}} || {{ $m->qty }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if(isset($local))
                        <input type="hidden" name="status" value="2">
                        @endif
                        @if(isset($online))
                        <input type="hidden" name="status" value="3">
                        @endif
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

