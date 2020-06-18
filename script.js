let hideSeek = 'cache';
let tr = $('.hidden');
tr.hide()
$("#cache").click(function(){
    if (hideSeek == 'cache') {
        tr.show();
        hideSeek = 'show'
    } else {
        tr.hide();
        hideSeek ='cache'
    }
});