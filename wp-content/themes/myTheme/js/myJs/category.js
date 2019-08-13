$(document).ready(function () {
    toggleFilter();
})

function toggleFilter() {
    $(".filter-list h5").click(function () {
        $(this).next().toggleClass('d-none')
        $(this).find('span i').toggleClass('fa-angle-right').toggleClass('fa-angle-down')
    })
}