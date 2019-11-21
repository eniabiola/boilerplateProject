@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', url('/company/sentinvite'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.users.management')
                            <small class="text-muted">@lang('labels.backend.access.users.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="name">User Name</label>
                            
                            <div class="col-md-10">
                                <input type="text" name="name" class="form-control" id="name" maxlength="191" placeholder="John Doe">
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="email">User's Email</label>

                            <div class="col-md-10">
                                <input type="email" name="email" id="email" class="form-control" maxlength="191" placeholder="{{'johndoe@company.com'}}" required autofocus>
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            <label for="company" class="col-md-2 form-control-label">Company</label>
                            <div class="col-md-4">
                                <select class="form-control" name="Company" id="company">
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('company.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('Send Invite')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
