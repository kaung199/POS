@extends('layouts.master')

@section('page-content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Role Management</h3>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @can('role-create')
            <button type="button" id="demo-custom-toolbar2" class="btn btn-pink table-toolbar-left" data-toggle="modal" data-target="#ModalExample">
                <i class="fa fa-save fa-fw"></i> New Role
            </button>
        @endcan

        <div class="panel-body">
            <table id="demo-dt-addrow" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>

                    <th class="min-tablet">Name</th>

                    <th class="min-desktop">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @foreach ($roles as $key => $role)
                    <tr>
                        @can('role-list')
                            <td>{{$i}}</td>
                            <td>{{ $role->name }}</td>
                        @endcan
                        <td>
                            @can('role-edit')
                                <div class="col-md-1">
                                    <a href="{{ url('roles.edit',$role->id) }}" class="btn btn-primary table-toolbar-left"
                                       data-toggle="modal" data-target="#modal-edit{{ $role->id }}" id="modal-edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            @endcan

                            @can('role-delete')
                                <div class="col-md-1">
                                    <form action="{{ route('roles.destroy', $role->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure to delete?')"> <i class="fa fa-trash-o"></i></button>
                                    </form>
                                </div>
                            @endcan
                        </td>

                        <!-- edit users -->
                        <div id="modal-edit{{ $role->id }}" class="modal fade edit">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-xs-center">Edit Role Management</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="post" action="{{route('roles.update', $role->id)}}">
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-group">
                                                <label for="inputName">Name</label>
                                                <input type="text" class="form-control" id="inputName" placeholder="Enter your name" name="name" value="{{$role->name}}" required/>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPermission">Permission</label><br/>
                                                <?php
                                                    $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
                                                        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                                        ->all();
                                                ?>
                                                @foreach($permission as $value)
                                                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                        {{ $value->name }}</label>
                                                    <br/>
                                                @endforeach
                                            </div>
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
                    <h4 class="modal-title text-xs-center">Create Role Management</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('roles.store')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Enter your name" name="name" required/>
                        </div>
                        <div class="form-group">
                            <label for="inputPermission">Permission</label><br/>
                            @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>
                                <br/>
                            @endforeach
                        </div>
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
            });

            $(".edit").on('shown.bs.modal', function(){
                $(this).find('#inputName').focus();
            });

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
