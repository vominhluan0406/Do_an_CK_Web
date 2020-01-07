$(document).ready(function(){
    let url = decodeURIComponent(window.location.search);
    url=url.substring(4);
    if(url.search('_')!=-1){
    url=url.replace(/_/g," ");
    }
    else{
        url = url.replace(/\+/g," ");
    }
    tmp = product[url].split(',');
    $('head title').text(url);
    $('img','.product-main-img').attr('src','img\/'+tmp[0]);
    $('.product-name').replaceWith('<h2 class="product-name">'+url+'</h2>');
    $('.product-inner-price').replaceWith('<div class="product-inner-price"><ins>'+ tmp[2] +'.000 VND</ins></div >');
    $('.product-inner-category p').children('a:first').replaceWith('<a href="">'+(url.split(' '))[0] +'</a>');
    $('.tab-content .tab-pane.fade.in.active p:first').replaceWith(thongSo[url]);
    $('.product-breadcroumb a:last').replaceWith('<a href="">'+url+'</a>');
    $('.single-product-area .container .row .col-md-4 .single-sidebar:nth-child(2) .thubmnail-recent').each(function(){
        ran = Math.floor((Math.random() * productName.length - 1) + 1);
        $('img', this).attr('src', 'img\/' + product[productName[ran]].split(',')[0]);
        $('h2 a', this).replaceWith('<a href="single-product.html?xe=' + productName[ran].replace(/ /g, '_') + '">' + productName[ran] + '</a>');
        $('.product-sidebar-price ins', this).replaceWith('<ins>' + product[productName[ran]].split(',')[2] + '.000 VND</ins>');
    });
    $('.related-products-carousel.owl-carousel.owl-theme.owl-responsive-1200.owl-loaded .owl-stage-outer .owl-stage .owl-item').each(function(){
        ran = Math.floor((Math.random() * productName.length-1) + 1);
        $('.single-product .product-f-image img',this).attr('src','img\/'+product[productName[ran]].split(',')[0]);
        $('.single-product .product-f-image .product-hover .view-details-link', this).attr('href', 'single-product.html?xe=' + productName[ran].replace(/ /g, '_'));
        $('.single-product h2 a',this).replaceWith('<a href="single-product.html?xe=' + productName[ran].replace(/ /g,'_')+'">'+ productName[ran]+'</a>');
        $('.single-product .product-carousel-price ins', this).replaceWith('<ins>' + product[productName[ran]].split(',')[2]+'.000 VND</ins>');
    });
    i=0;
    $('.single-product-area .container .row .col-md-4 .single-sidebar:last ul li').each(function () {
        $('a', this).replaceWith('<a href="single-product.html?xe='+ XemGanDay[i].replace(/ /g,'_')+'">'+ XemGanDay[i]+'</a>');
        i++;
    });
    let giaTien = parseFloat(tmp[2]);
    
    $('.add_to_cart_button').click(function(){
        let soluong = $('#numberic').val();
        console.log(soluong);
        $('.product-count').text(soluong).css('display', 'block');
        $('.cart-amunt').text(giaTien*soluong * 1000000 + ' VND');
    });
});

// Autocomplete

function autocomplete(inp, arr) {
    var temp;
    inp.addEventListener("input", function (e) {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val) { return false; }
        temp = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        for (i = 0; i < arr.length; i++) {
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function (e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            temp++;
            addActive(x);
        } else if (e.keyCode == 38) {
            temp--;
            addActive(x);
        } else if (e.keyCode == 13) {
            e.preventDefault();
            if (temp > -1) {
                if (x) x[temp].click();
            }
        }
    });
    function addActive(x) {
        if (!x) return false;
        removeActive(x);
        if (temp >= x.length) temp = 0;
        if (temp < 0) temp = (x.length - 1);
        x[temp].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}