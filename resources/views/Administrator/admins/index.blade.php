@extends(ADI.'.master')
@section('content')
<link href="{{ asset('public/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <!-- <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Buttons &nbsp;</span>
                </div> -->
                <div class="btn-group">
                    <a href="{{ url('create') }}" class="btn sbold green"> {{trans('cpanel.add_new')}} <i class="fa fa-plus"></i></a>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                @if(!empty($all_admins) && count($all_admins)>0)
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                        <tr>
                            <th>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" name="check_all" id="check_all" class="checkboxes"/>
                                    <span></span>{{trans('cpanel.select_all')}} &nbsp;
                                </label>

                                <button type="button" class="btn btn-danger delete_all_selected" data-toggle="modal" data-target="#myModalSelected" id="delete_all_selected" disabled="disabled">{{trans('cpanel.delete_all_selected')}}</button>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>{{ trans('cpanel.name') }}</th>
                            <th>{{ trans('cpanel.email') }}</th>
                            <th>{{ trans('cpanel.status') }}</th>
                            <th>{{ trans('cpanel.action') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>{{ trans('cpanel.name') }}</th>
                            <th>{{ trans('cpanel.email') }}</th>
                            <th>{{ trans('cpanel.status') }}</th>
                            <th>{{ trans('cpanel.action') }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($all_admins as $admin)
                        <tr id="user_{{ $admin->id }}" @if($admin->status == 0)class="danger" @endif>
                            <td>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" name="perm[]" class="All_Checkbox checkboxes" value="{{ $admin->id }}" />
                                    <span></span>#{{ $admin->id }}
                                </label>
                            </td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @if($admin->status == 1)
                                <span class="label label-sm label-success label-mini">{{ trans('cpanel.on') }}</span>
                                @else
                                <span class="label label-sm label-danger label-mini">{{ trans('cpanel.off') }}</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{url('admins/'.$admin->id.'/edit')}}" class="btn btn-outline btn-circle btn-sm purple">
                                    <i class="fa fa-edit"></i> {{ trans('cpanel.edit') }}
                                </a>

                                <!-- <a href="{{url('admins/'.$admin->id)}}" class="btn btn-outline btn-circle dark btn-sm black">
                                        <i class="fa fa-share"></i> {{ trans('cpanel.view') }}
                                </a> -->


                                @if(auth()->user()->id != $admin->id)
                                <a type="button" class="btn btn-outline btn-circle red btn-sm black admin_delete" data-id="{{ $admin->id }}" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o"></i> {{trans('cpanel.delete')}}</a>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-warning">{{ trans('cpanel.empty_data') }}</p>
                @endif
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<!-- Modal to delete single item -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('cpanel.confirm_delete')}}</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['action' => ['Administrator\AdminController@destroy', '1'],'method'=>'DELETE','role'=>'form', 'id'=>'Delete_form']) }}

                {!! Form::submit(trans('cpanel.delete'), array('class'=>'btn btn-danger')) !!}
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{trans('cpanel.cancel')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(".admin_delete").click(function() {
        var id = $(this).data("id");
        var action = "{!! url('admins') !!}" + "/" + id;
        $("#Delete_form").attr("action", action);
        $('html, body').animate({scrollTop: 0}, 0);
    });
</script>
@stop
