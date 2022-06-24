jQuery(function ($) {
    "use strict"
    $.fn.bravoAutocomplete = function (options) {
        return this.each(function () {
            var $this = $(this);
            var main = $(this).closest(".smart-search");
            var textLoading = options.textLoading;
            main.append('<div class="bravo-autocomplete on-message"><div class="list-item"></div><div class="message">' + textLoading + '</div></div>');
            $(document).on("click.Bst", function (event) {
                if (main.has(event.target).length === 0 && !main.is(event.target)) {
                    main.find('.bravo-autocomplete').removeClass('show');
                } else {
                    if (options.dataDefault.length > 0) {
                        main.find('.bravo-autocomplete').addClass('show');
                    }
                }
            });
            if (options.dataDefault.length > 0) {
                var items = '';
                for (var index in options.dataDefault) {
                    var item = options.dataDefault[index];
                    items += '<div class="item" data-id="' + item.id + '" data-text="' + item.title + '"> <i class="' + options.iconItem + '"></i> ' + item.title + ' </div>';
                }
                main.find('.bravo-autocomplete .list-item').html(items);
                main.find('.bravo-autocomplete').removeClass("on-message");
            }
            var requestTimeLimit;
            if (typeof options.url != 'undefined' && options.url) {
                $this.on('keyup', function () {
                    main.find('.bravo-autocomplete').addClass("on-message");
                    main.find('.bravo-autocomplete .message').html(textLoading);
                    main.find('.child_id').val("");
                    var query = $(this).val();
                    clearTimeout(requestTimeLimit);
                    if (query.length === 0) {
                        if (options.dataDefault.length > 0) {
                            var items = '';
                            for (var index in options.dataDefault) {
                                var item = options.dataDefault[index];
                                items += '<div class="item" data-id="' + item.id + '" data-text="' + item.title + '"> <i class="' + options.iconItem + '"></i> ' + item.title + ' </div>';
                            }
                            main.find('.bravo-autocomplete .list-item').html(items);
                            main.find('.bravo-autocomplete').removeClass("on-message");
                        } else {
                            main.find('.bravo-autocomplete').removeClass('show');
                        }
                        return;
                    }
                    requestTimeLimit = setTimeout(function () {
                        $.ajax({
                            url: options.url,
                            data: {
                                search: query,
                            },
                            dataType: 'json',
                            type: 'get',
                            beforeSend: function () {
                            },
                            success: function (res) {
                                if (res.status === 1) {
                                    var items = '';
                                    for (var ix in res.data) {
                                        var item = res.data[ix];
                                        items += '<div class="item" data-id="' + item.id + '" data-text="' + item.title + '"> <i class="' + options.iconItem + '"></i> ' + get_highlight(item.title, query) + ' </div>';
                                    }
                                    main.find('.bravo-autocomplete .list-item').html(items);
                                    main.find('.bravo-autocomplete').removeClass("on-message");
                                }
                                if (typeof res.message === undefined) {
                                    main.find('.bravo-autocomplete').addClass("on-message");
                                } else {
                                    main.find('.bravo-autocomplete .message').html(res.message);
                                }
                            }
                        })
                    }, 700);

                    function get_highlight(text, val) {
                        return text.replace(
                            new RegExp(val + '(?!([^<]+)?>)', 'gi'),
                            '<span class="h-line">$&</span>'
                        );
                    }

                    main.find('.bravo-autocomplete').addClass('show');
                });
            }
            main.find('.bravo-autocomplete').on('click', '.item', function () {
                var id = $(this).attr('data-id'),
                    text = $(this).attr('data-text');
                if (id.length > 0 && text.length > 0) {
                    text = text.replace(/-/g, "");
                    text = trimFunc(text, ' ');
                    text = trimFunc(text, '-');
                    main.find('.parent_text').val(text).trigger("change");
                    main.find('.child_id').val(id).trigger("change");
                } else {
                    console.log("Cannot select!")
                }
                setTimeout(function () {
                    main.find('.bravo-autocomplete').removeClass('show');
                }, 100);
            });

            var trimFunc = function (s, c) {
                if (c === "]") c = "\\]";
                if (c === "\\") c = "\\\\";
                return s.replace(new RegExp(
                    "^[" + c + "]+|[" + c + "]+$", "g"
                ), "");
            }
        });
    };
});

