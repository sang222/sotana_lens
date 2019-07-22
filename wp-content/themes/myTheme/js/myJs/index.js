function openProTabs(index, $this) {
    $(".pro-tablinks").removeClass('active');
    $($this).addClass('active');
    $(".collection").fadeOut(500)
    $(".colection-" + index).fadeIn(1500)
}
$(document).ready(function() {
    $('.collapse.in').prev('.panel-heading').addClass('active');
    $('#accordion, #bs-collapse')
        .on('show.bs.collapse', function(a) {
            $(a.target).prev('.panel-heading').addClass('active');
        })
        .on('hide.bs.collapse', function(a) {
            $(a.target).prev('.panel-heading').removeClass('active');
        });
});