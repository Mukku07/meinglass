/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var Event = function () {
    this.__construct = function () {
        this.tooltip()
        this.submitForm();
        this.imageForm();
        this.addFormula();
        this.delete();
        this.addRow();
        this.deleteRow();
        this.includeCorner();
        this.addCorner();
        this.deleteCorner();
        this.shapeContinue();
        this.dimensionContinue();
        this.glassTypeContinue();
        this.getThickness();
        this.thicknessContinue();
        this.getEdgeType();
        this.edgeContinue();
        this.treatmentContinue();
        this.summaryContinue();
        this.updateStatus();
    };

    this.tooltip = function () {
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
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
                        $("#" + i).parent("div").append('<span class="error"><p>' + out.errors[i] + '</p></span>');
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

    this.imageForm = function () {
        $(document).on('submit', '#image-form', function (evt) {
            evt.preventDefault();
            var form = $(this)[0];

            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (out) {
                    $('.error').remove();
                    if (out.result === 0) {
                        for (var i in out.errors) {
                            $("#" + i).parent("div").append('<span class="error"><p>' + out.errors[i] + '</p></span>');
                            $("#" + i).focus();
                        }
                    }
                    if (out.result === -1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $("#error_msg").html(message + out.msg);
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
                    if (out.result === -2) {
                        for (var i in out.errors) {
                            $("#" + i).parent("div").append('<span class="error"><p>' + out.errors[i] + '</p></span>');
                            $("#" + i).focus();
                        }
                    }
                }
            });
        });
    };

    this.addFormula = function () {
        $(document).on('submit', '#add-formula', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $('textarea.editor').val();
            var form = $(this)[0];
            $.post(url, {formula: postdata}, function (out) {
                $('#formula > .error').remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parent("div").append('<span class="error"><p>' + out.errors[i] + '</p></span>');
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

    this.delete = function () {
        $(document).on('click', '.delete', function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            if (confirm('Are you sure you want to Delete?')) {
                $.post(url, '', function (out) {
                    if (out.result === 1) {
                        window.location.href = out.url;

                    } else if (out.result === -1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $("#error_msg").removeClass('alert-danger').addClass('alert-success').show();
                        $("#error_msg").html(message + out.msg);
                    }
                });
            }

        });
    };

    this.addRow = function () {
        $(document).on('click', '.tr_clone_add', function (evt) {
            evt.preventDefault();
            var $tr = $('.tr_clone:last');
            var $clone = $tr.clone();
            $clone.find('span').remove();
            $clone.find('#term_id,#min_size,#max_size,#prefix,#mapping_id').val('');
            $clone.find('.col-md-1').html('<span><a href="#" class="remove_row"><i class="fas fa-minus-square"></i></a></span>');
            $('.clon_row').before($clone);
        });
    };

    this.deleteRow = function () {
        $(document).on('click', '.remove_row', function (evt) {
            evt.preventDefault();
            var mapping_id = $(this).parents('.tr_clone').find('#mapping_id').val();
            if (mapping_id) {
                var url = $(this).attr('href');
                $.post(url, {mapping_id: mapping_id}, function (out) {
                    if (out.result === 1) {
                        location.reload();
                    }
                });
            }
            var $tr = $(this).closest('.tr_clone');
            $tr.remove();
        });
    };

    this.includeCorner = function () {
        $('#is_corner').click(function () {
            if ($(this).prop("checked") === true) {
                $('.crn').removeClass('d-none');
                $('.corner_clone_add').removeClass('d-none');
            }
            if ($(this).prop("checked") === false) {
                $('.crn').addClass('d-none');
                $('.corner_clone_add').addClass('d-none');
            }
        });
    };

    this.addCorner = function () {
        $(document).on('click', '.corner_clone_add', function (evt) {
            evt.preventDefault();
            var $tr = $('.corner_clone:last');
            var $clone = $tr.clone(true);
            $clone.find('span').remove();
            $clone.find('#corner_name,#corner_id').val('');
            $clone.find('.col-md-1').html('<span><a href="#" class="remove_corner"><i class="fas fa-minus-square"></i></a></span>');
            $('.corner_row').before($clone);
        });
    };

    this.deleteCorner = function () {
        $(document).on('click', '.remove_corner', function (evt) {
            evt.preventDefault();
            var corner_id = $(this).parents('.corner_clone').find('#corner_id').val();
            if (corner_id) {
                var url = $(this).attr('href');
                $.post(url, {corner_id: corner_id}, function (out) {
                    if (out.result === 1) {
                        location.reload();
                    }
                });
            }
            var $tr = $(this).closest('.corner_clone');
            $tr.remove();
        });
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
            if (typeof url !== "undefined") {
                
                var id = $('#material').val();
                $.post(url, {id: id}, function (out) {
                    $('#thickness-wrapper').html(out.thickness_list);
                });
            }
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
            if (typeof url !== "undefined") {
                $.post(url, {edge_id: edge_id}, function (out) {
                    $('#edge-wrapper').html(out.edge_list);
                });
            }
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
           var postdata = $('#price_form').serialize();
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
   
   this.updateStatus = function () {
        $(document).on('click', '.dispaly_status', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("href");
            if (confirm('Are you sure update product status?')) {
                $.post(url, function (out) {
                    if (out.result === 1) {
                        alert(out.msg);
                        window.location.href = out.url;
                    }
                });
            }
        });
    };

    this.__construct();
};
var obj = new Event();