jQuery(function ($) {
    "use strict"

    function parseErrorMessage(e) {
        var html = '';
        if (e.responseJSON) {
            if (e.responseJSON.errors) {
                return Object.values(e.responseJSON.errors).join('<br>');
            }
        }
        return html;
    }

    $(".drop-down-input .drop-down-input__item").click(
        function () {
            var valTitle = $(this).attr('data-value');
            var valId = $(this).attr('data-value-id');
            $(this).closest(".drop-down-input").find('.drop-down-input__field').val(valTitle);
            $(this).closest(".drop-down-input").find('.drop-down-input__hidden_field').val(valId);
        }
    );

    $(".drop-down-input-inner").click(
        function () {
            $('.drop-down-input__list').hide();
            $('.bravo-autocomplete').removeClass('show');
            $('.sale_price_body').hide();
            $('.guests_body').removeClass('show');
            $('.rental_price_body').hide();
            $(this).parent().find('.drop-down-input__list').show();
            $('.property_type_body').removeClass('hide');
            return false;
        }
    );

    $(".drop-down_sale_price").click(
        function () {
            $('.drop-down-input__list').hide();
            $('.bravo-autocomplete').removeClass('show');
            $(this).parent().find('.drop-down-input__list').show();
            $('.sale_price_body').removeClass('hide');
            return false;
        }
    );

    $(".drop-down_rental_price").click(
        function () {
            $('.drop-down-input__list').hide();
            $('.bravo-autocomplete').removeClass('show');
            $(this).parent().find('.drop-down-input__list').show();
            $('.sale_price_body').removeClass('hide');
            return false;
        }
    );


    $('.drop-down-input__list li').click(function () {
        $('.property_type_body').addClass('hide');
        $('.sale_price_body').addClass('hide');
        $(this).parent().hide()

    })

    $('.form-select-guests .guests').on('click', function () {
        $('.bravo-autocomplete').removeClass('show');

    })


    $("body").click(
        function () {
            $('.drop-down-input__list').hide();
        }
    );

    $(".g-map-place").each(function () {
        var map = $(this).find('.map').attr('id');
        var searchInput = $(this).find('input[name=map_place]');
        var latInput = $(this).find('input[name="map_lat"]');
        var lgnInput = $(this).find('input[name="map_lgn"]');
        new BravoMapEngine(map, {
            fitBounds: true,
            center: [51.505, -0.09],
            ready: function (engineMap) {
                engineMap.searchBox(searchInput, function (dataLatLng) {
                    latInput.attr("value", dataLatLng[0]);
                    lgnInput.attr("value", dataLatLng[1]);
                });
            }
        });

    });

    $(".bravo-box-category-tour").each(function () {
        $(this).find(".owl-carousel").owlCarousel({
            items: 4,
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        })
    });

    $(".bravo-client-feedback").each(function () {
        $(this).find(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            nav: true,
            dots: false,
        })
    });

    // Date Picker Range
    $('.main_search_wrap.default .main_search_label').click(function () {
        var main_search_wrap = $(this).closest('.main_search_wrap');
        main_search_wrap.removeClass('default').trigger('click');
        var main_search_input = main_search_wrap.find('.main_search_input');
        if (main_search_input.length > 0) {
            main_search_input.trigger('click').trigger('focus');
        }
    });

    var active_check_out = null;
    var active_check_in = null;

    $('.check-in, .check-out').click(function () {
        if ($(this).hasClass('check-out')) {
            active_check_out = $(this);
        } else {
            active_check_out = $(this).closest('.u-datepicker').find('.check-out');
        }

        if ($(this).hasClass('check-in')) {
            active_check_in = $(this);
        } else {
            active_check_in = $(this).closest('.u-datepicker').find('.check-in');
        }

        $(this).closest('.u-datepicker').find('.main_search_wrap.default').removeClass('default');
        $(this).closest('.form-date-search').find('.check-in-out').trigger('click');
    });

    $('.check-in_name, .check-out_name').click(function () {
        active_check_out = $(this).closest('.u-datepicker').find('.check-out');
        if ($(this).hasClass('.check-in_name')) {
            active_check_in = $(this);
        } else {
            active_check_in = $(this).closest('.u-datepicker').find('.check-in');
        }

        $(this).closest('.u-datepicker').find('.main_search_wrap.default').removeClass('default');
        $(this).closest('.form-date-search').find('.check-in-out').trigger('click');
    });

    var en_months = {
        'January': '01',
        'February': '02',
        'March': '03',
        'April': '04',
        'May': '05',
        'June': '06',
        'July': '07',
        'August': '08',
        'Septermber': '09',
        'October': '10',
        'November': '11',
        'December': '12'
    };

    var en_weekdays = {
        '0': 'Sun',
        '1': 'Mon',
        '2': 'Tue',
        '3': 'Wed',
        '4': 'Thu',
        '5': 'Fri',
        '6': 'Sat',
        '7': 'Sun'
    };


    $(document).on('click', '.daterangepicker .ranges', function (e) {
        $(".daterangepicker").addClass("show-calendar");
    });



    var clicked = null;
    $('.check-out, .check-out_name').click(function () {
        clicked = 'check-out';
        $(".daterangepicker").addClass("show-calendar");
    });

    $('.check-in, .check-in_name').click(function () {
        clicked = 'check-in';
        $(".daterangepicker").addClass("show-calendar");
    });


    var year_diff = new Date().getFullYear();
    var month_diff = new Date().getMonth();
    var day_diff =  new Date().getDate();
    var today = new Date(year_diff, month_diff * 1 - 1, day_diff * 1);

    $(document).on('mouseover', '.daterangepicker.show-calendar .calendar-table td', function (e) {
        $('.available').removeClass('active');
        if($(this).hasClass('available')) {
            $(this).addClass('active');
            var daterangepicker_parent = $(this).closest('.daterangepicker');
            var date = $(this).html();
            if (date.length == 1) {
                date = '0' + date;
            }
            var parent = $(this).closest('.drp-calendar');
            var month_year_arr = parent.find('th.month').html().split(' ');
            var month = '01';
            if (en_months.hasOwnProperty(month_year_arr[0])) {
                month = en_months[month_year_arr[0]];
            }
            var year = month_year_arr[1];
            var end_date = month + '/' + date + '/' + year;
            var end_date_str = year + '_' + month + '_' + date;
            var end_date_input = new Date(year, month * 1 - 1, date * 1);
            var news = end_date_input;
            end_date_input = end_date_input.toString();
            end_date_input = end_date_input.substring(0, 3) + ',' + end_date_input.substring(7, 3) + ' ' + date + ',  ' + year.substring(2);

            var start_date_str = '0000_00_00';

            var start_date_el = daterangepicker_parent.find('.start-date');
            var start_date = start_date_el.html();
            if (start_date != undefined && start_date.length == 1) {
                start_date = '0' + start_date;
            }
            var start_parent = start_date_el.closest('.drp-calendar');

            var start_month_year_arr = start_parent.find('th.month').html().split(' ');
            var start_month = '01';
            if (en_months.hasOwnProperty(start_month_year_arr[0])) {
                start_month = en_months[start_month_year_arr[0]];
            }
            var start_year = start_month_year_arr[1];
            start_date_str = start_year + '_' + start_month + '_' + start_date;

            let info = moment(start_year + '.' + start_month + '.' + start_date).toString();
            info = info.substring(0, 3) + ',' + info.substring(7, 3) + ' ' + start_date + ',  ' + start_year.substring(2);

            if (end_date_str >= start_date_str) {
                if (news.getTime() < today.getTime()) {
                    active_check_in.val(info);
                } else if (news.getTime() >= today.getTime()) {
                    if (clicked == "check-in") {
                        active_check_in.val(end_date_input);
                    } else {
                        active_check_out.val(end_date_input);
                    }

                }

                if (daterangepicker_parent.find('.end-date').length == 0) {
                    if (news.getTime() < today.getTime()) {
                        active_check_out.val(info);
                    } else if (news.getTime() >= today.getTime()) {
                        active_check_out.val(end_date_input);
                    }
                    active_check_in.val(info);

                }
            }
        }
    });

    $('.form-date-search').each(function () {
        var single_picker = false;
        if ($(this).hasClass("is_single_picker")) {
            single_picker = true;
        }
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        var parent = $(this),
            date_wrapper = $('.date-wrapper', parent),
            check_in_input = $('.check-in-input', parent),
            check_in = $('.check-in', parent),
            check_out_input = $('.check-out-input', parent),
            check_out = $('.check-out', parent),
            check_in_out = $('.check-in-out', parent),
            check_in_render = $('.check-in-render', parent),
            check_out_render = $('.check-out-render', parent);
        var options = {
            ranges: {
                'This Week': [moment().startOf('week'), moment().endOf('week')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Add 1 day': [moment().startOf('day'), moment().add('days', 1)],
                'Add 7 days': [moment().startOf('day'), moment().add('days', 7)],
                'Add 30 days': [moment().startOf('day'), moment().add('days', 30)],
            },
            alwaysShowCalendars: true,
            autoUpdateInput: true,
            singleDatePicker: single_picker,
            autoApply: true,
            disabledPast: true,
            customClass: '',
            widthSingle: 300,
            onlyShowCurrentMonth: true,
            minDate: today,
            opens: myTravel.rtl ? 'right' : 'right',
            locale: {
                format: "YYYY-MM-DD",
                direction: myTravel.rtl ? 'rtl' : 'ltr',
                firstDay: daterangepickerLocale.first_day_of_week
            }
        };

        if (typeof daterangepickerLocale == 'object') {
            options.locale = _.merge(daterangepickerLocale, options.locale);
        }
        check_in_out.daterangepicker(options,
            function (start, end, label) {
                check_in_input.val(start.format(myTravel.date_format));
                if (check_in.length > 0) {
                    var check_in_date = start.format('E, MMM DD, YY');
                    var check_in_date_arr = check_in_date.split(',');
                    check_in_date = '';
                    if (en_weekdays.hasOwnProperty(check_in_date_arr[0])) {
                        check_in_date += en_weekdays[check_in_date_arr[0]] + ',' + check_in_date_arr[1] + ', ' + check_in_date_arr[2];
                    } else {
                        check_in_date += check_in_date_arr[1] + ', ' + check_in_date_arr[2];
                    }
                    check_in.val(check_in_date);
                }
                check_in_render.html(start.format(myTravel.date_format));
                check_out_input.val(end.format(myTravel.date_format));
                if (check_out.length > 0) {
                    var check_out_date = end.format('E, MMM DD, YY');
                    var check_out_date_arr = check_out_date.split(',');
                    check_out_date = '';
                    if (en_weekdays.hasOwnProperty(check_out_date_arr[0])) {
                        check_out_date += en_weekdays[check_out_date_arr[0]] + ',' + check_out_date_arr[1] + ', ' + check_out_date_arr[2];
                    } else {
                        check_out_date += check_out_date_arr[1] + ', ' + check_out_date_arr[2];
                    }
                    check_out.val(check_out_date);
                }
                check_out_render.html(end.format(myTravel.date_format));
            }).on('hide.daterangepicker', function (ev, picker) {
            active_check_out = null;
        }).on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });
        date_wrapper.on('click', function (e) {
            check_in_out.trigger('click');
        });
    });

    // Date Picker
    $('.date-picker').each(function () {
        var options = {
            "singleDatePicker": true,
            opens: myTravel.rtl ? 'right' : 'right',
            locale: {
                format: myTravel.date_format,
                direction: myTravel.rtl ? 'rtl' : 'ltr',
                firstDay: daterangepickerLocale.first_day_of_week
            }
        };
        if (typeof daterangepickerLocale == 'object') {
            options.locale = _.merge(daterangepickerLocale, options.locale);
        }
        $(this).daterangepicker(options);
    });

    // Date Picker Range for hotel
    $('.form-date-search-hotel').each(function () {
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        var parent = $(this),
            date_wrapper = $('.date-wrapper', parent),
            check_in_input = $('.check-in-input', parent),
            check_in = $('.check-in', parent),
            check_out_input = $('.check-out-input', parent),
            check_out = $('.check-out', parent),
            check_in_out = $('.check-in-out', parent),
            check_in_render = $('.check-in-render', parent),
            check_out_render = $('.check-out-render', parent);
        var options = {
            singleDatePicker: false,
            autoApply: true,
            disabledPast: true,
            customClass: '',
            widthSingle: 300,
            onlyShowCurrentMonth: true,
            minDate: today,
            opens: myTravel.rtl ? 'right' : 'left',
            locale: {
                format: "YYYY-MM-DD",
                direction: myTravel.rtl ? 'rtl' : 'ltr',
                firstDay: daterangepickerLocale.first_day_of_week
            }
        };

        if (typeof daterangepickerLocale == 'object') {
            options.locale = _.merge(daterangepickerLocale, options.locale);
        }
        check_in_out.daterangepicker(options).on('apply.daterangepicker',
            function (ev, picker) {
                if (picker.endDate.diff(picker.startDate, 'day') <= 0) {
                    picker.endDate.add(1, 'day');
                }
                check_in_input.val(picker.startDate.format(myTravel.date_format));
                check_in_render.html(picker.startDate.format(myTravel.date_format));
                check_out_input.val(picker.endDate.format(myTravel.date_format));
                check_out_render.html(picker.endDate.format(myTravel.date_format));
                check_in_out.val(picker.startDate.format("YYYY-MM-DD") + " - " + picker.endDate.format("YYYY-MM-DD"))
            });
        date_wrapper.on('click', function (e) {
            check_in_out.trigger('click');
        });
    });

    //Login
    $('.bravo-form-login [type=submit]').on('click', function (e) {
        e.preventDefault();
        let form = $(this).closest('.bravo-form-login');
        let $wrap = form.closest('.bravo-form-login-wrap');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': form.find('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url': myTravel.routes.login,
            'data': {
                'email': form.find('input[name=email]').val(),
                'password': form.find('input[name=password]').val(),
                'remember': form.find('input[name=remember]').is(":checked") ? 1 : '',
                'g-recaptcha-response': form.find('[name=g-recaptcha-response]').val(),
                'redirect': form.find('input[name=redirect]').val()
            },
            'type': 'POST',
            beforeSend: function () {
                form.find('.error').hide();
                $wrap.find('.error').hide();
                $wrap.find('.alert').hide();
                form.find('.icon-loading').css("display", 'inline-block');
            },
            success: function (data) {
                form.find('.icon-loading').hide();
                if (data.error === true) {
                    if (data.messages !== undefined) {
                        for (var item in data.messages) {
                            var msg = data.messages[item];
                            form.find('.error-' + item).show().text(msg[0]);
                        }
                    }
                    if (data.messages.message_error !== undefined) {
                        $wrap.find('.message-error').show().html('<div class="alert alert-danger alert-block"><strong>' + data.messages.message_error[0] + '</strong></div>');
                    }
                }
                if (typeof data.redirect !== 'undefined' && data.redirect) {
                    window.location.href = data.redirect
                }
            }
        });
    })
    $('.bravo-form-register [type=submit]').on('click', function (e) {
        e.preventDefault();
        let form = $(this).closest('.bravo-form-register');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': form.find('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url': myTravel.routes.register,
            'data': {
                'email': form.find('input[name=email]').val(),
                'password': form.find('input[name=password]').val(),
                'first_name': form.find('input[name=first_name]').val(),
                'last_name': form.find('input[name=last_name]').val(),
                'phone': form.find('input[name=phone_code]').val() + form.find('input[name=phone]').val(),
                'phone_without_code': form.find('input[name=phone]').val(),
                'phone_code': form.find('input[name=phone_code]').val(),
                'phone_country': form.find('input[name=phone_country]').val(),
                'term': form.find('input[name=term]').is(":checked") ? 1 : '',
                'g-recaptcha-response': form.find('[name=g-recaptcha-response]').val(),
            },
            'type': 'POST',
            beforeSend: function () {
                form.find('.error').hide();
                form.find('.icon-loading').css("display", 'inline-block');
            },
            success: function (data) {
                form.find('.icon-loading').hide();
                if (data.error === true) {
                    if (data.messages !== undefined) {
                        for (var item in data.messages) {
                            var msg = data.messages[item];
                            form.find('.error-' + item).show().text(msg[0]);
                        }
                    }
                    if (data.messages.message_error !== undefined) {
                        form.find('.message-error').show().html('<div class="alert alert-danger">' + data.messages.message_error[0] + '</div>');
                    }
                }
                if (data.redirect !== undefined) {
                    window.location.href = data.redirect
                }
            },
            error: function (e) {
                form.find('.icon-loading').hide();
                if (typeof e.responseJSON !== "undefined" && typeof e.responseJSON.message != 'undefined') {
                    form.find('.message-error').show().html('<div class="alert alert-danger">' + e.responseJSON.message + '</div>');
                }
            }
        });
    })
    $('#register').on('show.bs.modal', function (event) {
        $('#login').modal('hide')
    })
    $('#login').on('show.bs.modal', function (event) {
        $('#register').modal('hide')
    });

    var onSubmitSubscribe = false;
    //Subscribe box
    $('.bravo-subscribe-form').on('submit', function (e) {
        e.preventDefault();

        if (onSubmitSubscribe) return;

        $(this).addClass('loading');
        var me = $(this);
        me.find('.form-mess').html('');

        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (json) {
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if (json.message) {
                    me.find('.form-mess').html('<span class="' + (json.status ? 'text-success' : 'text-danger') + '">' + json.message + '</span>');
                }

                if (json.status) {
                    me.find('input').val('');
                }

            },
            error: function (e) {
                console.log(e);
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if (parseErrorMessage(e)) {
                    me.find('.form-mess').html('<span class="text-danger">' + parseErrorMessage(e) + '</span>');
                } else if (e.responseText) {
                    me.find('.form-mess').html('<span class="text-danger">' + e.responseText + '</span>');
                }

            }
        });

        return false;
    });

    //Menu
    $(".bravo-more-menu").on('click', function () {
        $(this).trigger('bravo-trigger-menu-mobile');
    });
    $(".bravo-menu-mobile .b-close").on('click', function () {
        $(".bravo-more-menu").trigger('bravo-trigger-menu-mobile');
    });
    $(document).on("click", ".bravo-effect-bg", function () {
        $(".bravo-more-menu").trigger('bravo-trigger-menu-mobile');
    })
    $(document).on("bravo-trigger-menu-mobile", ".bravo-more-menu", function () {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $(".bravo-menu-mobile").addClass("active");
            $('body').css('overflow', 'hidden').append("<div class='bravo-effect-bg'></div>");
        } else {
            $(".bravo-menu-mobile").removeClass("active");
            $("body").css('overflow', 'initial').find(".bravo-effect-bg").remove();
        }
    });
    $(".bravo-menu-mobile .g-menu ul li .fa").on('click', function (e) {
        e.preventDefault();
        $(this).closest('li').toggleClass('active');
    });
    $(".bravo-menu-mobile").each(function () {
        var h_profile = $(this).find(".user-profile").height();
        var h1_main = $(window).height();
        $(this).find(".g-menu").css("max-height", h1_main - h_profile - 15);
    });

    $(".bravo-more-menu-user").on('click', function () {
        $(".bravo_user_profile > .container-fluid > .row > .col-md-3").addClass("active");
        $("body").css('overflow', 'hidden').append("<div class='bravo-effect-user-bg'></div>");
    });
    $(document).on("click", ".bravo-effect-user-bg,.bravo-close-menu-user", function () {
        $(".bravo_user_profile > .container-fluid > .row > .col-md-3").removeClass("active");
        $('body').css('overflow', 'initial').find(".bravo-effect-user-bg").remove();
    })

    $('.bravo-video-popup').on('click', function () {
        let video_url = $(this).data("src");
        let target = $(this).data("target");
        $(target).find(".bravo_embed_video").attr('src', video_url + "?autoplay=0&amp;modestbranding=1&amp;showinfo=0");
        $(target).on('hidden.bs.modal', function () {
            $(target).find(".bravo_embed_video").attr('src', "");
        });
    });

    var onSubmitContact = false;
    //Contact box
    $('.bravo-contact-block-form').on('submit', function (e) {
        e.preventDefault();
        if (onSubmitContact) return;
        $(this).addClass('loading');
        var me = $(this);
        me.find('.form-mess').html('');
        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (json) {
                onSubmitContact = false;
                me.removeClass('loading');
                if (json.message) {
                    me.find('.form-mess').html('<span class="' + (json.status ? 'text-success' : 'text-danger') + '">' + json.message + '</span>');
                }
                if (json.status) {
                    me.find('input').val('');
                    me.find('textarea').val('');
                }
            },
            error: function (e) {
                console.log(e);
                onSubmitContact = false;
                me.removeClass('loading');
                if (parseErrorMessage(e)) {
                    me.find('.form-mess').html('<span class="text-danger">' + parseErrorMessage(e) + '</span>');
                } else if (e.responseText) {
                    me.find('.form-mess').html('<span class="text-danger">' + e.responseText + '</span>');
                }
            }
        });
        return false;
    });

    $('.btn-submit-enquiry').on('click', function (e) {

        e.preventDefault();
        let form = $(this).closest('.enquiry_form_modal_form');

        $.ajax({
            url: myTravel.url + '/booking/addEnquiry',
            data: form.find('textarea,input,select').serialize(),
            dataType: 'json',
            type: 'post',
            beforeSend: function () {
                form.find('.message_box').html('').hide();
                form.find('.icon-loading').css("display", 'inline-block');
            },
            success: function (res) {
                if (res.errors) {
                    res.message = '';
                    for (var k in res.errors) {
                        res.message += res.errors[k].join('<br>') + '<br>';
                    }
                }
                if (res.message) {
                    if (!res.status) {
                        form.find('.message_box').append('<div class="text text-danger">' + res.message + '</div>').show();
                    } else {
                        form.find('.message_box').append('<div class="text text-success">' + res.message + '</div>').show();
                    }
                }

                form.find('.icon-loading').hide();

                if (res.status) {
                    form.find('textarea,input,select').val('');
                }

                if (typeof BravoReCaptcha != "undefined") {
                    BravoReCaptcha.reset('enquiry_form');
                }
            },
            error: function (e) {
                if (typeof BravoReCaptcha != "undefined") {
                    BravoReCaptcha.reset('enquiry_form');
                }
                form.find('.icon-loading').hide();
            }
        })
    })

    $('.review_upload_file').on('change', function () {
        var me = $(this);
        var p = $(this).closest('.review_upload_wrap');
        var lists = p.find('.review_upload_photo_list');

        me.isLoading = true;
        for (var i = 0; i < me.get(0).files.length; i++) {
            var d = new FormData();
            d.append('type', 'image');
            d.append('file', me.get(0).files[i]);
            if (!me.showErr) {
                $.ajax({
                    url: myTravel.url + '/media/private/store',
                    data: d,
                    dataType: 'json',
                    type: 'post',
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        me.val('');
                        if (res.status === 0) {
                            myTravelApp.showError(res);
                        }
                        if (res.data) {
                            var count = $(".review_upload_photo_list > .col-md-2").length;
                            if (count > 5) {
                                myTravelApp.showError('Maximum upload 6 pictures');
                            } else {
                                var div = $('<div class="col-md-2 mb-2"/>');
                                var item = $('<div class="review_upload_item"/>');
                                div.append(item);
                                var input = $("<input/>");
                                input.attr('type', 'hidden');
                                input.attr('name', me.data('name') + '[]');
                                input.val(JSON.stringify(res.data));

                                item.append(input);
                                item.css({
                                    'background-image': 'url(' + res.data.download + ')'
                                });

                                if (me.data('multiple')) {
                                    lists.append(div);
                                } else {
                                    lists.html(div);
                                }
                            }

                        }
                    },
                    error: function (e) {
                        myTravelApp.showAjaxError(e);
                        me.val('');
                    }
                })
            }

        }

        $(this).val('');
    })

    $('.review_upload_item').on('click', function (e) {
        var p = $(e.target).data('target');
        var fotorama = $(p + ' .fotorama').fotorama();

    });


    //My Travel

    // Fancybox
    if ($(".travel-fancybox").length) {
        var conf = {
            parentEl: 'html',
            baseClass: 'u-fancybox-theme',
            slideClass: 'u-fancybox-slide',
            speed: 1000,
            slideSpeedCoefficient: 1,
            infobar: false,
            fullScreen: true,
            thumbs: true,
            closeBtn: true,
            baseTpl: '<div class="fancybox-container" role="dialog" tabindex="-1">' +
                '<div class="fancybox-content">' +
                '<div class="fancybox-bg"></div>' +
                '<div class="fancybox-controls" style="position: relative; z-index: 99999;">' +
                '<div class="fancybox-infobar">' +
                '<div class="fancybox-infobar__body">' +
                '<span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span>' +
                '</div>' +
                '</div>' +
                '<div class="fancybox-toolbar">{{BUTTONS}}</div>' +
                '</div>' +
                '<div class="fancybox-slider-wrap">' +
                '<button data-fancybox-prev class="fancybox-arrow fancybox-arrow--left" title="Previous"></button>' +
                '<button data-fancybox-next class="fancybox-arrow fancybox-arrow--right" title="Next"></button>' +
                '<div class="fancybox-stage"></div>' +
                '</div>' +
                '<div class="fancybox-caption-wrap">' +
                '<div class="fancybox-caption"></div>' +
                '</div>' +
                '</div>' +
                '</div>',
            animationEffect: 'fade'
        };
        var $fancybox = $(".travel-fancybox");
        $fancybox.on('click', function () {
            var $this = $(this),
                animationDuration = $this.data('speed'),
                isGroup = $this.data('fancybox'),
                isInfinite = Boolean($this.data('is-infinite')),
                isSlideShowAutoStart = Boolean($this.data('is-slideshow-auto-start')),
                slideShowSpeed = $this.data('slideshow-speed');

            $.fancybox.defaults.animationDuration = animationDuration;

            if (isInfinite === true) {
                $.fancybox.defaults.loop = true;
            }

            if (isSlideShowAutoStart === true) {
                $.fancybox.defaults.slideShow.autoStart = true;
            } else {
                $.fancybox.defaults.slideShow.autoStart = false;
            }

            if (isGroup) {
                $.fancybox.defaults.transitionEffect = 'slide';
                $.fancybox.defaults.slideShow.speed = slideShowSpeed;
            }
        });


        $fancybox.fancybox($.extend(true, {}, conf, {
            beforeShow: function (instance, slide) {
                var $fancyModal = $(instance.$refs.container),
                    $fancyOverlay = $(instance.$refs.bg[0]),
                    $fancySlide = $(instance.current.$slide),

                    animateIn = instance.current.opts.$orig[0].dataset.animateIn,
                    animateOut = instance.current.opts.$orig[0].dataset.animateOut,
                    speed = instance.current.opts.$orig[0].dataset.speed,
                    overlayBG = instance.current.opts.$orig[0].dataset.overlayBg,
                    overlayBlurBG = instance.current.opts.$orig[0].dataset.overlayBlurBg;

                if (animateIn && $('body').hasClass('u-first-slide-init')) {
                    var $fancyPrevSlide = $(instance.slides[instance.prevPos].$slide);

                    $fancySlide.addClass('has-animation');

                    $fancyPrevSlide.addClass('animated ' + animateOut);

                    setTimeout(function () {
                        $fancySlide.addClass('animated ' + animateIn);
                    }, speed / 2);
                } else if (animateIn) {
                    var $fancyPrevSlide = $(instance.slides[instance.prevPos].$slide);

                    $fancySlide.addClass('has-animation');

                    $fancySlide.addClass('animated ' + animateIn);

                    $('body').addClass('u-first-slide-init');

                    $fancySlide.on('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function (e) {
                        $fancySlide.removeClass(animateIn);
                    });
                }

                if (speed) {
                    $fancyOverlay.css('transition-duration', speed + 'ms');
                } else {
                    $fancyOverlay.css('transition-duration', '1000ms');
                }

                if (overlayBG) {
                    $fancyOverlay.css('background-color', overlayBG);
                }

                if (overlayBlurBG) {
                    $('body').addClass('u-blur-30');
                }
            },

            beforeClose: function (instance, slide) {
                var $fancyModal = $(instance.$refs.container),
                    $fancySlide = $(instance.current.$slide),

                    animateIn = instance.current.opts.$orig[0].dataset.animateIn,
                    animateOut = instance.current.opts.$orig[0].dataset.animateOut,
                    overlayBlurBG = instance.current.opts.$orig[0].dataset.overlayBlurBg;

                if (animateOut) {
                    $fancySlide.removeClass(animateIn).addClass(animateOut);
                    $('body').removeClass('u-first-slide-init')
                }

                if (overlayBlurBG) {
                    $('body').removeClass('u-blur-30')
                }
            }
        }));
    }

    //Review
    $('.sfeedbacks_form .sspd_review .fa').each(function () {
        var list = $(this).parent(),
            listItems = list.children(),
            itemIndex = $(this).index(),
            parentItem = list.parent();
        $(this).hover(function () {
            for (var i = 0; i < listItems.length; i++) {
                if (i <= itemIndex) {
                    $(listItems[i]).addClass('hovered');
                } else {
                    break;
                }
            }
            $(this).click(function () {
                for (var i = 0; i < listItems.length; i++) {
                    if (i <= itemIndex) {
                        $(listItems[i]).addClass('selected');
                    } else {
                        $(listItems[i]).removeClass('selected');
                    }
                }
                parentItem.children('.review_stats').val(itemIndex + 1);
            });
        }, function () {
            listItems.removeClass('hovered');
        });
    });

    // Caroseo
    $(".travel-slick-carousel").each(function (i, el) {
        //Variables
        var $self = $(el),
            config = $self.config,
            collection = $self.pageCollection;
        //Actions

        var $this = $(el),
            id = $this.attr('id'),

            //Markup elements
            target = $this.data('nav-for'),
            isThumb = $this.data('is-thumbs'),
            arrowsClasses = $this.data('arrows-classes'),
            arrowLeftClasses = $this.data('arrow-left-classes'),
            arrowRightClasses = $this.data('arrow-right-classes'),
            pagiClasses = $this.data('pagi-classes'),
            pagiHelper = $this.data('pagi-helper'),
            $pagiIcons = $this.data('pagi-icons'),
            $prevMarkup = '<div class="js-prev ' + arrowsClasses + ' ' + arrowLeftClasses + '"></div>',
            $nextMarkup = '<div class="js-next ' + arrowsClasses + ' ' + arrowRightClasses + '"></div>',

            //Setters
            setSlidesToShow = $this.data('slides-show'),
            setSlidesToScroll = $this.data('slides-scroll'),
            setAutoplay = $this.data('autoplay'),
            setAnimation = $this.data('animation'),
            setEasing = $this.data('easing'),
            setFade = $this.data('fade'),
            setSpeed = $this.data('speed'),
            setSlidesRows = $this.data('rows'),
            setCenterMode = $this.data('center-mode'),
            setCenterPadding = $this.data('center-padding'),
            setPauseOnHover = $this.data('pause-hover'),
            setVariableWidth = $this.data('variable-width'),
            setInitialSlide = $this.data('initial-slide'),
            setVertical = $this.data('vertical'),
            setRtl = $this.data('rtl'),
            setInEffect = $this.data('in-effect'),
            setOutEffect = $this.data('out-effect'),
            setInfinite = $this.data('infinite'),
            setDataTitlePosition = $this.data('title-pos-inside'),
            setFocusOnSelect = $this.data('focus-on-select'),
            setLazyLoad = $this.data('lazy-load'),
            isAdaptiveHeight = $this.data('adaptive-height'),
            numberedPaging = $this.data('numbered-pagination'),
            setResponsive = JSON.parse(el.getAttribute('data-responsive'));

        if ($this.find('[data-slide-type]').length) {
            $self.videoSupport($this);
        }

        $this.on('init', function (event, slick) {
            $(slick.$slides).css('height', 'auto');

            if (isThumb && setSlidesToShow >= $(slick.$slides).length) {
                $this.addClass('slick-transform-off');
            }
        });

        $this.on('init', function (event, slick) {
            var slide = $(slick.$slides)[slick.currentSlide],
                animatedElements = $(slide).find('[data-scs-animation-in]');

            $(animatedElements).each(function () {
                var animationIn = $(this).data('scs-animation-in'),
                    animationDelay = $(this).data('scs-animation-delay'),
                    animationDuration = $(this).data('scs-animation-duration');

                $(this).css({
                    'animation-delay': animationDelay + 'ms',
                    'animation-duration': animationDuration + 'ms'
                });

                $(this).addClass('animated ' + animationIn).css('opacity', 1);
            });
        });

        if (setInEffect && setOutEffect) {
            $this.on('init', function (event, slick) {
                $(slick.$slides).addClass('single-slide');
            });
        }

        if (pagiHelper) {
            $this.on('init', function (event, slick) {
                var $pagination = $this.find('.js-pagination');

                if (!$pagination.length) return;

                $pagination.append('<span class="u-dots-helper"></span>');
            });
        }

        if (isThumb) {
            $('#' + id).on('click', '.slick-slide', function (e) {
                e.stopPropagation();

                //Variables
                var i = $(this).data('slick-index');

                if ($('#' + id).slick('slickCurrentSlide') !== i) {
                    $('#' + id).slick('slickGoTo', i);
                }
            });
        }

        $this.on('init', function (event, slider) {
            var $pagination = $this.find('.js-pagination');

            if (!$pagination.length) return;

            $($pagination[0].children[0]).addClass('slick-current');
        });

        $this.on('init', function (event, slick) {
            var slide = $(slick.$slides)[0],
                animatedElements = $(slide).find('[data-scs-animation-in]');

            $(animatedElements).each(function () {
                var animationIn = $(this).data('scs-animation-in');

                $(this).addClass('animated ' + animationIn).css('opacity', 1);
            });
        });

        if (numberedPaging) {
            $this.on('init', function (event, slick) {
                $(numberedPaging).html('<span class="u-paging__current">1</span><span class="u-paging__divider"></span><span class="u-paging__total">' + slick.slideCount + '</span>');
            });
        }

        $this.slick({
            autoplay: setAutoplay ? true : false,
            autoplaySpeed: setSpeed ? setSpeed : 3000,

            cssEase: setAnimation ? setAnimation : 'ease',
            easing: setEasing ? setEasing : 'linear',
            fade: setFade ? true : false,

            infinite: setInfinite ? true : false,
            initialSlide: setInitialSlide ? setInitialSlide - 1 : 0,
            slidesToShow: setSlidesToShow ? setSlidesToShow : 1,
            slidesToScroll: setSlidesToScroll ? setSlidesToScroll : 1,
            centerMode: setCenterMode ? true : false,
            variableWidth: setVariableWidth ? true : false,
            pauseOnHover: setPauseOnHover ? true : false,
            rows: setSlidesRows ? setSlidesRows : 1,
            vertical: setVertical ? true : false,
            verticalSwiping: setVertical ? true : false,
            rtl: setRtl ? true : false,
            centerPadding: setCenterPadding ? setCenterPadding : 0,
            focusOnSelect: setFocusOnSelect ? true : false,
            lazyLoad: setLazyLoad ? setLazyLoad : false,

            asNavFor: target ? target : false,
            prevArrow: arrowsClasses ? $prevMarkup : false,
            nextArrow: arrowsClasses ? $nextMarkup : false,
            dots: pagiClasses ? true : false,
            dotsClass: 'js-pagination ' + pagiClasses,
            adaptiveHeight: !!isAdaptiveHeight,
            customPaging: function (slider, i) {
                var title = $(slider.$slides[i]).data('title');

                if (title && $pagiIcons) {
                    return '<span>' + title + '</span>' + $pagiIcons;
                } else if ($pagiIcons) {
                    return '<span></span>' + $pagiIcons;
                } else if (title && setDataTitlePosition) {
                    return '<span>' + title + '</span>';
                } else if (title && !setDataTitlePosition) {
                    return '<span></span>' + '<strong class="u-dot-title">' + title + '</strong>';
                } else {
                    return '<span></span>';
                }
            },
            responsive: setResponsive
        });

        $this.on('beforeChange', function (event, slider, currentSlide, nextSlide) {
            var nxtSlide = $(slider.$slides)[nextSlide],
                slide = $(slider.$slides)[currentSlide],
                $pagination = $this.find('.js-pagination'),
                animatedElements = $(nxtSlide).find('[data-scs-animation-in]'),
                otherElements = $(slide).find('[data-scs-animation-in]');

            $(otherElements).each(function () {
                var animationIn = $(this).data('scs-animation-in');

                $(this).removeClass('animated ' + animationIn);
            });

            $(animatedElements).each(function () {
                $(this).css('opacity', 0);
            });

            if (!$pagination.length) return;

            if (currentSlide > nextSlide) {
                $($pagination[0].children).removeClass('slick-active-right');

                $($pagination[0].children[nextSlide]).addClass('slick-active-right');
            } else {
                $($pagination[0].children).removeClass('slick-active-right');
            }

            $($pagination[0].children).removeClass('slick-current');

            setTimeout(function () {
                $($pagination[0].children[nextSlide]).addClass('slick-current');
            }, .25);
        });

        if (numberedPaging) {
            $this.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                var i = (nextSlide ? nextSlide : 0) + 1;

                $(numberedPaging).html('<span class="u-paging__current">' + i + '</span><span class="u-paging__divider"></span><span class="u-paging__total">' + slick.slideCount + '</span>');
            });
        }

        $this.on('afterChange', function (event, slick, currentSlide) {
            var slide = $(slick.$slides)[currentSlide],
                animatedElements = $(slide).find('[data-scs-animation-in]');

            $(animatedElements).each(function () {
                var animationIn = $(this).data('scs-animation-in'),
                    animationDelay = $(this).data('scs-animation-delay'),
                    animationDuration = $(this).data('scs-animation-duration');

                $(this).css({
                    'animation-delay': animationDelay + 'ms',
                    'animation-duration': animationDuration + 'ms'
                });

                $(this).addClass('animated ' + animationIn).css('opacity', 1);
            });
        });

        if (setInEffect && setOutEffect) {
            $this.on('afterChange', function (event, slick, currentSlide, nextSlide) {
                $(slick.$slides).removeClass('animated set-position ' + setInEffect + ' ' + setOutEffect);
            });

            $this.on('beforeChange', function (event, slick, currentSlide) {
                $(slick.$slides[currentSlide]).addClass('animated ' + setOutEffect);
            });

            $this.on('setPosition', function (event, slick) {
                $(slick.$slides[slick.currentSlide]).addClass('animated set-position ' + setInEffect);
            });
        }

    });

    $('[data-toggle="tooltip"]').tooltip();

    $('.dropdown-toggle').dropdown();

    $('.select-guests-dropdown .btn-minus').on('click', function (e) {
        e.stopPropagation();
        var parent = $(this).closest('.form-select-guests');
        var input = parent.find('.select-guests-dropdown [name=' + $(this).data('input') + ']');
        var min = parseInt(input.attr('min'));
        var old = parseInt(input.val());

        if (old <= min) {
            return;
        }
        input.val(old - 1);
        updateGuestCountText(parent);
    });

    $('.select-guests-dropdown .btn-add').on('click', function (e) {
        e.stopPropagation();
        var parent = $(this).closest('.form-select-guests');
        var input = parent.find('.select-guests-dropdown [name=' + $(this).data('input') + ']');
        var max = parseInt(input.attr('max'));
        var old = parseInt(input.val());

        if (old >= max) {
            return;
        }
        input.val(old + 1);
        updateGuestCountText(parent);
    });

    $('.select-guests-dropdown input').on('keyup', function (e) {
        var parent = $(this).closest('.form-select-guests');
        updateGuestCountText(parent);
    });
    $('.select-guests-dropdown input').on('change', function (e) {
        var parent = $(this).closest('.form-select-guests');
        updateGuestCountText(parent);
    });

    function updateGuestCountText(parent) {
        var adults = parseInt(parent.find('[name=adults]').val());
        var children = parseInt(parent.find('[name=children]').val());
        parent.find('.render').removeClass('d-none');
        parent.find('.show-block').removeClass('d-block');
        var adultsHtml = parent.find('.render .adults .multi').data('html');
        parent.find('.render .adults .multi').html(adultsHtml.replace(':count', adults));

        var childrenHtml = parent.find('.render .children .multi').data('html');
        parent.find('.render .children .multi').html(childrenHtml.replace(':count', children));
        if (adults > 1) {
            parent.find('.render .adults .multi').removeClass('d-none');
            parent.find('.render .adults .one').addClass('d-none');
        } else {
            parent.find('.render .adults .multi').addClass('d-none');
            parent.find('.render .adults .one').removeClass('d-none');
        }

        if (children > 1) {
            parent.find('.render .children .multi').removeClass('d-none');
            parent.find('.render .children .one').addClass('d-none');
        } else {
            parent.find('.render .children .multi').addClass('d-none');
            parent.find('.render .children .one').removeClass('d-none').html(parent.find('.render .children .one').data('html').replace(':count', children));
        }

    }

    $('.select-guests-dropdown .dropdown-item-row').on('click', function (e) {
        e.stopPropagation();
    });


    //Flight

    $('.custom-select-dropdown .btn-minus').on('click', function (e) {
        e.stopPropagation();
        var parent = $(this).closest('.custom-select-dropdown-parent');
        var inputAttr = $(this).data('input-attr');
        if (typeof inputAttr == 'undefined') {
            inputAttr = 'name';
        }
        var input = parent.find('.custom-select-dropdown [' + inputAttr + '=' + $(this).data('input') + ']');
        var min = parseInt(input.attr('min'));
        var old = parseInt(input.val());

        if (old <= min) {
            return;
        }
        input.val(old - 1);
        updateCustomSelectDropdown(input);
    });

    $('.custom-select-dropdown .btn-add').on('click', function (e) {
        e.stopPropagation();
        var parent = $(this).closest('.custom-select-dropdown-parent');
        var inputAttr = $(this).data('input-attr');

        if (typeof inputAttr == 'undefined') {
            inputAttr = 'name';
        }
        var input = parent.find('.custom-select-dropdown [' + inputAttr + '=' + $(this).data('input') + ']');
        var max = parseInt(input.attr('max'));
        var old = parseInt(input.val());

        if (old >= max) {
            return;
        }
        input.val(old + 1);
        updateCustomSelectDropdown(input);

    });
    $('.custom-select-dropdown input').on('keyup', function (e) {
        updateCustomSelectDropdown($(this));
    });
    $('.custom-select-dropdown input').on('change', function (e) {
        updateCustomSelectDropdown($(this));
    });

    function updateCustomSelectDropdown(input) {
        var parent = input.closest('.custom-select-dropdown-parent');
        var target = input.attr('id');
        var number = parseInt(input.val());
        var render = parent.find('[id=' + target + '_render]')
        parent.find('.render').removeClass('d-none');
        parent.find('.show-block').removeClass('d-block');
        var htmlString = render.find('.multi').data('html');
        var min = input.attr('min')
        console.log(
            render
        )
        if (number > min) {
            render.find('.multi').removeClass('d-none').html(htmlString.replace(':count', number));
            render.find('.one').addClass('d-none');
        } else {
            render.find('.multi').addClass('d-none');
            render.find('.one').removeClass('d-none');
        }
    }

    $('.custom-select-dropdown .dropdown-item-row').on('click', function (e) {
        e.stopPropagation();
    });


    $(".smart-search .smart-search-location").each(function () {
        var $this = $(this);
        var string_list = $this.attr('data-default');
        var default_list = [];
        if (string_list.length > 0) {
            default_list = JSON.parse(string_list);
        }
        var options = {
            url: myTravel.url + '/location/search/searchForSelect2',
            dataDefault: default_list,
            textLoading: $this.attr("data-onLoad"),
            iconItem: "icofont-location-pin",
        };
        $this.bravoAutocomplete(options);
    });

    $(".smart-search .smart-select").each(function () {
        var $this = $(this);
        var string_list = $this.attr('data-default');
        var default_list = [];
        if (string_list.length > 0) {
            default_list = JSON.parse(string_list);
        }
        var options = {
            dataDefault: default_list,
            iconItem: "",
            textLoading: $this.attr("data-onLoad"),
        };
        $this.bravoAutocomplete(options);
    });

    $(document).on("click", ".service-wishlist", function () {
        var $this = $(this);
        $.ajax({
            url: myTravel.url + '/user/wishlist',
            data: {
                object_id: $this.attr("data-id"),
                object_model: $this.attr("data-type"),
            },
            dataType: 'json',
            type: 'POST',
            beforeSend: function () {
                $this.addClass("loading");
            },
            success: function (res) {
                $($this).removeClass("active");
                $this.removeClass("loading");
                $this.addClass(res.class);
            },
            error: function (e) {
                if (e.status === 401) {
                    $('#login').modal('show');
                }
            }
        })
    });

    //Video Play

    if ($(".travel-inline-video-player").length) {
        $(".travel-inline-video-player").each(function (i, el) {
            var $this = $(el),
                parent = $this.data('parent'),
                target = $this.data('target'),
                SRC = $this.data('video-id'),
                videoType = $this.data('video-type'),
                classes = $this.data('classes'),
                isAutoPlay = Boolean($this.data('is-autoplay'));

            if (videoType !== 'vimeo') {
                youTubeAPIReady();
            }
            $this.on('click', function (e) {
                e.preventDefault();
                $('#' + parent).toggleClass(classes);
                if (videoType === 'vimeo') {
                    vimeoPlayer(target, SRC, isAutoPlay);

                } else {
                    youTubePlayer(target, SRC, isAutoPlay);
                }
            });
        });

        function youTubeAPIReady() {
            var YTScriptTag = document.createElement('script');
            YTScriptTag.src = '//www.youtube.com/player_api';

            var DOMfirstScriptTag = document.getElementsByTagName('script')[0];
            DOMfirstScriptTag
                .parentNode
                .insertBefore(YTScriptTag, DOMfirstScriptTag);
        }

        function youTubePlayer(target, src, autoplay) {
            var YTPlayer = new YT.Player(target, {
                videoId: src,
                playerVars: {
                    origin: window.location.origin,
                    autoplay: autoplay === true ? 1 : 0
                }
            });
        }

        function vimeoPlayer(target, src, autoplay) {
            var vimeoIframe = document.getElementById(target),
                vimeoPlayer = new Vimeo.Player(vimeoIframe, {
                    id: src,
                    autoplay: autoplay === true ? 1 : 0
                });
        }
    }
    ;

