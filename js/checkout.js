str = ['Hà Nội','TP HCM'];
var cuahang = {
    'Hà Nội':'Số 136 Xuân Thủy, Dịch Vọng Hậu, Cầu Giấy;Số 55 Giải Phóng, Đồng Tâm, Hai Bà Trưng',
    'TP HCM':'351A Lạc Long Quân, Phường 5, Quận 11;222 Lê Văn Sỹ, Phường 14, Quận 3;280 An Dương Vương, Phường 4, Quận 5'
};
$(document).ready(function(){
    for(i=0;i<str.length;i++){
        $("#billing_country").append('<option value="'+i+'">'+ str[i]+'<\/option>');
        fun1();
        $("#billing_country").click(function(){
            console.log($('#billing_country option:selected').text());
            fun1($('#billing_country option:selected').text());
        })
    }
});

function fun1(tmp){
    for (j in str) {
        let diachi = cuahang[str[j]].split(';');
        st ='<select class="country_to_state country_select" id="shipping_country" name="shipping_country">';
        if (tmp == str[j]) {
            for(k in diachi)
            st+='<option value="' + k + '">' + diachi[k] + '<\/option>';
            $('#shipping_country').replaceWith(st + '</select>');
            break;
        }
    }
}