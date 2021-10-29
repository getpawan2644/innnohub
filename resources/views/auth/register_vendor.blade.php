@php
    $categories = \App\Models\Category::getCategoryList();
    // dd($categories[0]->id);
    // $locale = \App::getLocale();
    $routeName = Route::currentRouteName();
//      if(Auth::check()){
//     $unread_message=App\Models\Messages::getUnreadMessage();
//      }else{
//    $unread_message=false;
//      }
  // dd($top_banners);
@endphp
@extends('layouts.default')
@section('title', __("content.register"))
@section('content')
     <!-- inner-header -->
    @include('elements.banner.inner_banner')
     <!-- inner-header end -->

<!-- sign up -->

  <!--  Vendor signup step-2-->
  <section>
    <div class="signup">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-5">
            <div class="sgn-wrap">
              <img src="{{ asset('image/registration.jpg') }}" alt="image" class="img-fluid">
            </div>

          </div>
          <div class="col-lg-7">
            <!-- signup -->
            <div class="signup-form">
                <form  method="POST" action="{{ route('user.post-register') }}" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="user_type" value="{{ $user_type }}">
                    <div class="col-lg-12">
                      <h3>Register as Vendor</h3>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="text-start mb-0">Select Criteria</h5>
                    </div>

                    <div class="col-lg-12">
                        <div class="reg-checkboxes">
                            @if($categories->count()>0)
                            @php $slNo =  0; @endphp
                            @foreach($categories as $category)
                            <!-- category checkbox -->
                            <div class="form-check">
                                <input {{ $slNo==0?"checked required":'' }} class="form-check-input cat_change" type="radio" name="category_id" value="{{@$category->slug}}" id="{{@$category->name}}_id">
                                <label class="form-check-label" for="{{@$category->name}}_id">
                                    {{@$category->name}}
                                </label>
                            </div>
                            <!-- category checkbox end -->
                            @php $slNo++; @endphp
                            @endforeach
                            @endif
                        </div>
                    </div>


                    <div class="col-lg-12 mt-4">
                    <h5 class="text-start mb-0 mt-3">Select categories</h5>
                    </div>
                    <div class="col-lg-6">
                    <!-- multiselect -->
                    <div class="inno-multiselect">
                        <span class="down-arrow"><i class="icofont-simple-down"></i></span>
                        <select id="example-getting-started" name="subcategory_id[]" multiple="multiple" required>
                        </select>
                    </div>
                    <!-- multiselect end -->

                    </div>

                    <div class="col-md-6">
                      <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $record->first_name) }}" placeholder="{{__('content.first_name')}}" required>
                      @error('first_name')
                          <span class="error-message">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter your First name.
                      </div>
                    </div>

                    <div class="col-md-6">
                      <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $record->last_name) }}" placeholder="{{__('content.last_name')}}" required>
                      @error('last_name')
                          <span class="error-message">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter your Last name.
                      </div>
                    </div>

                    <div class="col-md-6">
                      <input type="email" class="form-control" name="email" value="{{ old('email', $record->email) }}" placeholder="{{__('content.email_id')}}" required>
                      @error('email')
                          <span class="error-message">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter corporate email.
                      </div>
                    </div>

                    <div class="col-md-6">
                      {{-- <input type="number" class="form-control" placeholder="Phone number" required> --}}
                      <input type="hidden" id="country_code" name="country_code" value="{{ old('country_code', $record->country_code) }}">
                      <input type="hidden" id="dial_code" name="dial_code" value="{{ old('dial_code', $record->dial_code) }}">
                      <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="mobile" id="mobile" value="{{ old('mobile', $record->mobile) }}" placeholder="{{__('content.phone_number')}}" required>
                      @error('mobile')
                          <span class="error-message">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter your Phone number.
                      </div>
                    </div>

                    <div class="col-md-6">
                      <input type="text" class="form-control" name="password" value="{{ old('password', $record->password) }}" placeholder="{{__('content.password')}}" required>
                      @error('password')
                          <span class="error-message">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter new password.
                      </div>
                    </div>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="password_confirmation" value="{{ old('password_confirmation', $record->password_confirmation) }}" placeholder="{{__('content.confirm_password')}}" required>
                      @error('password_confirmation')
                          <span class="error-message">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter Confirm password.
                      </div>
                    </div>


                    <div class="col-12">
                      <button class="inno_btn px-4 mt-4" type="submit">{{__('content.register')}}</button>
                      <p class="pt-3">{{__('content.already_have_account')}}<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#login_model">{{__('content.log_in')}}</a> </p>
                    </div>
                  </form>
            </div>
            <!-- signup end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Vendor signup end -->
