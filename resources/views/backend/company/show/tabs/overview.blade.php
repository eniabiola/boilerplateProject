<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('Company Name')</th>
                <td>{{ $company->name }}</td>
            </tr>

            <tr>
                <th>@lang('Company Description')</th>
                <td>{{ $company->description }}</td>
            </tr>

            <tr>
                <th>@lang('Company User')</th>
                <td>{{ $company->user->name }}</td>
            </tr>

            <tr>
                <th>@lang('Company Account')</th>
                <td>{{$company->account->name}}</td>
            </tr>

            <tr>
                <th>@lang('Type of Company')</th>
                <td>{{$company->type}}</td>
            </tr>

            <tr>
                <th>@lang('Type of Company')</th>
                <td>{{$company->type}}</td>
            </tr>

            <tr>
                <th>@lang('Company Status')</th>
                <td>{{ $company->status }}</td>
            </tr>

        </table>
    </div>
</div><!--table-responsive-->
