<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

// prev & next post -------------------
$in_same_term = ( mfn_opts_get( 'prev-next-nav' ) == 'same-category' ) ? true : false;
$post_prev = get_adjacent_post( $in_same_term, '', true );
$post_next = get_adjacent_post( $in_same_term, '', false );
$blog_page_id = get_option('page_for_posts');

// post classes -----------------------
$classes = array();
if( ! mfn_post_thumbnail( get_the_ID() ) ) $classes[] = 'no-img';
if( get_post_meta(get_the_ID(), 'mfn-post-hide-image', true) ) $classes[] = 'no-img';
if( post_password_required() ) $classes[] = 'no-img';
if( ! mfn_opts_get( 'blog-title' ) ) $classes[] = 'no-title';

if( mfn_opts_get( 'share' ) == 'hide-mobile' ){
    $classes[] = 'no-share-mobile';
} elseif( ! mfn_opts_get( 'share' ) ) {
    $classes[] = 'no-share';
}

$translate['published'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-published','Published by') : __('Published by','betheme');
$translate['at'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-at','at') : __('at','betheme');
$translate['tags'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-tags','Tags') : __('Tags','betheme');
$translate['categories'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-categories','Categories') : __('Categories','betheme');
$translate['all'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-all','Show all') : __('Show all','betheme');
$translate['related'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-related','Related posts') : __('Related posts','betheme');
$translate['readmore'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-readmore','Read more') : __('Read more','betheme');
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    .btn-donate {
        border-radius: 10%;
        padding: 70px 80px;
        margin: 20px;
        text-align: center;
        background: white;
        display: inline-block;
        text-decoration: none !important;
        color: black;
        font-weight: bold;
        font-size: 20px;
        letter-spacing: 2px;
        line-height: 1.4;
    }
    .donor-from {
        text-align: center;
        background-color: #dedede;
        padding: 80px;
    }
    .donor-from h1 {
        margin-bottom: 27px;
    }
    .btn-next1 {
        text-align: right;
        padding-right: 100px;
        padding-top: 20px;
    }
    .btn-next1 button {
        padding: 20px 50px;
        border-radius: 40px;
        font-size: 16px;
        letter-spacing: 3px;
    }
    .donor-from button {
        margin-left: 540px;
        height: 40px;
        width: 100px;
        border-radius: 20px;
    }
    option:first {
        color: #999;
    }
    select {
        color: #999;
        border: none;
        padding-left: 16px;
    }
    .donate-price {
        width: 560px;
        height: 40px;
        display: inline-block;
        position: relative;
        border-radius: 10px;
        margin-bottom: 18px;
    }
    .donate-price div {
        display: inline-block;
        position: absolute;
        left: 0;
        padding-left: 15px;
        padding-top: 2px;
        font-size: 18px;
    }
    .donate-price span {
        vertical-align: -webkit-baseline-middle;
    }
    .donate-price input {
        width: 100%;
        max-width: inherit;
        height: 100%;
        border-radius: 12px;
        display: inline-block;
        vertical-align: baseline;
        padding-left: 35px;
    }
    .select-payment-method,
    .direct-debit {
        display: inline-block;
        border-radius: 10px 0px 0px 10px;
        width: 320px;
        height: 36px;
    }
    .btn-setup-payment {
        margin-left: -4px !important;
        width: 240px !important;
        height: 36px !important;
        border-radius: 0px 10px 10px 0px !important;
    }
    .btn-back {
        display: block !important;
        margin-left: calc(50% - 280px) !important;
        margin-top: 22px !important;
        width: 100px !important;
        height: 36px !important;
        width: 100px !important;
        border-radius: 20px !important;
    }
    .select-age-group {
        display: inline-block !important;
        width: 240px !important;
        border-radius: 10px;
        margin-right: 6px;
    }
    .select-monthly-payment {
        display: inline-block !important;
        width: 310px !important;
        border-radius: 10px;
    }

    .zInputWrapper{
        /*background-color:#E4E8E8;*/
        padding: 4px;
        margin: 2px;
        border-radius:12px;
        display:inline-block;
    }

    .zInput{
        display: inline-block;
        width: 150px;
        height: 130px;
        background-color: white;
        margin: 24px;
        padding: 12px;
        text-align: center;
        cursor: default;
        color: #39bdba;
        border: #39bdba 1px solid;
        border-radius:10px;
        font-size: 18px;
        overflow:hidden;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }


    .zCheckbox{
        color: #000099;
        border: #000099 1px solid;
    }

    .zSelected{
        color: white;
        background-color:#39bdba;
    }

    .zSelected.zCheckbox{
        background-color: #000099;

    }

    .modal-header, h4, .close {
        background-color: #39bdba;
        color:white !important;
        text-align: center;
        font-size: 30px;
    }
    .modal-footer {
        background-color: #f9f9f9;
    }

    .btn-success {
        color: #fff;
        background-color: #39bdba;
        border-color: #38b0ad;
    }

    .btn-success:hover {
        color: #fff;
        background-color: #10a2b2;
        border-color: #1097a7;
    }

    .btn-success:active,
    .btn-success:focus {
        color: #fff;
        background-color: #1097a7 !important;
        border-color: #108595 !important;
    }

    .form-group {
        margin-bottom: inherit;
    }
    .form-group input {
        display: inline-block;
        vertical-align: sub;
    }
    .form-group label {
        min-width: 100px;
    }
</style>


<div class="section section-page-comments">
    <div class="section_wrapper clearfix">
        <div class="column one-second comments" style="padding-left: 4%;padding-right: 8%;padding-top: 2%;">
            <h1>Make a Donation</h1>
            <p>Food For Life Vrindavan is dedicated to serving the poorest residents of Vrindavan. Running since 1990 generating better opportunities for young girls and women.</p>
        </div>
        <div class="column one-second comments" style="width: 45%;padding-left: 20px;padding-bottom: 40px;">
            <img src="http://dev.fflvrindavan.org/wp-content/uploads/2016/08/playme-nygf.jpg">
        </div>
        <div class="column one comments">
            <div class="donor-from" id="dontate_from">
                <h1 style="margin-bottom: 16px">Where are you donating from?</h1>
                <div id="affected1">
                    <input type="radio" name="opt_donate_from" value="uk"  title="UK" checked>
                    <input type="radio" name="opt_donate_from" value="usa" title="USA">
                    <input type="radio" name="opt_donate_from" value="eu"  title="EU">
                    <input type="radio" name="opt_donate_from" value="can" title="International">
                    <input type="radio" name="opt_donate_from" value="ind"  title="India">
                    <button type="button" class="btn-success" id="next-btn1">Next</button>
                </div>
            </div>
            <div class="donor-from" id="dontate_type" style="display: none">
                <h1 style="margin-bottom: 16px">Choose Donation Type</h1>
                <div id="affected2">
                    <input type="radio" name="opt_donate_type" value="oneOffDonation" title="One off Donation" checked>
                    <input type="radio" name="opt_donate_type" value="sponsorGirl"  title="Sponsor a girl $45/month">
                    <input type="radio" name="opt_donate_type" value="recurringPayment"  title="Recurring Payments">
                </div>
                <button type="button" class="btn-success" id="next-btn2">Next</button>
            </div>
            <div class="donor-from" id="dontate_info" style="display: none">
                <form id="personal-info">
                    <h1>Personal Information</h1>
                    <div id="affected3">
                        <div class="form-group">
<!--                            <label for="usrnameF">First Name(*)</label>-->
                            <input type="text" class="form-control" id="usrnameF" placeholder="First Name" style="width: 100%" required>
                        </div>
                        <div class="form-group">
<!--                            <label for="usrnameL">Last Name(*)</label>-->
                            <input type="text" class="form-control" id="usrnameL" placeholder="Last Name" style="width: 100%" required>
                        </div>
                        <div class="form-group">
<!--                            <label for="email">Email(*)</label>-->
                            <input type="email" class="form-control" id="email" placeholder="E-mail" style="width: 100%" required>
                        </div>
                        <div class="form-group">
<!--                            <label for="address">Address</label>-->
                            <input type="text" class="form-control" id="address" placeholder="Address (Optional)" style="width: 100%">
                        </div>
                        <div class="form-group">
<!--                            <label for="phonenumber">Phone Number</label>-->
                            <input type="number" class="form-control" id="phonenumber" placeholder="Phone Number (Optional)" style="width: 100%">
                        </div>
                    </div>
                    <button type="submit" class="btn-success" id="next-btn3">Next</button>
                </form>
            </div>
            <div class="donor-from" id="one_off_donation" style="display: none;padding-left: 180px;padding-right: 180px;">
                <h1>One Off Donation Amount</h1>
                <form id="btn-setup-payment-oneoff">
                    <div class="donate-price">
                        <div class="span-price"><span>£</span></div>
                        <input type="number" required>
                    </div>

                    <select class="select-payment-method" required>
                        <option value="" disabled selected>Select payment method</option>
                    </select>
                    <button type="submit" class="btn-success btn-setup-payment">Set up Payment</button>
                </form>

                <button type="button" class="btn-success btn-back" id="btn-back1">Back</button>
            </div>
            <div class="donor-from" id="sponsor_girl" style="display: none;">
                <h1>Sponsor A Girl - Options</h1>
                <form id="btn-setup-payment-sponsor">
                    <div style="margin-bottom: 18px">
                        <select class="select-age-group" style="display: inline-block;width: 30%;" required>
                            <option value="" disabled selected>Select Age Group</option>
                            <option>Any</option>
                            <option>2-5</option>
                            <option>6-9</option>
                            <option>10-13</option>
                            <option>14+</option>
                        </select>
                        <select class="select-monthly-payment" style="display: inline-block;width: 30%;" required>
                            <option value="" disabled selected>Monthly or Annual Payment?</option>
                            <option>Monthly</option>
                            <option>Annual</option>
                        </select>
                    </div>

                    <select class="select-payment-method" required>
                        <option value="" disabled selected>Select payment method</option>
                    </select>
                    <button type="submit" class="btn-success btn-setup-payment">Make Payment</button>
                </form>
                <button type="button" class="btn-success btn-back" id="btn-back2">Back</button>
            </div>
            <div class="donor-from" id="recurring_donation" style="display: none;padding-left: 180px;padding-right: 180px;">
                <h1>Recurring Donation Amount</h1>
                <form id="btn-setup-payment-direct">
                    <div class="donate-price">
                        <div class="span-price"><span>£</span></div>
                        <input type="number" required>
                    </div>

                    <select class="direct-debit" required>
                        <option value="directDebit" selected>Direct Debit</option>
                    </select>
                    <button type="submit" class="btn-success btn-setup-payment">Set up Payment</button>
                </form>
                <button type="button" class="btn-success btn-back" id="btn-back3">Back</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:15px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Set Up Payment</h4>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form role="form" id="setup-payment">
                    <div class="form-group">
                        <label for="usrnameF">First Name</label>
                        <input type="text" class="form-control" id="usrnameF" placeholder="First Name" style="width: 100%" required>
                    </div>
                    <div class="form-group">
                        <label for="usrnameL">Last Name</label>
                        <input type="text" class="form-control" id="usrnameL" placeholder="Last Name" style="width: 100%" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" style="width: 100%" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">OK</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready( function () {
        jQuery("#next-btn1").click( function() {
            jQuery('#dontate_from').css("display", "none");
            jQuery('#dontate_type').css("display", "");
        });
        jQuery("#next-btn2").click( function() {
            jQuery('#dontate_type').css("display", "none");
            switch(jQuery('input:radio[name=opt_donate_from]:checked').val()) {
                case 'uk':
                    console.log("Aaaaa");
                    jQuery(".select-payment-method option").remove();
                    jQuery(".select-payment-method").append('<option value="" disabled selected>Select payment method</option>');
                    jQuery(".select-payment-method").append('<option value="paypal">Paypal</option>');
                    jQuery(".select-payment-method").append('<option value="stripe">Stripe</option>');
                    jQuery(".select-payment-method").append('<option value="giftcard">Gift Card</option>');

                    jQuery(".span-price span").remove();
                    jQuery(".span-price").append('<span>£</span>');
                    break;
                case 'usa':
                    jQuery(".select-payment-method option").remove();
                    jQuery(".select-payment-method").append('<option value="" disabled selected>Select payment method</option>');
                    jQuery(".select-payment-method").append('<option value="paypal">Paypal</option>');
                    jQuery(".select-payment-method").append('<option value="stripe">Stripe</option>');

                    jQuery(".span-price span").remove();
                    jQuery(".span-price").append('<span>$</span>');
                    break;
                case 'eu':
                    jQuery(".select-payment-method option").remove();
                    jQuery(".select-payment-method").append('<option value="" disabled selected>Select payment method</option>');
                    jQuery(".select-payment-method").append('<option value="paypal">Paypal</option>');
                    jQuery(".select-payment-method").append('<option value="stripe">Stripe</option>');

                    jQuery(".span-price span").remove();
                    jQuery(".span-price").append('<span>$</span>');
                    break;
                case 'can':
                    jQuery(".select-payment-method option").remove();
                    jQuery(".select-payment-method").append('<option value="" disabled selected>Select payment method</option>');
                    jQuery(".select-payment-method").append('<option value="paypal">Paypal</option>');
                    jQuery(".select-payment-method").append('<option value="stripe">Stripe</option>');

                    jQuery(".span-price span").remove();
                    jQuery(".span-price").append('<span>$</span>');
                    break;
                case 'ind':
                    jQuery(".select-payment-method option").remove();
                    jQuery(".select-payment-method").append('<option value="" disabled selected>Select payment method</option>');
                    jQuery(".select-payment-method").append('<option value="paypal">Paypal</option>');
                    jQuery(".select-payment-method").append('<option value="payumoney">PayUMoney</option>');

                    jQuery(".span-price span").remove();
                    jQuery(".span-price").append('<span>$</span>');
                    break;
            }
            jQuery('#dontate_info').css("display", "");
        });
        jQuery("#next-btn3").click( function() {

        });
        jQuery("#btn-back1").click( function() {
            jQuery('#one_off_donation').css("display", "none");
            jQuery('#dontate_from').css("display", "");

//            jQuery('#affected1 input:first-child, #affected2 input:first-child').prop("checked", "checked");
//            jQuery('input[name="opt_donate_from"], input[name="opt_donate_type"]').prop('checked', false);
//            jQuery('#affected1 input:first-child').prop('checked', true);
//            jQuery('#affected2 input:first-child').prop('checked', true);
//            jQuery("#affected1").zInput();
//            jQuery("#affected2").zInput();
            jQuery('#usrnameF').val("");
            jQuery('#usrnameL').val("");
            jQuery('#email').val("");
            jQuery('#address').val("");
            jQuery('#phonenumber').val("");
        });
        jQuery("#btn-back2").click( function() {
            jQuery('#sponsor_girl').css("display", "none");
            jQuery('#dontate_from').css("display", "");

//            jQuery('#affected1 input:first-child, #affected2 input:first-child').prop("checked");
//            jQuery('input[name="opt_donate_from"], input[name="opt_donate_type"]').prop('checked', false);
//            jQuery('#affected1 input:first-child').prop('checked', true);
//            jQuery('#affected2 input:first-child').prop('checked', true);
//            jQuery("#affected1").zInput();
//            jQuery("#affected2").zInput();
            jQuery('#usrnameF').val("");
            jQuery('#usrnameL').val("");
            jQuery('#email').val("");
            jQuery('#address').val("");
            jQuery('#phonenumber').val("");
        });
        jQuery("#btn-back3").click( function() {
            jQuery('#recurring_donation').css("display", "none");
            jQuery('#dontate_from').css("display", "");

//            jQuery('#affected1 input:first-child, #affected2 input:first-child').prop("checked", "checked");
//            jQuery('input[name="opt_donate_from"], input[name="opt_donate_type"]').prop('checked', false);
//            jQuery('#affected1 input:first-child').prop('checked', true);
//            jQuery('#affected2 input:first-child').prop('checked', true);
//            jQuery("#affected1").zInput();
//            jQuery("#affected2").zInput();
            jQuery('#usrnameF').val("");
            jQuery('#usrnameL').val("");
            jQuery('#email').val("");
            jQuery('#address').val("");
            jQuery('#phonenumber').val("");
        });
        jQuery("#btn-setup-payment-oneoff, #btn-setup-payment-sponsor, #btn-setup-payment-direct").submit(function (e) {
            e.preventDefault();
            // jQuery("#myModal").modal();
        });
        jQuery("#setup-payment").submit(function (e) {
            e.preventDefault();
        });
        jQuery("#personal-info").submit(function (e) {
            e.preventDefault();
            jQuery('#dontate_info').css("display", "none");
            switch(jQuery('input:radio[name=opt_donate_type]:checked').val()) {
                case 'sponsorGirl':
                    jQuery('#sponsor_girl').css("display", "");
                    break;
                case 'oneOffDonation':
                    jQuery('#one_off_donation').css("display", "");
                    break;
                case 'recurringPayment':
                    jQuery('#recurring_donation').css("display", "");
                    break;
            }
        })
    });

    $.fn.zInput = function(){

        var $inputs = this.find(":radio,:checkbox");
        $inputs.hide();
        var inputNames = [];
        $inputs.map(function(){
            inputNames.push($(this).attr('name'));
        });

        inputNames = $.unique(inputNames);

        $.each(inputNames, function(index,value){

            var $element = $("input[name='" + value + "']");
            var elementType = $element.attr("type");
            $element.wrapAll('<div class="zInputWrapper" />');
            if (elementType == "radio"){
                $element.wrap(function(){ return '<div class="zInput"><span style="display:table;width: 100%;height: 100%;"><span style="display: table-cell;vertical-align:middle;">' + $(this).attr("title") + '</span></span></div>'});
            }
            if (elementType == "checkbox")
            {
                $element.wrap(function(){ return '<div class="zInput zCheckbox"><span style="display:table;width: 100%;height: 100%;"><span style="display: table-cell;vertical-align:middle;">' + $(this).attr("title") + '</span></span></div>'});
            }

        });


        var $zRadio = $(".zInput").not(".zCheckbox");
        var $zCheckbox	= $(".zCheckbox");

        $zRadio.click(function(){
            $theClickedButton = $(this);

            //move up the DOM to the .zRadioWrapper and then select children. Remove .zSelected from all .zRadio
            $theClickedButton.parent().children().removeClass("zSelected");
            $theClickedButton.addClass("zSelected");
            $theClickedButton.find(":radio").prop("checked", true).change();
        });

        $zCheckbox.click(function(){
            $theClickedButton = $(this);

            //move up the DOM to the .zRadioWrapper and then select children. Remove .zSelected from all .zRadio
            $theClickedButton.toggleClass("zSelected");
            $theClickedButton.find(':checkbox').each(function () { this.checked = !this.checked; $(this).change()});
        });


        $.each($inputs,function(k,v){
            if($(v).attr('checked')){
                $(v).parent().click();
            }
        });
    }

    $("#affected1").zInput();
    $("#affected2").zInput();
</script>