<!-- sign up end -->
<script>
    //Code for intell input
    var input = document.querySelector("#mobile");
    var iti = window.intlTelInput(input, {
        initialCountry: "{{ !empty(old('country_code', $record->country_code))?old('country_code', $record->country_code):'in' }}",
        //separateDialCode: true,
        //utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
        // any initialisation options go here
    });
    window.intlTelInputGlobals.loadUtils("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js");
    input.addEventListener("countrychange", function() {
        console.log(iti.getSelectedCountryData());
        let countryData = iti.getSelectedCountryData();
        document.getElementById('country_code').value =countryData.iso2;
        document.getElementById('dial_code').value =countryData.dialCode;
    });

</script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
  </script>
<script>
$('document').ready(function(){
    @if(!empty(old("category_slug",$categories[0]->slug)))
    populateSubcategory("{{old("category_slug",$categories[0]->slug)}}");
    @endif


    $('body').on('change', '.cat_change', function(){
        // alert($(this).val())
        $category_id = $(this).val();
      
        // $subcategory = $('#subcategory_id')
        populateSubcategory($category_id);
    });

});

function populateSubcategory($categoryId=null, $subCategoryId=null){
    console.log($categoryId);
    console.log($subCategoryId);
        $category_id = $categoryId;
        $subcategory = $('#example-getting-started');
        $.ajax({
            url : "{{ route('ajax.subcategory') }}",
            data : {'category_slug':$category_id,'_token':"{{ csrf_token() }}"},
            type : 'POST',
            dataType: "json",
			cache: false,
			async: true,
			// contentType: false,
			// processData: false,
            success : function (response){
                 
                $subcategory.find('option').remove();
               // console.log(response.length);
                if(response.length < 0){
                 $subcategory.find('option').remove();
					 

                    $subcategory.append($("<option/>", {
                        value: '',
                        text: "No Records Found"
                    }));
                } else {
					
					 console.log(response.length);
                    $subcategory.multiselect('dataprovider', response);

                    // $subcategory.append($("<option/>", {
                    //     value: "",
                    //     text: "Select Subcategory"
                    // }));
                    // $.each(response, function(key, value) {
                    //     if(value.id=="{{old("subcategory_id",$categories[0]->id)}}"){
                    //         $subcategory.append($("<option/>", {
                    //             value: value.id,
                    //             text: value.name,
                    //             selected:true
                    //         }));
                    //     }else{
                    //         $subcategory.append($("<option/>", {
                    //             value: value.id,
                    //             text: value.name
                    //         }));
                    //     }
                    // });
                    // $('#example-getting-started').multiselect('destroy');
                    // $subcategory.multiselect('refresh');
                    // $subcategory.trigger('change');

                    // setTimeout(function(){
                        // $subcategory.multipleSelect('refresh');
                    // }, 3000);
                    // console.log($subcategory);
					
					
                   
                }

            },
            beforeSend : function (){
                // $subcategory.html("<option>Loading </option>");
            },
            error : function () {
                $subcategory.find('option').remove();
                $subcategory.append($("<option/>", {
                    value: '',
                    text: "No Records Found"
                }));
                $subcategory.trigger('change');
            }
        });


        // $subcategory.multiselect('reload');
}

</script>
@endsection
