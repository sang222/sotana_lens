$(document).ready(function(){$("#ship-to-different-address-checkbox").attr('checked',false)
$("#check-difer").click(function(e){$("#ship-to-different-address-checkbox").trigger('click');if(e.target.checked){$('.shipping_address .woocommerce-shipping-fields__field-wrapper').fadeIn('slow')}else{$('.shipping_address .woocommerce-shipping-fields__field-wrapper').fadeOut('slow')}})});