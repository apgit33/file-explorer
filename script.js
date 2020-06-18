let hideSeek = 'cache';
let cacheMoi = $('.hidden');
cacheMoi.hide()
$("#cache").click(function(){
    if (hideSeek == 'cache') {
        cacheMoi.show();
        hideSeek = 'show'
        $(this).html("Hide");
    } else {
        cacheMoi.hide();
        hideSeek ='cache'
        $(this).html("Show");
    }
});