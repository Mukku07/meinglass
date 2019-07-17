/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var Event = function () {
    this.__construct = function () {
        this.shapeContinue();
        this.dimensionContinue();
        this.glassTypeContinue();
        this.getThickness();
        this.thicknessContinue();
        this.getEdgeType();
        this.edgeContinue();
        this.treatmentContinue();
        this.summaryContinue();
        //this.calculateShippingCost();
        this.orderContinue();
        this.sameAddress();
        this.submitForm();
        this.updateCartData();
        this.deleteCartData();
        this.user_register();
        this.showModel();
        this.hideOpenLoginModel();
        this.hideOpenRegisterModel();
        this.callShowModel();
    };

    this.shapeContinue = function () {
        $(document).on('click', '#shape-continue', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            var shape_id = $('input:radio.shape:checked').val();
            $.post(url, {shape_id: shape_id}, function (out) {
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.dimensionContinue = function () {
        $(document).on('click', '#dimension-continue', function (evt) {
            evt.preventDefault();

            var url = $(this).attr("href");
            var term_size = [];
            var corner = [];
            var i = 0;
            var j = 0;
            $('.term_size').each(function () {
                term_size[i] = $(this).val();
                i++;
            });
            $('.corner').each(function () {
                corner[j] = $(this).val();
                j++;
            });
            var dimension_id = $('#dimension_id').val();
            $.post(url, {term_size: term_size, corner: corner, dimension_id: dimension_id}, function (out) {

                if (out.result === 0) {
                    $(".error").remove();
                    $(".errormsg").append('<span class="error"><p>' + out.errors + '</p></span>');
                }
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.glassTypeContinue = function () {
        $(document).on('click', '#glass-type-continue', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            var val = $("input[name='glass_type_id']:checked").val();
            $.post(url, {glass_type_id: val}, function (out) {
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.getThickness = function () {
        $(document).ready(function () {
            var url = $('#material').data('url');
            var id = $('#material').val();
            $.post(url, {id: id}, function (out) {
                $('#thickness-wrapper').html(out.thickness_list);
            });
        });

        $(document).on('change', '#material', function () {
            var url = $(this).data('url');
            var id = $(this).val();
            $.post(url, {id: id}, function (out) {
                $('#thickness-wrapper').html(out.thickness_list);
            });
        });
    };

    this.thicknessContinue = function () {
        $(document).on('click', '#thickness-continue', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            var material_id = $('#material').val();
            var thickness_id = $("input[name='thickness']:checked").val();
            $.post(url, {material_id: material_id, thickness_id: thickness_id}, function (out) {
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.getEdgeType = function () {
        $(document).ready(function () {
            var url = $('#edge').data('url');
            var edge_id = $('#edge').val();
            $.post(url, {edge_id: edge_id}, function (out) {
                $('#edge-wrapper').html(out.edge_list);
            });
        });

        $(document).on('change', '#edge', function () {
            var url = $(this).data('url');
            var edge_id = $(this).val();
            $.post(url, {edge_id: edge_id}, function (out) {
                $('#edge-wrapper').html(out.edge_list);
            });
        });
    };

    this.edgeContinue = function () {
        $(document).on('click', '#edge-continue', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            var edge_id = $('#edge').val();
            var edge_element_id = $('#edge_element_id').val();
            var edge_type_id = $('#edge_type').val();
            $.post(url, {edge_id: edge_id, edge_element_id: edge_element_id, edge_type_id: edge_type_id}, function (out) {
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.treatmentContinue = function () {
        $(document).on('click', '#treatment-continue', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            var treatment_id = $('#treatment').val();
            $.post(url, {treatment_id: treatment_id}, function (out) {
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.summaryContinue = function () {
        $(document).on('click', '#summary-continue', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            var postdata = $('#zip_postal_form').serialize();
            $.post(url, postdata, function (out) {
                $("li > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("." + i).parents("li").append('<span class="error text-danger">' + out.errors[i] + '</span>');
                        $("." + i).focus();
                    }
                }
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.calculateShippingCost = function () {
        // $(document).ready(function(){
        //   $("#calculate_total").click(function(){

        //     $("#cal_ShippingCost").fadeIn(30000);
        //   });
        // });


        // $(document).ready(function($) {
        //     $('#calculate_total').click(function(event) {
        //         /* Act on the event */
        //         $('#cal_ShippingCost').show();
        //     });
        // });
        // $(document).on('click', '#calculate_total', function (evt) {
        //     evt.preventDefault();

        //     $("#cal_ShippingCost").show();

        //     var url = $(this).val();
        //     $.post(url, function (out) {
        //         if (out.result === 1) {
        //             //window.location.href = out.url;
        //         }
        //     });
        // });
    };

    this.orderContinue = function () {
        $(document).on('click', '#order-continue', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            var postdata = $('#address_form').serialize();
            $.post(url, postdata, function (out) {
                $("form-control > .error").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        
                        $("#" + i).parents(".col-xs-9").append('<span class="error text-danger">' + out.errors[i] + '</span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === 1) {
                    window.location.href = out.url;
                }
            });
        });
    };


    this.sameAddress = function () {
        $("#same_address").on("click", function (evt) {
            evt.preventDefault();
            var ship = $(this).prop("checked");
            if (ship === true)
            {
                $("#shipping_comp_name").val($("#billing_comp_name").val());
                $("#shipping_first_name").val($("#billing_first_name").val());
                $("#shipping_last_name").val($("#billing_last_name").val());
                $("#shipping_country").val($("#billing_country").val());
                $("#shipping_address1").val($("#billing_address1").val());
                $("#shipping_address2").val($("#billing_address2").val());
                $("#shipping_zip_code").val($("#billing_zip_code").val());
                $("#shipping_city_name").val($("#billing_city").val());
                $("#shipping_state").val($("#billing_state").val());
                $("#shipping_phone").val($("#billing_phone").val());
            } else
            {
                $("#shipping_comp_name").val('');
                $("#shipping_first_name").val('');
                $("#shipping_last_name").val('');
                $("#shipping_country").val('');
                $("#shipping_address1").val('');
                $("#shipping_address2").val('');
                $("#shipping_zip_code").val('');
                $("#shipping_city_name").val('');
                $("#shipping_state").val('');
                $("#shipping_phone").val('');
            }
        });
    };

    this.submitForm = function () {
        $(document).on('submit', '#common-form', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            var form = $(this)[0];
            $.post(url, postdata, function (out) {
                $('.error').remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parent('div').append('<span class="error"><p style="color:red;">' + out.errors[i] + '</p></span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    window.setTimeout(function () {
                        $('#error_msg').slideUp();
                    }, 2000);
                }
                if (out.result === 1) {
                    form.reset();
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-success alert-dismissable').show();
                    $("#error_msg").html(message + out.msg);
                    window.setTimeout(function () {
                        $('#error_msg').slideUp();
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }, 2000);
                }
            });
        });
    };

    this.updateCartData = function () {
        $(document).on('change', '#qty', function (evt) {
            var qty = $(this).val();
            var url = $(this).attr('data-url');
           
            $.post(url, {qty: qty}, function (out) {

                if (out.result === 0) {
                    alert(out.msg);
                    
                }
                if (out.result === 1) {
                    alert(out.msg);
                    location.reload();
                }
            });
        });
    };


    this.deleteCartData = function () {
        $(document).on('click', '#deleteCart', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            var deletecart = deletecart;
            $.post(url, {deletecart: deletecart}, function (out) {

                if (out.result === 0) {
                    alert(out.msg);
                }
                if (out.result === 1) {
                    alert(out.msg);
                    window.location.href = out.url;
                }
            });
        });
    };

    this.user_register = function () {
        $(document).on('submit', '#user_register, #user_login, #forgot_password', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            var form = $(this)[0];

            $.post(url, postdata, function (out) {
                $('.error').remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parent('div').append('<span class="error"><p style="color:red;">' + out.errors[i] + '</p></span>');
                        $("#" + i).focus();
                    }
                }
                if (out.result === -1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#errors_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                    $("#errors_msg").html(message + out.msg);
                    window.setTimeout(function () {
                        $('#errors_msg').slideUp();
                    }, 2000);
                }
                if (out.result === 1) {
                    form.reset();
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $("#errors_msg").removeClass('alert-warning alert-success').addClass('alert alert-success alert-dismissable').show();
                    $("#errors_msg").html(message + out.msg);
                    window.setTimeout(function () {
                        $('#errors_msg').slideUp();
                        if (out.url) {
                            window.location.href = out.url;
                        }
                    }, 2000);
                }
            });
        });
    };

    this.showModel = function () {
        $(document).on('click', '#summarycontinue', function (evt) {
            evt.preventDefault();
            $('#myModal').modal('show');
        });
    };

    this.hideOpenLoginModel = function () {
        $(document).on('click', '#loginuserbtn', function (evt) {
            evt.preventDefault();
            $('#myModal').modal('hide');
            $('#loginuser').modal('show');
        });
    };
    
    this.hideOpenRegisterModel = function () {
        $(document).on('click', '#registeruserbtn', function (evt) {
            evt.preventDefault();
            $('#myModal').modal('hide');
            $('#registeruser').modal('show');
        });
    };
    
    this.callShowModel = function () {alert("hi");
        $(document).on('click', '#addto_cart', function (evt) {
            evt.preventDefault();alert("heloo");
            $('#myModal').modal('show');
        });
    };

    this.__construct();
};
var obj = new Event();