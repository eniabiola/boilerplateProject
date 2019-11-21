@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Companies <small class="text-muted">all</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.company.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>name</th>
                            <th>description</th>
                            <th>user</th>
                            <th>account</th>
                            <th>type</th>
                            <th>status</th>
                            <th>updated at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->description }}</td>
                                <td>{{ $company->user->name }}</td>
                                <td>{{ $company->account->name }}</td>
                                <td>{{ $company->type }}</td>
                                <td>{{ $company->status }}</td>
                               {{--  <td>{{ $company->updated_at->diffForHumans() }}</td>--}}
                                <td>@include('backend.company.includes.actions', ['company' => $company])</td> 
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{-- {!! $users->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $users->total()) }} --}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                  {{--   {!! $companies->render() !!} --}}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
