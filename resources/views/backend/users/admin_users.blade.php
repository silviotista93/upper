@extends('backend.layout')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Administrar Usuarios</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Administrar Usuarios</a></li>
                <li class="breadcrumb-item">Usuarios</li>
            </ol>
        </div>
        <div>
            <button
                class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10">
                <i class="ti-settings text-white"></i></button>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Usuarios</h4>
                        <h6 class="card-subtitle">Usuarios registrados en el sistema</h6>
                        <button type="button" class="btn btn-info btn-rounded pull-right" data-toggle="modal"
                                data-target="#add-contact">Agregar nuevo usuario
                        </button>

                        <div class="table-responsive m-t-40">
                            <div class="table-responsive">
                                <table id="demo-foo-addrow" class="table m-t-30 table-hover no-wrap contact-list"
                                       data-page-size="10">
                                    <thead>
                                    <tr>
                                        <th>ID #</th>
                                        <th>Nombres</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <a href="{{ route('profile_user', $user->slug )}}"><img
                                                        src="{{ config('app.url'). $user->avatar }}" alt="user"
                                                        class="img-circle"/> {{ $user->names }} {{ $user->last_name }}
                                                </a>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone_1 }}</td>
                                            <td>
                                                @if($user->id !== auth()->user()->id)
                                                <div class="switch">
                                                    <label>Inactivo
                                                        <input type="checkbox" {{ $user->state === '1' ? 'checked':''}} data-toggle="toggle"
                                                               data-size="small" data-id="{{ $user->id }}"><span class="lever"></span>Activo</label>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn"
                                                        data-toggle="tooltip" data-original-title="Delete"><i
                                                        class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-right">
                                                <ul class="pagination"></ul>
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <form id="form_update_state_users" action="{{ route('update_state_users', ['__id__', '__state__']) }}"
                                  method="post">
                                @method('PUT')
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Agregar un nuevo
                            usuario</h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <form method="POST" class="form-horizontal form-material"
                          action="{{ route('admin-create-users') }}">
                        @csrf
                        <div class="modal-body">


                            <div class="form-group">
                                <div class="col-md-12 m-b-20">
                                    <input required type="text" name="names" value="{{old('names')}}"  class="form-control"
                                           placeholder="Nombres"></div>
                                {!! $errors->first('names','<span class="help-block">*:message</span>')!!}
                                <div class="col-md-12 m-b-20">
                                    <input required type="text" value="{{old('last_name')}}" name="last_name" class="form-control"
                                           placeholder="Apellidos"></div>
                                {!! $errors->first('last_name','<span class="help-block">*:message</span>')!!}
                                <div class="col-md-12 m-b-20">
                                    <input required type="email" value="{{old('email')}}" name="email" class="form-control"
                                           placeholder="Email">
                                    {!! $errors->first('email','<span class="help-block">*:message</span>')!!}
                                </div>
                                <div class="col-md-12 m-b-20">
                                    <input required type="text" data-mask="(999) 999-9999" name="phone_1" value="{{old('email')}}" class="form-control"
                                           placeholder="Teléfono">
                                    {!! $errors->first('email','<span class="help-block">*:message</span>')!!}
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Agregar
                            </button>
                            <button type="button" class="btn btn-default waves-effect"
                                    data-dismiss="modal">Cancel
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
    {{--<div class="right-sidebar">
        <div class="slimscrollright">
            <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
            <div class="r-panel-body">
                <ul id="themecolors" class="m-t-20">
                    <li><b>With Light sidebar</b></li>
                    <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                    <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                    <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                    <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                    <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                    <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                    <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                    <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                    <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                    <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                    <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                    <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                    <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                </ul>
                <ul class="m-t-20 chatonline">
                    <li><b>Chat option</b></li>
                    <li>
                        <a href="javascript:void(0)"><img src="/backend/assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/backend/assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/backend/assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/backend/assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/backend/assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/backend/assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/backend/assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/backend/assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>--}}
    <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
@stop
@section('js')
    <script src="/backend/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    {{--<script>
        $(document).ready(function() {
            $('#admin_users').DataTable();
        });

    </script>--}}
@endsection
