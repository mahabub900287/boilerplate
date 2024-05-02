(function ($) {
    ("use strict");


    $(".dropdown-btn").on("click", function () {
        event.stopPropagation();
        $(this).toggleClass("icon-active");
        $(this).children('.ic-sub-menu').slideToggle();
        $(this).prevAll(".dropdown-btn").children('.ic-sub-menu').slideUp();
        $(this).nextAll(".dropdown-btn").children('.ic-sub-menu').slideUp();
    });
    $(document).ready(function () {

        $(".ic-dropdown-btn").on("click", function () {
            event.stopPropagation();``
            $(this).children('.ic-dropdown-menu').toggleClass("active");
        });

        $(".ic-toggle-btn").on("click", function () {
            $(".ic_student_menubar_wrapper").toggleClass("open");
            $(".ic-toggle-btn-icon").toggleClass("open");
        });
        $(".ic-searchbar").on("click", function () {
            event.stopPropagation()
            $(this).addClass("active");
        });

        // $('.ic-home-content').on("click", function () {
        //     $(".ic-dropdown-menu").removeClass("active");
        //     $(".ic-searchbar").removeClass("active");
        // })

        $('body').on("click", function () {
            $(".ic-dropdown-menu").removeClass("active");
            $(".ic-searchbar").removeClass("active");
        })

        $(".e1_element").fontIconPicker();
    });



    // select picker
    $('.ic-select').selectpicker();
    $('.dropdown-toggle').removeAttr('title');

    $(document).ready(function () {
        $('.ic-select2').select2(
            {
                placeholder: "",
                // allowHtml: true,
                allowClear: true,
                tags: true
            }
        );



        // password show hide
        $(".password-toggler").click(function () {
            $(this).children().toggleClass("ri-eye-off-line ri-eye-line");
            // input = $("#pass-toggle");
            input = $(this).parent(".input-icon-wrapper").find(".pass-toggle");
            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
        });

        // switch pricing
        $('.pricing-switch').on('click', function () {
            if ($(this).is(':checked')) {
                $(this).closest('.switch-buttons').find('.monthly').addClass('active');
                $(this).closest('.switch-buttons').find('.yearly').removeClass('active');

                $(this).parent(".switch-buttons").parent().parent(".ic-plan-content").find(".ic-monthly-plans").slideDown();
                $(this).parent(".switch-buttons").parent().parent(".ic-plan-content").find(".ic-yearly-plans").slideUp();
            } else {
                $(this).closest('.switch-buttons').find('.monthly').removeClass('active');
                $(this).closest('.switch-buttons').find('.yearly').addClass('active');

                $(this).parent(".switch-buttons").parent().parent(".ic-plan-content").find(".ic-monthly-plans").slideUp();
                $(this).parent(".switch-buttons").parent().parent(".ic-plan-content").find(".ic-yearly-plans").slideDown();

                // $(this).parent(".switch-buttons").parent(".ic-plan-switch").find("#ic-monthly-plans").slideDown();
                // $(this).parent(".switch-buttons").parent(".ic-plan-switch").find("#ic-yearly-plans").slideUp();
            }
        });

        $(".card-expiry").keyup(function () {
            if (this.value.length == this.maxLength) {
                $(this).next('input').focus();
            }
        });







    });

    $(document).ready(function () {
        $(".ic-single-accordian-heading").click(function () {

            $(this).parent(".ic-single-accordian").find(".ic-single-accordian-content").slideToggle();
            $(this).parent(".ic-single-accordian").prevAll(".ic-single-accordian").find(".ic-single-accordian-content").slideUp();
            $(this).parent(".ic-single-accordian").nextAll(".ic-single-accordian").find(".ic-single-accordian-content").slideUp();


            $(this).find(".ic_arrow").toggleClass("active");
            $(this).parent(".ic-single-accordian").nextAll(".ic-single-accordian").children().find(".icon").removeClass("active");
            $(this).parent(".ic-single-accordian").prevAll(".ic-single-accordian").children().find(".icon").removeClass("active");
        });
    });

    // switch pricing
    $('.prepacked-switch').on('click', function () {
        $('.prepacked-content').slideToggle();
    });
})(jQuery);