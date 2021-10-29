@extends('layouts.admin.default')

@section('title',"Add Client Category")

@section('header',"Add Client Category")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.client_categories.index') }}">Manage Categories </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Client Category</li>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.client_categories.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Category Order</label>
                                        <input type="number" class="form-control" name="category_order" placeholder="Enter category order number" value='{{ old('category_order', $record->category_order) }}'>
                                        @if ($errors->has('category_order'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('category_order') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @foreach(config('translatable.locales_name') as $language=>$locale)
                            <div class="card card-border-primary language_card">
                                <div class="card-header text-{{CommonHelper::getTextAlign($locale)}}">{{$language}}</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Client Category Name</label>
                                                <input type="text" class="form-control" name="{{ $locale }}[name]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter Client Category Name" value="{{ old($locale.'.name', $record->name) }}">
                                                @if ($errors->has($locale.'.name'))
                                                    <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                        <strong>{{ $errors->first($locale.'.name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Add</button>
                            <a href="{{ route('admin.client_categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <script>
        function template(data) {
            return $("<span class="+data.id+"> "+data.text+" </span>");
        }
        $(document).ready(function() {
            $('.iconSelect').select2({
                allowClear: true,
                templateResult: template,
                templateSelection: template
            });
        });

    </script> -->
@endsection
