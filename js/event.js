var event = {
    'event1':'temp/event1.html',
    'event2':'https://news.zing.vn/honda-sh-2020-ra-mat-voi-thiet-ke-moi-dong-co-nang-cap-post1009711.html'
}
$(document).ready(function(){
    var urlevent = window.location.search.substring(7);
    for(ii in event){
        console.log(ii +urlevent);
        if(urlevent===ii){
            $('.overlay-content div').replaceWith('<div><iframe src="'+ event[ii]+'" width="100%" height="500px"></iframe></div>');
        }
    }
});