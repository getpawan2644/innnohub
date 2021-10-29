@extends('layouts.admin.default')

@section('title',"Update Profile")

@section('header',"Update Profile")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
@endsection

@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<section class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">&nbsp;</p>
                    <div class="text-center">
                        <div class="profile_img">
                            <div class="fileContainer" id="crop-avatar">
                                <!-- Current avatar -->
                                <img width="200" src="{{ Auth::guard('admin')->user()->profile_pic_url }}" class="profile_pic rounded-circle admin_profile_picture img-responsive avatar-view" alt=""/>
                                <div class="overlay">
                                    <div class="text">Change Picture</div>
                                </div>
                                <form id="uploadImage">
                                    <input type="file" id="image">
                                </form>
                                <div id="upload-progress">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-description">&nbsp;</p>
                    <form class="forms-sample" method="POST" action="{{ route('admin.updateProfile') }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Name" value="{{ old('name',$admin->name) }}">
                                    @if ($errors->has('name'))
                                        <span class="error-message">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="{{ old('email',$admin->email) }}">
                                    @if ($errors->has('email'))
                                        <span class="error-message">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 mt-4">Submit</button>
                        <a href="{{ route('admin.dashboard.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="upload-demo" class="modal-body text-center">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" id="upload-image" class="btn croper_btn btn-primary">Upload</button>
                <button type="button" class="btn btn-accent btn-outline" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var resize = $('#upload-demo').croppie({
        enableExif: true,
        enableOrientation: true,
        viewport: {
            width: 120*2,
            height: 120*2,
        },
        boundary: {
            width: 400,
            height: 400
        },
    });

    $('#image').on('change', function (event) {
        if(this.files[0] == undefined){
            return false;
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#myModal').on('shown.bs.modal', function(){
                resize.croppie('bind',{
                    url: e.target.result
                }).then(function(){

                });
                $("#uploadImage").get(0).reset();
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#myModal').modal('show');
    });

    $('#upload-image').on('click', function (ev) {
        $('#myModal').modal('hide');
        resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (img) {
            $.ajax({
                url :"{{route('admin.updateProfilePic')}}",
                dataType:"json",
                type: "POST",
                data: {"profile_pic":img},
                xhr: function(){
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', function(event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            //update progressbar
                            $("#upload-progress .progress-bar").css("width", + percent +"%").html(+ percent +"%");
                        }, true);
                    }
                    return xhr;
                },
                beforeSend: function() {
                    $("#upload-progress").show();
                    $("#upload-progress .progress-bar").css("width","0px").html("");
                },
            }).done(function(response){
                $("#upload-progress").hide();
                if(response.status){
                    $(".profile_pic").attr("src",response.message);
                }

            });
        });
    });
});
</script>




@endsection
