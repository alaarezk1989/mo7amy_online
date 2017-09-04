jQuery('<div class="period-buttons"><a href="#" class="period-btn period-up">+</a><a href="#" class="period-btn period-down">-</a></div>').insertAfter('.period-container input');
jQuery('.period-container').each(function() {
    var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.period-up'),
        btnDown = spinner.find('.period-down'),
        min = input.attr('min'),
        max = input.attr('max');

    btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
        $('.total-amount .years-count').text(newVal);
    });

    btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
        $('.total-amount .years-count').text(newVal);
    });
});

(function($){
    $(window).on('load', function () {
        /*$('.modal-overlay').not('.modal-overlay.dialog').children('.modal-container').children('.modal-inner').mCustomScrollbar({
            scrollInertia: 400
        });*/
        $('.modal-overlay').children('.modal-container').children('.modal-inner').mCustomScrollbar({
            scrollInertia: 400
        });
        $('.amount-duration-outer, .answers-titles-container').mCustomScrollbar({
            axis: "x",
            scrollInertia: 400
        });
    });
})(jQuery);

$(window).on('load', function () {
    $('.collective-msg').each(function(){
        if ($(this).text().length > 160) {
            var collectiveMsg = $(this).text(),
                collectiveMsgTruncated = jQuery.trim(collectiveMsg).substring(0, 160).split(" ").slice(0, -1).join(" ") + "...";
            $(this).text(collectiveMsgTruncated);
        }
    });
});

