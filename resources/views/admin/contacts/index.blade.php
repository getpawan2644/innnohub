@php
    use App\Models\ContactUs;
@endphp

@extends('layouts.admin.default')
@section('title',"User")
@section('header',"Manage Contact")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Manage User</li>
@endsection
@section('content')
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-12 text-right" style="line-height:0;">
{{--                <a href="{{ route('admin.service-add',$service) }}" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Service</a>--}}
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
                                    <th style="width:300px;">Name</th>
                                    <th style="width:200px;">Email</th>
                                    <th style="width:200px;">phone</th>
                                    <th style="width:200px;">message</th>
                                    <th style="width:200px;">status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($records->count())
                                    @php $slNo =  $records->firstItem() @endphp
                                    @foreach($records as $record)
                                        <td align="center">{{ $slNo++ }}</td>
                                        <td>{{$record->name}}</td>
                                        <td> {{ $record->email }}  </td>
                                        <td> {{ $record->mobile }}</td>
                                        <td> {{ $record->message }}</td>
                                        <td align="center" class="align_center">{!! CommonHelper::getStatusUrl('admin.contacts.changeStatus',$record->status,$record->id) !!}</td>
                                        <td align="center">
                                            <a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('admin.contacts.destroy',$record->id) }}"><i class="la la-trash"></i> <span>Delete</span></a>
                                        </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="7">No Record Found!</td>
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
