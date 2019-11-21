@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')

    {{ html()->form('POST', route('company.update', $company->id))->class('form-horizontal')->open() }}
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
                            {{ html()->label(__('Company Name'))->class('col-md-2 form-control-label')->for('name') }}
                              {{method_field('PUT')}}

                            <div class="col-md-10">
                                <input type="text" class="form-control" maxlength="191" value="{{$company->name}}" name="name" required autofocus>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('Company Description'))->class('col-md-2 form-control-label')->for('description') }}

                            <div class="col-md-10">
                                <textarea name="description" class="form-control" required>{{$company->description}}</textarea>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="account" class="col-md-2 form-control-label">Account</label>
                            <div class="col-md-4">
                                <select class="form-control" id="account" name="account_id">
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="type" class="col-md-2 form-control-label">Type</label>
                            <div class="col-md-4">
                                <select class="form-control" name="type" id="type">
                                    <option value="NORMAL">Normal</option>
                                    <option value="BRANCH">Branch</option>
                                    <option value="PARENT">Parent</option>
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="status" class="col-md-2 form-control-label">Status</label>
                            <div class="col-md-4">
                                <select class="form-control" name="status" id="status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
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
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
