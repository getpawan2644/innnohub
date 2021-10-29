@extends('layouts.admin.default')

@section('title',"Add Faq")

@section('header',"Add Faq")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.faqs.index') }}">Manage Faqs </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Faq</li>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.faqs.store') }}" enctype="multipart/form-data">
                            @csrf
                            @foreach(config('translatable.locales_name') as $language=>$locale)
                            <div class="card card-border-primary language_card">
                                <div class="card-header text-{{CommonHelper::getTextAlign($locale)}}">{{$language}}</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Question</label>
                                                <input type="text" class="form-control" name="{{ $locale }}[question]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter Faq question" value={{ old($locale.'.question', $record->translateOrNew($locale)->question) }}>
                                                @if ($errors->has($locale.'.question'))
                                                    <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                        <strong>{{ $errors->first($locale.'.question') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Answer</label>
                                                <input type="text" class="form-control" name="{{ $locale }}[answer]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter Faq answer" value={{ old($locale.'.answer', $record->translateOrNew($locale)->answer) }}>
                                                @if ($errors->has($locale.'.answer'))
                                                    <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                        <strong>{{ $errors->first($locale.'.answer') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Add</button>
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
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
