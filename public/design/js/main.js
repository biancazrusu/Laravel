$(document).ready(function() {

    var $loginButton = $('a.login');
    var $registerButton = $('a.register');
    var $registerStepTwoButton = $('#free-registration');
    var $changePasswordButton = $('a.change-password');
    var $myAccountButton = $('a.update-my-account');
    var $loginPopup = $('#login-popup');
    var $registerPopup = $('#register-popup');
    var $registerStepTwoPopup = $('#register-step-two');
    var $changePasswordPopup = $('#change-password-popup');
    var $myAccountPopup = $('#update-my-account-popup');
    var $closePopup = $('a.close-popup');
    var $anyPopup = $('a.custom-popup');
    var $resetPass = $('a.reset-password');
    var $resetPopup = $('#reset-popup');
    var $loriHelp = $('a.lori-help');
    var $loriHelpPopup = $('#lori-help-popup');


    $loginButton.on('click', function () {
        closeCurrentPopup();
        $loginPopup.removeClass('hidden-popup').addClass('active');
        $('body').addClass('overflow-hidden');
    });

    $registerButton.on('click', function () {
        closeCurrentPopup();
        $registerPopup.removeClass('hidden-popup').addClass('active');
        $('body').addClass('overflow-hidden');
    });

    $registerStepTwoButton.on('click', function () {
        closeCurrentPopup();
        $registerStepTwoPopup.removeClass('hidden-popup').addClass('active');
        $('body').addClass('overflow-hidden');
    });

    $myAccountButton.on('click', function () {
        closeCurrentPopup();
        $myAccountPopup.removeClass('hidden-popup').addClass('active');
        $('body').addClass('overflow-hidden');
    });

    $loriHelp.on('click', function (){
        closeCurrentPopup();
        $loriHelpPopup.removeClass('hidden-popup').addClass('active');
        $('body').addClass('overflow-hidden');
    });

    $resetPass.on('click', function () {
        var $this = $(this);
        $this.parents('.custom-popup').addClass('hidden-popup');
        $resetPopup.removeClass('hidden-popup');
    });

    $changePasswordButton.on('click', function () {
        closeCurrentPopup();
        $changePasswordPopup.removeClass('hidden-popup').addClass('active');
        $('body').addClass('overflow-hidden');
    });

    $closePopup.on('click', function () {
        var $this = $(this);
        $this.parents('.custom-popup').addClass('hidden-popup').removeClass('active');
        $('body').removeClass('overflow-hidden');
    });

    var closeCurrentPopup = function(){
        $('.custom-popup.active').addClass('hidden-popup').removeClass('active');
        $('body').removeClass('overflow-hidden');
    }



    $('.contributor').addClass('translate');

    var $burger = $('.mobile-menu');
    $burger.on('click', function() {
        var $this = $(this);
        $this.toggleClass('cross');
        $this.siblings('.left-menu').toggleClass('show-menu');
        $this.parents().next().toggleClass('hide-page');
    });

    var $userOption = $('.user-option');
    $userOption.find('.overlay').on('click', function() {
        var $this = $(this);
        var $optionWrapper = $this.parents('.user-option');
        var $checkbox = $this.siblings('input');
        $optionWrapper.toggleClass('user-selection');
        if ($optionWrapper.hasClass('user-selection')) {
            $checkbox.attr("checked", true);
        }
        else {
            $checkbox.attr("checked", false);
        }
    });

    var trigger = $('.user-type-field');
    trigger.click(function() {
        var $this = $(this);
        if ($this.children('input').prop("checked", true)) {
            $this.siblings('.user-type-field').children('input').prop("checked", false);
        }
    });

    function DropDown(el) {
        this.dd = el;
        this.placeholder = this.dd.children('span');
        this.opts = this.dd.find('.dropdown a');
        this.val = '';
        this.index = -1;
        this.initEvents();
    }

    DropDown.prototype = {
        initEvents : function() {
            var obj = this;

            obj.dd.on('click', function(event){
                console.log('hei');
                $(this).toggleClass('active');
                return false;
            });

            obj.opts.on('click',function(){
                var opt = $(this);
                $('#country').addClass('selected-green');
                obj.val = opt.text();
                obj.index = opt.index();
                obj.placeholder.text(obj.val);
            });
        },
        getValue : function() {
            return this.val;
        },
        getIndex : function() {
            return this.index;
        }
    }

    $(function() {
        var dd = new DropDown( $('#dd') );
    });

    var $eventSelect = $('.js-example-basic-single').select2({
        language: "en"
    });

    $("#country").change(function(){
        $('.select2-selection__rendered').css('color', '#00e777');
        $('.select2-selection__rendered').css('width', '300px');
        $('.select2-selection__rendered').css('overflow', 'hidden');
        var country = $('#country option:selected').val();
        $('#city').find('option').remove().end();
         jQuery.ajax({
            type: "GET",
            url: "http://lori-back.icoldo.com/public/cities/"+country,
            success: function(msg){
                $('#city').append($("<option selected='selected' disabled style='color: #e2e2e2;'>What city are you from?</option>"));
                for (var i = 0; i <= msg.length - 1; i++) {
                    $('#city').append($('<option value="'+msg[i]+'">'+ msg[i] + '</option>'));
                }
           }
        });
    });

    $("#countryID").change(function(){
        $('.select2-selection__rendered').css('color', '#00e777');
        $('.select2-selection__rendered').css('width', '300px');
        $('.select2-selection__rendered').css('overflow', 'hidden');
        var country = $('#countryID option:selected').val();
        $('#cityId').find('option').remove().end();
         jQuery.ajax({
            type: "GET",
            url: "http://lori-back.icoldo.com/public/cities/"+country,
            success: function(msg){
                $('#cityId').append($("<option selected='selected' disabled>What city are you from?</option>"));
                for (var i = 0; i <= msg.length - 1; i++) {
                    $('#cityId').append($('<option value="'+msg[i]+'">'+ msg[i] + '</option>'));
                }
           }
        });
    });

    if(typeof $("#countryID").val() != 'undefined'){
        jQuery.ajax({
            type: "GET",
            url: "http://lori-back.icoldo.com/public/cities/"+$("#countryID").val(),
            success: function(msg){
                $('#cityId').append($("<option selected='selected' disabled >What city are you from?</option>"));
                for (var i = 0; i <= msg.length - 1; i++) {
                    if($('#cityDB').val() == msg[i]){
                        $('#cityId').append($('<option selected="true" class="option-green" value="'+msg[i]+'">'+ msg[i] + '</option>'));
                    }else{
                        $('#cityId').append($('<option class="option-green" value="'+msg[i]+'">'+ msg[i] + '</option>'));
                    }

                }
           }
        });
    }
});