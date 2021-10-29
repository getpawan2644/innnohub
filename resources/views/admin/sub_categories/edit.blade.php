@php
    use App\Models\Category;
    $categories = Category::getCategoryList();
@endphp
@extends('layouts.admin.default')

@section('title',"Edit Category")

@section('header',"Edit Category")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Manage Categories </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.sub_categories.update',$record->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Select Category</label>
                                        <select type="text" class="form-control" name="category_id"id="category_select"  placeholder="Please choose a category" value="{{ old('category_id',$record->category_id) }}">
                                            <option value="">
                                                Select CMS Page
                                            </option>
                                            @foreach($categories as $category)
                                                <option {{ old("category_id",$record->category_id) == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label float-left">Sub Category Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter sub-category name" value='{{ old('name', $record->name)}}'>
                                        @if ($errors->has('name'))
                                            <span class="error-message text-left">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Add</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        jQuery(document).ready(function(){
            $("#category_select").change(function(){
                $("#sub_category_code_prefix").text($('option:selected', this).attr('category_code'));
            });
        });
    </script>
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
