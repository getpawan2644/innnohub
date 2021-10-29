@extends('layouts.admin.default')

@section('title',"Sub Admin")

@section('header',"Manage Sub Admin")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Manage Sub Admin</li>
@endsection

@section('content')
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-12 text-right" style="line-height:0;">
                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary" style="margin-top:-85px">Add Sub Admin</a>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body card_table_body">
                        <div class="card-header">
                            @include('admin.elements.search.common')
                        </div>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@sortablelink('name', 'Name')</th>
                                    <th>@sortablelink('email', 'Email')</th>
                                    <th>@sortablelink('phone', 'Phone')</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($records->count())
                                    @php $slNo =  $records->firstItem() @endphp
                                    @foreach($records as $record)
                                        <tr>
                                            <td align="center">{{ $slNo++ }}</td>
                                            <td>{{ $record->name }}</td>
                                            <td>{{ $record->email }}</td>
                                            <td>{{ $record->phone }}</td>
                                            <td align="center">
                                                <a href="{{ route('admin.admins.edit',$record->id) }}" class="action_btn"><i class="la la-pencil"></i> Edit</a>
                                                <a href="JavaScript:Void(0);"data-action="{{ route('admin.admins.destroy',$record->id) }}" class="action_btn confirmDelete"><i class="la la-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="5">No Record Found!</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        @include('admin.elements.pagination.common')
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
