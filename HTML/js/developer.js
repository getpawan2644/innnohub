$('document').ready(function(){
    $('body').on('click', '.request-product', function(){
        $product_slug = $(this).attr('product_slug');
        $route_arr = $(this).attr('route_arr');
        $.ajax({
            url : $route_arr,
            data : {'product_slug':$product_slug},
            type : 'GET',
            dataType:'json',
            cache: false,
            success : function (response){
               $('.request-product-model').html(response.html)
               $('#request-modal').modal('show')
            },
            beforeSend : function (response){
                //console.log('resp',response)
            },
            error : function (error) {
                //console.log('error',error)
            }
        });
    });

    $('body').on('submit', 'form#request-product-form', function(event){
        let formData = $(this).serialize()
        $('.pre_loader').show();
        $.ajax({
            url : $route_arr,
            data : formData,
            type : 'POST',
            dataType:'json',
            cache: false,
            success : function (response){
                $('.pre_loader').hide();
                console.log(response);
                if(response.success==false){
                    $('.request-product-model').html(response.html)
                    $('#request-modal').modal('show')
                }else{
                    $('#request-modal').modal('hide')
                    alertMessage(response.message, 'success');
                }
                $("#req_submit_btn").removeAttr('disabled');
            },
            beforeSend : function (response){
                $('.pre_loader').hide();
                $("#req_submit_btn").attr('disabled',"disabled");
            },
            error : function (error) {
                $('.pre_loader').hide();
                $("#req_submit_btn").removeAttr('disabled');
                console.log('error',error);
                // $('.request-product-model').html(response.html)
                // $('#request-modal').modal('show')
            }
        });
        event.preventDefault();
    });
    //Mark As Favorite/Unfavorite
    $('body').on('click', '.save-as-favorite', function () {
        $this = $(this);
        $route_attr = $(this).attr('route_attr');
        $product_id = $(this).attr('product_id');
        //alert($product_id)
        $.ajax({
            url: $route_attr ,
            dataType: "json",
            type: "POST",
            cache: false,
            async: true,
            data: {'product_id':$product_id},
            beforeSend: function () {

            },
            success: function (response) {
                console.log(response)
                if (response.status) {
                    $this.find('i').toggleClass('fav-color');
                    alertMessageBottm(response.message, 'success');
                } else {
                    alertMessageBottm(response.message, 'error');
                }
            },
            complete: function () {

            },
            error: function (err) {
                if (err.status == 401) {
                    alertMessageBottm('You need to login to mark as Favorite', 'error');
                }
            }
        })
    });
    // $('body').on('click', '.single-product', function(){
    //     location.href = $(this).attr('data-href');
    // })
});