$(document).ready(function () {
    $('.can-not-combined').each(function(){
        if ($(this).is(':checked')) {
            $(this).parent('li').siblings().children('.can-not-combined').prop('disabled', 'true');
        } else {
            $(this).parent('li').siblings().children('.can-not-combined').prop('disabled', false);
        }
    });
    
    $(document).on('click', '.period-container .period-buttons .period-btn', function (e) {
        e.preventDefault();
    });
    
    $('[data-toggle="tooltip"]').tooltip();
    
    if ($(window).width() <= 767 ) {
        $('.amount-duration-data li .step-name, .amount-duration-data li .step-time').tooltip('destroy');
    }
    
    $(window).resize(function () {
        if ($(this).width() <= 767 ) {
            $('.amount-duration-data li .step-name, .amount-duration-data li .step-time').tooltip('destroy');
        }
    });
    
    $('[data-toggle="popover"]').popover();
    
    /*$(document).on('click', function (e) {
        $('[data-toggle="popover"], [data-original-title]').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                (($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
            }
        });
    });*/
    
    $('.selectize').selectize({
        sortField: 'text'
    });
    
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy'
    });
    
    var defaultDescription = $('.answer-short-description-preview').text();
    $(document).on({
        mouseenter: function (e) {
            var labelShortDescription = $(this).data('short-description');
            if (e.offsetY > 34 && e.offsetY < 74) {
                if (!$(this).parents('.answers-titles-container').find('input[type="checkbox"], input[type="radio"]').is(':checked')) {
                    //$('.visualized-answers').append('<p class="answer-short-description-preview">' + labelShortDescription + '</p>');
                    $('.answer-short-description-preview').text(labelShortDescription);
                } else {
                    //$('.answer-short-description-preview').remove();
                    $('.answer-short-description-preview').text(defaultDescription);
                }
            }
        },
        mouseleave: function () {
            $('.answer-short-description-preview').text(defaultDescription);
        }
    }, '.answers-titles li label, .percentage-container li label');
    
    // Expand or shrink textarea while typing
    $(document).on('paste input', '.non-resizable', function () {
        var offset = $(this).innerHeight() - $(this).height();
        if ($(this).innerHeight < this.scrollHeight) {
            //Grow the field if scroll height is smaller
            $(this).height(this.scrollHeight - offset);
        } else {
            //Shrink the field and then re-set it to the scroll height in case it needs to shrink
            $(this).height(1);
            $(this).height(this.scrollHeight - offset);
        }
    });
    
    $(document).on('change', '.can-not-combined', function () {
        if ($(this).is(':checked')) {
            $(this).parent('li').siblings().children('input[type="checkbox"].can-not-combined').prop('disabled', 'true');
        } else {
            $(this).parent('li').siblings().children('input[type="checkbox"].can-not-combined').prop('disabled', false);
        }
    });
    
    /*$(document).on('change', 'input[type="checkbox"], input[type="radio"]', function () {
        if ($(this).siblings('label').data('toggle') == 'popover') {
            if ($(this).is(':checked') && $(this).is(':enabled')) {
                $(this).siblings('label[data-toggle="popover"]').popover('show');
            } else {
                $(this).siblings('label[data-toggle="popover"]').popover('hide');
            }
        }
    });*/
    
    $(document).on('mouseenter', 'input[type="checkbox"] + label, input[type="radio"] + label', function () {
        if ($(this).data('toggle') == 'popover') {
            if (!$(this).siblings('input[type="checkbox"], input[type="radio"]').is(':enabled')) {
                $(this).popover('hide');
            } else {
                $(this).popover('show');
            }
        }
    });
    
    $(document).on('change', '#amount-entry, #continuous-payment, #has-monthly-payment', function () {
        if ($(this).is(':checked')) {
            $(this).siblings('.entry-fields-wrapper').addClass('wrapper-expanded');
        } else {
            $(this).siblings('.entry-fields-wrapper').removeClass('wrapper-expanded');
        }
    });
    
    $(document).on('change', '#entry-field', function () {
        if ($(this).is(':checked')) {
            $(this).siblings('.form-select').children('#entry-options').prop('disabled', false);
            $(this).siblings('.entry-fields-wrapper').addClass('wrapper-expanded');
        } else {
            $(this).siblings('.form-select').children('#entry-options').prop('disabled', 'true');
            $(this).siblings('.entry-fields-wrapper').removeClass('wrapper-expanded');
        }
    });
    
    $(document).on('change', '#entry-options', function () {
        $(this).parent('.form-select').next('.entry-fields-wrapper').addClass('wrapper-expanded');
    });
    
    $(document).on('change', '.answer-container input[type="checkbox"], .answer-container input[type="radio"], .answers-titles input[type="radio"]', function () {
        $('.collapsed-details').removeClass('details-revealed');
        if ($(this).is(':checked')) {
            $(this).next('label').find('.collapsed-details').addClass('details-revealed');
        } else {
            $(this).next('label').find('.collapsed-details').removeClass('details-revealed');
        }
    });
    
    // Modal setup
    $(document).on('click', '.modal-container', function (e) {
        e.stopPropagation();
    });
    $(document).on('click', '.modal-close, .modal-overlay, .dialog-cancel', function (e) {
        e.preventDefault();
        $('.modal-overlay').removeClass('modal-revealed');
        $('body').removeClass('prevent-scrolling');
    });
    
    // Answer content modal
    $(document).on('click', '.answer-container .collapsed-details .content-popup-trigger', function (e) {
        e.preventDefault();
        $(this).parents('label').next('.modal-overlay').toggleClass('modal-revealed');
        $('body').toggleClass('prevent-scrolling');
    });
    
    // Answer in visualized way content modal
    $(document).on('click', '.visualized-answers .content-popup-trigger', function (e) {
        e.preventDefault();
        $(this).next('.modal-overlay').toggleClass('modal-revealed');
        $('body').toggleClass('prevent-scrolling');
    });
    
    // Open Dialogue after clicking delete
    $(document).on('click', '.delete-action', function (e) {
        e.preventDefault();
        $(this).parents('.dropdown-menu').next('.modal-overlay.dialog').toggleClass('modal-revealed');
        $('body').toggleClass('prevent-scrolling');
    });
    
    // Send Email Dialogue
    $(document).on('click', '#send-email', function (e) {
        e.preventDefault();
        $('.modal-overlay.email-dialog').toggleClass('modal-revealed');
        $('body').toggleClass('prevent-scrolling');
    });
    
    // Show and hide answer details in the graphical view
    $(document).on('change', '.visualized-answers input[type="radio"]', function () {
        var inputId = $(this).attr('id');
        $('.answers-descriptions li').hide();
        $('.answers-descriptions').find('li[data-id="' + inputId + '"]').show();
        $('.answer-short-description-preview').remove();
    });
    
    $(document).on('keyup', '#investment_amount', function () {
        if ($(this).val() < parseInt($(this).parent().siblings('.input-info').find('.min-amount').text())) {
            $(this).parent().siblings('.input-info').addClass('text-danger');
            $(this).parents('#amount-entry').find('.next-step').prop('disabled', true);
        } else {
            $(this).parent().siblings('.input-info').removeClass('text-danger');
            $(this).parents('#amount-entry').find('.next-step').prop('disabled', false);
        }
    });
    
    $(document).on('keyup', '#investment-period', function () {
        if ($(this).val() < 1) {
            $(this).val(parseInt(1))
        }
        $('.total-amount .years-count').text($(this).val());
    });
    
    $(document).on('change', '.amount-polar-question input[type="radio"]', function () {
        $(this).parents('section').find('.next-step').prop('disabled', false);
    });
    
    $(document).on('change', '.amount-polar-question #no-amount', function () {
        if ($(this).is(':checked')) {
            $(this).parents('.row').siblings('.row.collapsible').removeClass('hidden');
        }
    });
    
    $(document).on('change', '.amount-polar-question #yes-amount', function () {
        if ($(this).is(':checked')) {
            $(this).parents('.row').siblings('.row.collapsible').addClass('hidden');
        }
    });
    
    $(document).on('change', '.amount-polar-question #no-initial', function () {
        if ($(this).is(':checked')) {
            $(this).parents('.row').siblings('.row.collapsible').addClass('hidden');
        }
    });
    
    $(document).on('change', '.amount-polar-question #yes-initial', function () {
        if ($(this).is(':checked')) {
            $(this).parents('.row').siblings('.row.collapsible').removeClass('hidden');
        }
    });
});