//    modal

    $('.travel-go-to').each(function (i, el) {
        var $this = $(el),
            $target = $this.data('target'),
            isReferencedToPage = Boolean($this.data('is-referenced-to-page')),
            type = $this.data('type'),
            showEffect = $this.data('show-effect'),
            hideEffect = $this.data('hide-effect'),
            position = JSON.parse(el.getAttribute('data-position')),
            compensation = $($this.data('compensation')).outerHeight(),
            offsetTop = $this.data('offset-top'),
            targetOffsetTop = function () {
                if (compensation) {
                    return $target ? $($target).offset().top - compensation : 0;
                } else {
                    return $target ? $($target).offset().top : 0;
                }
            };
        if (type === 'static') {
            $this.css({
                'display': 'inline-block'
            });
        } else {
            $this.addClass('animated').css({
                'display': 'inline-block',
                'position': type,
                'opacity': 0
            });
        }
        if (type === 'fixed' || type === 'absolute') {
            $this.css(position);
        }
        $this.on('click', function (e) {
            if (!isReferencedToPage) {
                e.preventDefault();

                $('html, body').stop().animate({
                    'scrollTop': targetOffsetTop()
                }, 800);
            }
        });
        if (!$this.data('offset-top') && !$this.hasClass('js-animation-was-fired') && type !== 'static') {
            if ($this.offset().top <= $(window).height()) {
                $this.show();

                setTimeout(function () {
                    $this.addClass('js-animation-was-fired ' + showEffect).css({
                        'opacity': ''
                    });
                });
            }
        }
        if (type !== 'static') {
            $(window).on('scroll', function () {
                clearTimeout($.data(this, 'scrollTimer'));
                if ($this.data('offset-top')) {
                    if ($(window).scrollTop() >= offsetTop && !$this.hasClass('js-animation-was-fired')) {
                        $this.show();

                        setTimeout(function () {
                            $this.addClass('js-animation-was-fired ' + showEffect).css({
                                'opacity': ''
                            });
                        });
                    } else if ($(window).scrollTop() <= offsetTop && $this.hasClass('js-animation-was-fired')) {
                        $.data(this, 'scrollTimer', setTimeout(function () {

                            $this.removeClass('js-animation-was-fired ' + showEffect);

                            setTimeout(function () {
                                $this.addClass(hideEffect).css({
                                    'opacity': 0
                                });
                            }, 100);

                            setTimeout(function () {
                                $this.removeClass(hideEffect).hide();
                            }, 400);

                        }, 500));
                    }
                } else {
                    var thisOffsetTop = $this.offset().top;

                    if (!$this.hasClass('js-animation-was-fired')) {
                        if ($(window).scrollTop() >= thisOffsetTop - $(window).height()) {
                            $this.show();

                            setTimeout(function () {
                                $this.addClass('js-animation-was-fired ' + showEffect).css({
                                    'opacity': ''
                                });
                            });
                        }
                    }
                }
            });
            $(window).trigger('scroll');
        }
    });

});

