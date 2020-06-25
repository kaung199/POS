@extends('layouts.master')


@section('page-content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Users Management</h3>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <button type="button" id="demo-custom-toolbar2" class="btn btn-pink table-toolbar-left" data-toggle="modal" data-target="#ModalExample">
            <i class="fa fa-save fa-fw"></i> New User
        </button>

        <div class="panel-body">
            <table id="demo-dt-addrow" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>

                    <th class="min-tablet">Name</th>

                    <th class="min-tablet">Email</th>

                    <th class="min-desktop">Roles</th>

                    <th class="min-desktop">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <div class="col-md-2">
                                    <a href="{{ url('users.edit',$user->id) }}" class="btn btn-primary table-toolbar-left"
                                       data-toggle="modal" data-target="#modal-edit{{ $user->id }}" id="modal-edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>

                                <div class="col-md-1">
                                <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure to delete?')"> <i class="fa fa-trash-o"></i></button>
                                </form>
                                </div>
                            </td>

                            <!-- edit users -->
                            <div id="modal-edit{{ $user->id }}" class="modal fade edit">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-xs-center">Edit Users Management</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="post" action="{{route('users.update', $user->id)}}">
                                                @csrf
                                                @method('PATCH')
{{--                                                <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                                                <div class="form-group">
                                                    <label for="inputName">Name</label>
                                                    <input type="text" class="form-control" id="inputName" placeholder="Enter your name" name="name" value="{{$user->name}}" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputEmail">Email</label>
                                                    <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email" name="email" value="{{$user->email}}" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword">Password</label>
                                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control', 'id' => 'inputPassword', 'required' => 'required')) !!}
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputConfirmPassword">Confirm Password</label>
                                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control', 'id' => 'inputConfirmPassword', 'required' => 'required')) !!}
                                                </div>
                                                <?php
                                                    $user = \App\User::find($user->id);
                                                    $userRole = $user->roles->pluck('name','name')->all();
                                                ?>
                                                <div class="form-group">
                                                    <label for="inputRole">Role</label>
                                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple', 'required' => 'required')) !!}
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
                    <h4 class="modal-title text-xs-center">Create Users Management</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('users.store')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Enter your name" name="name" required/>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email" name="email" required/>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control', 'id' => 'inputPassword', 'required' => 'required')) !!}
                        </div>
                        <div class="form-group">
                            <label for="inputConfirmPassword">Confirm Password</label>
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control', 'id' => 'inputConfirmPassword', 'required' => 'required')) !!}
                        </div>
                        <div class="form-group">
                            <label for="inputRole">Role</label>
                            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple', 'id' => 'roles', 'required' => 'required')) !!}
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