$(function () {
    $('#question > ul[data-role="administrator"]').sortable({
        handle: '.answer-order',
        placeholder: "ui-state-highlight",
        forcePlaceholderSize: true,
        axis: 'y',
        update: function (event, ui) {
            $('ul[data-role="administrator"] > li').each(function () {
                var itemIndex = $(this).index() + 1;
                $(this).find('.answer-order').html('');
                $(this).find('.answer-order').html(itemIndex);
            });
        }
    });
});

$(function () {
    $('.collective-questions').not('#questions-list .collective-questions').sortable({
        handle: '.answer-order',
        placeholder: "ui-state-highlight",
        forcePlaceholderSize: true,
        axis: 'y',
        update: function (event, ui) {
            $('.collective-questions > li').each(function () {
                var itemIndex = $(this).index() + 1;
                $(this).find('.answer-order').html('');
                $(this).find('.answer-order').html(itemIndex);
            });
        }
    });
});

$(function () {
    $(document).on('click', '#close-preview', function () {
        $('.image-preview').popover('hide');
        // Hover befor close the preview    
    });
});

$(function () {
    // Create the close button
    var closebtn = $('<button/>', {
        type: "button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;'
    });
    closebtn.attr("class", "close pull-right");

    // Clear event
    $('.image-preview-clear').click(function () {
        $('.image-preview').attr("data-content", "").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function () {
        var img = $('<img/>', {
            id: 'dynamic',
            width: 250,
            height: 200
        }),
            file = this.files[0],
            reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
        };
        reader.readAsDataURL(file);
    });
});

function openModal(event, element) {
    event.preventDefault();
    $(element).siblings('.modal-overlay.dialog').toggleClass('modal-revealed');
    $('body').toggleClass('prevent-scrolling');
}
$(function () {
    $(document).on('click', 'label[for="has-many-answers"] + .modal-overlay .dialog-delete, label[for="has-final-goal"] + .modal-overlay .dialog-delete', function (e) {
        e.preventDefault();
        if ($(this).parents('.modal-overlay.dialog').siblings('input[type="checkbox"], input[type="radio"]').is(':checked')) {
            $(this).parents('.modal-overlay.dialog').siblings('input[type="checkbox"], input[type="radio"]').prop('checked', false);
            $(this).parents('.modal-overlay.dialog').toggleClass('modal-revealed');
            $('body').toggleClass('prevent-scrolling');
        } else {
            $(this).parents('.modal-overlay.dialog').siblings('input[type="checkbox"], input[type="radio"]').prop('checked', true);
            $(this).parents('.modal-overlay.dialog').toggleClass('modal-revealed');
            $('body').toggleClass('prevent-scrolling');
        }
        /*if ($(this).parents('.modal-overlay.dialog').siblings('#has-many-answers').is(':checked')) {
            $(this).parents('li').siblings().children('input[type="checkbox"].can-not-combined').prop('disabled', 'true');
        } else {
            $(this).parents('li').siblings().children('input[type="checkbox"].can-not-combined').prop('disabled', false);
        }*/
        if ($(this).parents('.modal-overlay.dialog').siblings('.can-not-combined').is(':checked')) {
            $(this).parents('li').siblings().children('input[type="checkbox"].can-not-combined').prop('disabled', 'true');
        } else {
            $(this).parents('li').siblings().children('input[type="checkbox"].can-not-combined').prop('disabled', false);
        }
    });
});