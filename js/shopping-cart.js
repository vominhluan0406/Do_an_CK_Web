var soLuongSP = 0;
var tongGia = 0;

$(document).ready(function(){
    $('.single-product').each(function(){
        let gia = parseFloat($('.product-carousel-price ins', this).text());
        $('.product-f-image .product-hover .add-to-cart-link',this).click(function(){
            soLuongSP++;
            $('.product-count').text(soLuongSP).css('display', 'block');
            tongGia += gia;
            $('.cart-amunt').text(tongGia*1000000+' VND');
        });
    });
    Shopping();
    $('#emptyCart').click(function () {
        soLuongSP = 0;
        tongGia = 0;

        $('.product-count').css('display', 'none');
        // $('#cartItems').text('');
        $('.cart-amunt').text(tongGia);
    }); 
});

function Shopping(){
    $('.col-md-3.col-sm-6').each(function () {
        let gia = parseFloat($('.single-shop-product .product-carousel-price ins', this).text());
        $('.product-option-shop .add_to_cart_button', this).click(function () {
            soLuongSP++;
            $('.product-count').text(soLuongSP).css('display', 'block');
            tongGia += gia;
            $('.cart-amunt').text(tongGia * 1000000 + ' VND');
        });
    });
}