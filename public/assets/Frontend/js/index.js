$(document).ready(function() {

    $('.lawyer,.male,.female,.client').click(function() {
        $(this).toggleClass('class-selct');
    });



    $('.menu').click(function() {
        $('.login-form').fadeToggle();
        $('.sign-form').fadeOut();
        $('.forget').fadeOut();
    });


  // $("body").on('click', '.register', function() {
    $('.register').click(function() {
        $('.login-form').fadeOut();
        $('.forget').fadeOut();
        $('.sign-form').fadeIn();
        $('.sign-form').addClass('open');
    });



    $('.already-mem').click(function() {
        $('.sign-form').fadeOut();
        $('.forget').fadeOut();
        $('.login-form').fadeIn();
        $('.login-form').addClass('open');
    });


    $('.forgetpass').click(function() {
        $('.sign-form').fadeOut();
        $('.login-form').fadeOut();
        $('.forget').fadeIn();
    });

    /*******************************************************************************************/

    $(window).scroll(function() {
        var hT = $('.stat').offset().top,
            hH = $('.stat').outerHeight(),
            wH = $(window).height(),
            wS = $(this).scrollTop();

        if (wS > (hT + hH - wH)) {

            (function($) {
                $.fn.countTo = function(options) {
                    options = options || {};

                    return $(this).each(function() {
                        // set options for current element
                        var settings = $.extend({}, $.fn.countTo.defaults, {
                            from: $(this).data('from'),
                            to: $(this).data('to'),
                            speed: $(this).data('speed'),
                            refreshInterval: $(this).data('refresh-interval'),
                            decimals: $(this).data('decimals')
                        }, options);

                        // how many times to update the value, and how much to increment the value on each update
                        var loops = Math.ceil(settings.speed / settings.refreshInterval),
                            increment = (settings.to - settings.from) / loops;

                        // references & variables that will change with each update
                        var self = this,
                            $self = $(this),
                            loopCount = 0,
                            value = settings.from,
                            data = $self.data('countTo') || {};

                        $self.data('countTo', data);

                        // if an existing interval can be found, clear it first
                        if (data.interval) {
                            clearInterval(data.interval);
                        }
                        data.interval = setInterval(updateTimer, settings.refreshInterval);

                        // initialize the element with the starting value
                        render(value);

                        function updateTimer() {
                            value += increment;
                            loopCount++;

                            render(value);

                            if (typeof(settings.onUpdate) == 'function') {
                                settings.onUpdate.call(self, value);
                            }

                            if (loopCount >= loops) {
                                // remove the interval
                                $self.removeData('countTo');
                                clearInterval(data.interval);
                                value = settings.to;

                                if (typeof(settings.onComplete) == 'function') {
                                    settings.onComplete.call(self, value);
                                }
                            }
                        }

                        function render(value) {
                            var formattedValue = settings.formatter.call(self, value, settings);
                            $self.html(formattedValue);
                        }
                    });
                };

                $.fn.countTo.defaults = {
                    from: 0, // the number the element should start at
                    to: 0, // the number the element should end at
                    speed: 1000, // how long it should take to count between the target numbers
                    refreshInterval: 100, // how often the element should be updated
                    decimals: 0, // the number of decimal places to show
                    formatter: formatter, // handler for formatting the value before rendering
                    onUpdate: null, // callback method for every time the element is updated
                    onComplete: null // callback method for when the element finishes updating
                };

                function formatter(value, settings) {
                    return value.toFixed(settings.decimals);
                }
            }(jQuery));

            jQuery(function($) {
                // custom formatting example
                $('#count-number').data('countToOptions', {
                    formatter: function(value, options) {
                        return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
                    }
                });

                // start all the timers
                $('.timer').each(count);

                function count(options) {
                    var $this = $(this);
                    options = $.extend({}, options || {}, $this.data('countToOptions') || {});
                    $this.countTo(options);
                }
            });
        }
    });

    /*************************************************************************************/

    $('.list-tabs li').click(function() {

        $(this).addClass('selected').siblings().removeClass("selected");
        $(this).addClass('custom-js').siblings().removeClass("custom-js");

        // hide all divs
        $('.tabs-content > div').hide();

        $('.' + $(this).data('class')).show(); // 3shan tkon .tab1 aw .tab2

    });

    /**************************************************************/


    $('.list-tabs2 li').click(function() {

        $(this).addClass('selected').siblings().removeClass("selected");
        $(this).addClass('custom-js').siblings().removeClass("custom-js");

        // hide all divs
        $('.tabs-content2 > div').hide();

        $('.' + $(this).data('class')).show(); // 3shan tkon .tab1 aw .tab2

    });

    /***************************************************************/


    $('.list-tabs3 li').click(function() {

        $(this).addClass('selected').siblings().removeClass("selected");
        $(this).addClass('custom-jss').siblings().removeClass("custom-jss");

        // hide all divs
        $('.tabs-content3 > div').hide();
        $('.' + $(this).data('class')).show(); // 3shan tkon .tab1 aw .tab2

    });

    /******************************************************************************/

    $('.arrang-menu li a').click(function() {
        $(this).addClass('coloring').parent('li').prevAll().children('a').removeClass('coloring')
        $(this).addClass('coloring').parent('li').nextAll().children('a').removeClass('coloring')
    });



    /**********************************************************************/


    $('.law-profile .offers').click(function() {

        $(this).fadeOut();
        $(this).next('.okk').fadeIn();
    });


});
$(function() {
    $( "#datepicker" ).datepicker();
         $( "#datepicker" ).datepicker("option", "dateFormat","mm/dd/yy");
 });