jQuery(function ($) {
    "use strict"
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('.notification-icon');
    var notificationsCount = parseInt(notificationsCountElem.html());
    var notifications = notificationsWrapper.find('ul.dropdown-list-items');

    if (myTravel.pusher_api_key && myTravel.pusher_cluster) {
        var pusher = new Pusher(myTravel.pusher_api_key, {
            encrypted: true,
            cluster: myTravel.pusher_cluster
        });
    }

    $(document).on("click", ".markAsRead", function (e) {
        e.stopPropagation();
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).attr('href');
        $.ajax({
            url: myTravel.markAsRead,
            data: {'id': id},
            method: "post",
            success: function (res) {
                window.location.href = url;
            }
        })
    });
    $(document).on("click", ".markAllAsRead", function (e) {
        e.stopPropagation();
        e.preventDefault();
        $.ajax({
            url: myTravel.markAllAsRead,
            method: "post",
            success: function (res) {
                $('.dropdown-notifications').find('li.notification').removeClass('active');
                notificationsCountElem.text(0);
                notificationsWrapper.find('.notif-count').text(0);
            }
        })
    });

    var callback = function (data) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = '<li class="notification active">'
            + '<div class="media">'
            + '    <div class="media-left">'
            + '      <div class="media-object">'
            + data.avatar
            + '      </div>'
            + '    </div>'
            + '    <div class="media-body">'
            + '      <a class="markAsRead p-0" data-id="' + data.idNotification + '" href="' + data.link + '">' + data.message + '</a>'
            + '      <div class="notification-meta">'
            + '        <small class="timestamp">about a few seconds ago</small>'
            + '      </div>'
            + '    </div>'
            + '  </div>'
            + '</li>';
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.text(notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
    };

    if (myTravel.isAdmin > 0 && myTravel.pusher_api_key) {
        var channel = pusher.subscribe('admin-channel');
        channel.bind('App\\Events\\PusherNotificationAdminEvent', callback);
    }

    if (myTravel.currentUser > 0 && myTravel.pusher_api_key) {
        var channelPrivate = pusher.subscribe('user-channel-' + myTravel.currentUser);
        channelPrivate.bind('App\\Events\\PusherNotificationPrivateEvent', callback);
    }

    $('#hotel_search_button').click(function (e) {
        e.preventDefault();
        var data_empty = 0;

        if ($(this).closest('form').find('.u-datepicker .main_search_wrap.default').length > 0) {
            data_empty = 1;
        }

        var data = new FormData(document.forms.hotel_search_form);

        var $autocomplete = $(this).closest('form').find('input[name=location]');
        if(!$autocomplete.attr('data-latest-search') || ($autocomplete.attr('data-latest-search') != $autocomplete.val() && $autocomplete.attr('data-latest-search-val') != $autocomplete.val())) {
            data.delete('postal_code');
            data.delete('state');
            data.delete('city');
            data.delete('district');
            data.delete('street');
        }
        if( !(!data.get('postal_code') && !data.get('state') && !data.get('city') && !data.get('district') && !data.get('street')) ) {
            data.delete('location');
        }
        
        if (data_empty == 1) {
            data.set('date', '');
            data.set('start', '');
            data.set('end', '');
        }

        if(data.get('deal_type')) {
            var link = data.get('deal_type');
            data.delete('deal_type');
        } else {
            var link = $(this).closest('form').attr('action');
        }
        var query_string = new URLSearchParams(data).toString();
        if (query_string != '') {
            link += '?' + query_string;
        }

        location.href = link;
    });

    $('#space_search_button').click(function (e) {
        e.preventDefault();
        var data_empty = 0;

        if ($(this).closest('form').find('.u-datepicker .main_search_wrap.default').length > 0) {
            data_empty = 1;
        }

        var data = new FormData(document.forms.space_search_form);

        var $autocomplete = $(this).closest('form').find('input[name=location]');
        if(!$autocomplete.attr('data-latest-search') || ($autocomplete.attr('data-latest-search') != $autocomplete.val() && $autocomplete.attr('data-latest-search-val') != $autocomplete.val())) {
            data.delete('postal_code');
            data.delete('state');
            data.delete('city');
            data.delete('district');
            data.delete('street');
        }
        if( !(!data.get('postal_code') && !data.get('state') && !data.get('city') && !data.get('district') && !data.get('street')) ) {
            data.delete('location');
        }

        if (data_empty == 1) {
            data.set('date', '');
            data.set('start', '');
            data.set('end', '');
        }

        if(data.get('deal_type')) {
            var link = data.get('deal_type');
            data.delete('deal_type');
        } else {
            var link = $(this).closest('form').attr('action');
        }
        var query_string = new URLSearchParams(data).toString();
        if (query_string != '') {
            link += '?' + query_string;
        }

        location.href = link;
    });

    $('#rental_search_button').click(function (e) {
        e.preventDefault();
        var data_empty = 0;

        if ($(this).closest('form').find('.u-datepicker .main_search_wrap.default').length > 0) {
            data_empty = 1;
        }

        var data = new FormData(document.forms.rental_search_form);

        var $autocomplete = $(this).closest('form').find('input[name=location]');
        if(!$autocomplete.attr('data-latest-search') || ($autocomplete.attr('data-latest-search') != $autocomplete.val() && $autocomplete.attr('data-latest-search-val') != $autocomplete.val())) {
            data.delete('postal_code');
            data.delete('state');
            data.delete('city');
            data.delete('district');
            data.delete('street');
        }
        if( !(!data.get('postal_code') && !data.get('state') && !data.get('city') && !data.get('district') && !data.get('street')) ) {
            data.delete('location');
        }
        
        if (data_empty == 1) {
            data.set('date', '');
            data.set('start', '');
            data.set('end', '');
        }

        if(data.get('deal_type')) {
            var link = data.get('deal_type');
            data.delete('deal_type');
        } else {
            var link = $(this).closest('form').attr('action');
        }
        var query_string = new URLSearchParams(data).toString();
        if (query_string != '') {
            link += '?' + query_string;
        }

        location.href = link;
    });



    $('#sale_search_button').click(function (e) {
        e.preventDefault();
        var data_empty = 0;

        if ($(this).closest('form').find('.u-datepicker .main_search_wrap.default').length > 0) {
            data_empty = 1;
        }

        var data = new FormData(document.forms.sale_search_form);
        
        var $autocomplete = $(this).closest('form').find('input[name=location]');
        if(!$autocomplete.attr('data-latest-search') || ($autocomplete.attr('data-latest-search') != $autocomplete.val() && $autocomplete.attr('data-latest-search-val') != $autocomplete.val())) {
            data.delete('postal_code');
            data.delete('state');
            data.delete('city');
            data.delete('district');
            data.delete('street');
        }
        if( !(!data.get('postal_code') && !data.get('state') && !data.get('city') && !data.get('district') && !data.get('street')) ) {
            data.delete('location');
        }
        
        
        if (data_empty == 1) {
            data.set('date', '');
            data.set('start', '');
            data.set('end', '');
        }

        if(data.get('deal_type')) {
            var link = data.get('deal_type');
            data.delete('deal_type');
        } else {
            var link = $(this).closest('form').attr('action');
        }
        var query_string = new URLSearchParams(data).toString();
        if (query_string != '') {
            link += '?' + query_string;
        }
        
        location.href = link;
    });



    $('#tour_search_button').click(function (e) {
        e.preventDefault();
        var data_empty = 0;

        if ($(this).closest('form').find('.u-datepicker .main_search_wrap.default').length > 0) {
            data_empty = 1;
        }

        var data = new FormData(document.forms.tour_search_form);

        if (data_empty == 1) {
            data.set('date', '');
            data.set('start', '');
            data.set('end', '');
        }

        var query_string = new URLSearchParams(data).toString();
        var link = $(this).closest('form').attr('action');
        if (query_string != '') {
            link += '?' + query_string;
        }

        location.href = link;
    });


    let href = window.location.href;
    if (href.includes('hotel') || href.includes('space') || href.includes('sale') || href.includes('rental')) {
        $("input").removeClass('scroll_body');
        $("div").removeClass('scroll_body');
        $("span").removeClass('scroll_body');
    }

    $(".scroll_body").on('click', function () {
        $('body,html').animate({
            scrollTop: 320
        }, 700);
    });

    $(document).ready(function () {
        $("#latitudeArea").addClass("d-none");
        $("#longtitudeArea").addClass("d-none");



    });

    const center = { lat: 50.064192, lng: -130.605469 };
    const defaultBounds = {
        north: center.lat + 0.1,
        south: center.lat - 0.1,
        east: center.lng + 0.1,
        west: center.lng - 0.1,
    };
    const options = {
        bounds: defaultBounds,
        types: ['(cities)'],
        componentRestrictions: { country: ["es", "us"]},
        fields: ["name"],
        strictBounds: false,
    };

    $(".autocomplete").on('input', function () {
        $(".main_search_close").css("display", "block");
    });

    $(".main_search_close").on('click', function () {
        $(".autocomplete").val('');
        $(this).css("display", "none")
    });

    $('.tabtext').on('click', function () {
        $(".autocomplete").val('');
        $(".main_search_close").css("display", "none");
    });

    function initialize() {
        var acInputs = document.getElementsByClassName("autocomplete");
        for (var i = 0; i < acInputs.length; i++) {
            frontendSeachBox(acInputs[i]);
        }
        
        
        function setFields(addr_components, $wrap) {
            console.log(addr_components);
            var fields_data = {
                postal_code: '',
                state: '',
                city: '',
                district: '',
                street: '',
            };
            var city_field_v1 = '';
            var city_field_v2 = '';
            var city_field_v3 = '';
            for(var addr_component of addr_components) {
                if(addr_component.types.includes('postal_code')) {
                    fields_data['postal_code'] = addr_component.long_name;
                }
                if(addr_component.types.includes('administrative_area_level_1')) {
                    fields_data['state'] = addr_component.long_name;
                }
                if(addr_component.types.includes('locality')) {
                    city_field_v1 = addr_component.long_name;
                }
                if(addr_component.types.includes('administrative_area_level_3')) {
                    city_field_v2 = addr_component.long_name;
                }
                if(addr_component.types.includes('neighborhood')) {
                    city_field_v3 = addr_component.long_name;
                }
                if(addr_component.types.includes('administrative_area_level_2')) {
                    fields_data['district'] = addr_component.long_name;
                }
                if(addr_component.types.includes('route')) {
                    fields_data['street'] = addr_component.long_name;
                }
            }
            if(city_field_v1) {
                fields_data['city'] = city_field_v1;
            } else if(city_field_v2) {
                fields_data['city'] = city_field_v2;
            } else {
                fields_data['city'] = city_field_v3;
            }
            $wrap.find("input[name=postal_code]").val(fields_data['postal_code']);
            $wrap.find("input[name=state]").val(fields_data['state']);
            $wrap.find("input[name=city]").val(fields_data['city']);
            $wrap.find("input[name=district]").val(fields_data['district']);
            $wrap.find("input[name=street]").val(fields_data['street']);
            
            var query_autocomplete = '';
            var autocomplete_items = [];
            if(fields_data['postal_code']) {
                autocomplete_items.push(fields_data['postal_code']);
            }
            if(fields_data['state']) {
                autocomplete_items.push(fields_data['state']);
            }
            if(fields_data['city']) {
                autocomplete_items.push(fields_data['city']);
            }
            if(fields_data['district']) {
                autocomplete_items.push(fields_data['district']);
            }
            if(fields_data['street']) {
                autocomplete_items.push(fields_data['street']);
            }
            if(autocomplete_items) {
                query_autocomplete = autocomplete_items.join(', ');
            }
            $wrap.find("input[name=location]").attr('data-latest-search', query_autocomplete);
        }
        function frontendSeachBox(el) {
            var searchBox = new google.maps.places.Autocomplete(el, {
                //types: ['address'],
                componentRestrictions: { country: ["us"]},
            });
            google.maps.event.addListener(searchBox, 'place_changed', function() {
                var place = searchBox.getPlace();
                console.log({
                    place: place
                });
                if (!place || place.length == 0) {
                    return;
                }
                $(el).attr('data-latest-search-val', $(el).val());
                var $wrap = $(el).closest('.main_search_wrap');
                $wrap.find('input[name=autocomplete_formatted]').val(place.formatted_address);
                setFields(place.address_components, $wrap);
            });
        }
        function frontendSeachBox_old(el) {
            var searchBox = new google.maps.places.SearchBox(el);
            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                console.log({
                    1: 'places', 2:places
                });
                for (var i = 0, place ; place = places[i]; i++) {
                    var $wrap = $(el).closest('.main_search_wrap');
                    $wrap.find('input[name=autocomplete_formatted]').val(place.formatted_address);
                    setFields(place.address_components, $wrap);
                }
            });
        }
    }

    initialize();

    $(function () {

        // overlay for smoother fullscreen enter
        var $overlay = $('<div class="fotorama-overlay"></div>')
            .css({position: 'fixed', top: 0, right: 0, bottom: 0, left: 0, zIndex: 10001})
            .fadeTo(0, 0)
            .hide()
            .appendTo('body');

        // take all .fotorama blocks
        $('.images__thumbs').each(function () {
            var $thumbs = $(this),

                // clone it and make fotorama
                $fotorama = $('.images__fotorama', $thumbs)
                    .clone()
                    //.show()
                    .css({position: 'absolute', left: -99999, top: -99999})
                    .appendTo('body')
                    .fadeTo(0, 0)
                    .fotorama(),
                fotorama = $fotorama.data('fotorama');

            for (var _i = 0, _l = fotorama.data.length; _i < _l; _i++) {
                // prepare id to use in fotorama.show()
                fotorama.data[_i].id = fotorama.data[_i].img;
            }

            // bind clicks
            $thumbs.on('click', 'a', function (e) {
                e.preventDefault();

                var $this = $(this);

                $overlay
                    .show()
                    .stop()
                    .fadeTo(150, 1, function () {
                        $fotorama.stop().fadeTo(150, 1);

                        // API calls
                        fotorama
                            // show needed frame
                            .show({index: $this.attr('href'), time: 0})
                            // open fullscreen
                            .requestFullScreen();
                    });
            });

            $fotorama.on('fotorama:fullscreenexit', function () {
                $fotorama.stop().fadeTo(0, 0);
                $overlay.stop().fadeTo(300, 0, function () {
                    $overlay.hide();
                });
            });
        });

    });


    var interval;
    $ ( "#bravo_results_map" ).on ( "click" , function () {
      interval = setInterval(function() {
            if ($('div').hasClass('product-item__slider-maps') ){
                $('.product-item__slider-maps').slick({
                    dots: true,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                });
            }
        }, 10);
        setTimeout(function() {  clearInterval(interval); }, 100);

    } );

    $ ( ".bravo_search_map--full" ).on ( "click" , function () {
        var $this = $(this);
        $this.toggleClass("active");
        if (  $this.hasClass("active")){
            $this.parent('.results_map').addClass("w-100")
            $this.parent('.results_map').siblings(".results_item").addClass("d-none")
        } else{
            $this.parent('.results_map').removeClass("w-100")
            $this.parent('.results_map').siblings(".results_item").removeClass("d-none")
        }

    } );
    function selectCountryForPhone(countryCode) {
        if($('#register_phone_country') && $('#register_phone_country').val()) {
            var initial_country = $('#register_phone_country').val();
        } else {
            var initial_country = countryCode;
        }
        if($('input[name="phone_code"]') && $('input[name="phone_code"]').val()) {
            var initial_code = $('input[name="phone_code"]').val();
        } else {
            var initial_code = '1';
        }
        var phoneInputID = '#register_phone_code';
        var input = document.querySelector(phoneInputID);
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            formatOnDisplay: true,
            hiddenInput: "full_phone",
            preferredCountries: [initial_country],
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"
        });
        $('#register_phone_code').val(initial_code);
        $('#register_hidden_phone_code').val(initial_code);
        $('#register_phone_country').val(initial_country);
        $(phoneInputID).on("countrychange", function(event) {
            var selectedCountryData = iti.getSelectedCountryData();
            
            $('#register_phone_code').val(selectedCountryData.dialCode);
            $('#register_hidden_phone_code').val(selectedCountryData.dialCode);
            $('#register_phone_country').val(selectedCountryData.iso2);
        });
        $(phoneInputID).trigger('countrychange');
        $(phoneInputID).on("open:countrydropdown", function(event) {
            var $list = $(phoneInputID).closest('.iti').find('.iti__country-list');
            if(!$list.find('input[name="search_country"]').length) {
                var $search_group = $(
                    '<div class="form-group">'
                        +'<input type="text" name="search_country" placeholder="Country Search" autocomplete="off" class="form-control">'
                        +'<i class="input-icon field-icon icofont-search-2"></i>'
                    +'</div>'
                ).prependTo($list);
                var $search = $search_group.find('input');
                $search.on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
                $search.on('keyup', function(e) {
                    e.stopPropagation();
                    var str = $(this).val().toLowerCase();
                    $list.find('.iti__country').each(function (index, el) {
                        var $el = $(el);
                        if(!str) {
                            $el.show();
                        } else {
                            var found_by_name = $el.find('.iti__country-name').text().toLowerCase().indexOf(str);
                            var found_by_code = $el.find('.iti__dial-code').text().toLowerCase().indexOf(str);
                            if(found_by_name == -1 && found_by_code == -1) {
                                $el.hide();
                            } else {
                                $el.show();
                            }
                        }
                    });
                });
                $search.on('keydown', function(e) {
                    e.stopPropagation();
                });
            }
        });
    }
    function selectVendorCountryForPhone(countryCode) {
        var initial_country = countryCode;
        var phoneInputID = '#vendor_register_phone_code';
        var input = document.querySelector(phoneInputID);
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            formatOnDisplay: true,
            hiddenInput: "vendor_full_phone",
            preferredCountries: [initial_country],
            //utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"
        });
        $('#vendor_register_phone_country').val(initial_country);
        $(phoneInputID).on("countrychange", function(event) {
            var selectedCountryData = iti.getSelectedCountryData();
            $('#vendor_register_phone_code').val(selectedCountryData.dialCode);
            $('#vendor_register_phone_country').val(selectedCountryData.iso2);
        });
        $(phoneInputID).trigger('countrychange');
        $(phoneInputID).on("open:countrydropdown", function(event) {
            var $list = $(phoneInputID).closest('.iti').find('.iti__country-list');
            if(!$list.find('input[name="search_country"]').length) {
                var $search_group = $(
                    '<div class="form-group">'
                        +'<input type="text" name="search_country" placeholder="Country Search" autocomplete="off" class="form-control">'
                        +'<i class="input-icon field-icon icofont-search-2"></i>'
                    +'</div>'
                ).prependTo($list);
                var $search = $search_group.find('input');
                $search.on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
                $search.on('keyup', function(e) {
                    e.stopPropagation();
                    var str = $(this).val().toLowerCase();
                    $list.find('.iti__country').each(function (index, el) {
                        var $el = $(el);
                        if(!str) {
                            $el.show();
                        } else {
                            var found_by_name = $el.find('.iti__country-name').text().toLowerCase().indexOf(str);
                            var found_by_code = $el.find('.iti__dial-code').text().toLowerCase().indexOf(str);
                            if(found_by_name == -1 && found_by_code == -1) {
                                $el.hide();
                            } else {
                                $el.show();
                            }
                        }
                    });
                });
                $search.on('keydown', function(e) {
                    e.stopPropagation();
                });
            }
        });
    }
    function selectBookingCountryForPhone(countryCode) {
        console.log($('#booking_phone_country').val());
        if($('#booking_phone_country') && $('#booking_phone_country').val()) {
            var initial_country = $('#booking_phone_country').val();
        } else {
            var initial_country = countryCode;
        }
        if($('input[name="phone_code"]') && $('input[name="phone_code"]').val()) {
            var initial_code = $('input[name="phone_code"]').val();
        } else {
            var initial_code = '1';
        }
        var phoneInputID = '#booking_phone_code';
        var input = document.querySelector(phoneInputID);
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            formatOnDisplay: true,
            hiddenInput: "full_phone",
            preferredCountries: [initial_country],
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"
        });
        console.log(initial_country);
        $('#booking_phone_code').val(initial_code);
        $('#booking_phone_country').val(initial_country);
        $(phoneInputID).on("countrychange", function(event) {
            var selectedCountryData = iti.getSelectedCountryData();
            console.log(selectedCountryData);
            $('#booking_phone_code').val(selectedCountryData.dialCode);
            $('#booking_phone_country').val(selectedCountryData.iso2);
        });
        $(phoneInputID).trigger('countrychange');
        $(phoneInputID).on("open:countrydropdown", function(event) {
            var $list = $(phoneInputID).closest('.iti').find('.iti__country-list');
            if(!$list.find('input[name="search_country"]').length) {
                var $search_group = $(
                    '<div class="form-group">'
                        +'<input type="text" name="search_country" placeholder="Country Search" autocomplete="off" class="form-control">'
                        +'<i class="input-icon field-icon icofont-search-2"></i>'
                    +'</div>'
                ).prependTo($list);
                var $search = $search_group.find('input');
                $search.on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
                $search.on('keyup', function(e) {
                    e.stopPropagation();
                    var str = $(this).val().toLowerCase();
                    $list.find('.iti__country').each(function (index, el) {
                        var $el = $(el);
                        if(!str) {
                            $el.show();
                        } else {
                            var found_by_name = $el.find('.iti__country-name').text().toLowerCase().indexOf(str);
                            var found_by_code = $el.find('.iti__dial-code').text().toLowerCase().indexOf(str);
                            if(found_by_name == -1 && found_by_code == -1) {
                                $el.hide();
                            } else {
                                $el.show();
                            }
                        }
                    });
                });
                $search.on('keydown', function(e) {
                    e.stopPropagation();
                });
            }
        });
    }
    function getUserCountryByIP() {
        if($('#register_phone_code').length || $('#vendor_register_phone_code').length || $('#booking_phone_code').length) {
            $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country.toLowerCase() : "us";
                if($('#register_phone_code').length) {
                    selectCountryForPhone(countryCode);
                }
                if($('#vendor_register_phone_code').length) {
                    selectVendorCountryForPhone(countryCode);
                }
                if($('#booking_phone_code').length) {
                    selectBookingCountryForPhone(countryCode);
                }

            });
        }
    }
    getUserCountryByIP();
});




