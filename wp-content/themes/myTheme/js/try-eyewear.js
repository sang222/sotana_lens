(function ($) {
    "use strict";
    var w = $('.pictureRender').width(),
        h = $('.pictureRender').height();

    $('#webcam').click(function () {
        Webcam.set({
            width: w,
            height: h,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('.pictureRender');
        if (!$('.pictureRender').is(':empty')) {
            $('#takePicture').show()
        }
    })
    $('#takePicture').click(function () {
        Webcam.snap(function (data_uri) {
            // display results in page
            console.log(data_uri)
            $('.pictureRender').empty();
            $('.pictureRender').append('<img src="' + data_uri + '" />')
        });
    })

    $('.draggable').each(function (i, el) {
        var $drag = $(el);
        var $handle = $("<div class='resize-handle'></div>").appendTo($drag);
        TweenLite.set($handle, {
            top: $drag.width(),
            left: $drag.height()
        });
        //TweenLite.set($drag, { left: newleft+10 });

        Draggable.create($drag);

        Draggable.create($handle, {
            type: "top,left",
            onPress: function (e) {
                e.stopPropagation(); // cancel drag
            },
            onDrag: function (e) {
                //var $this = $(this._eventTarget),
                //    myImg = $this.parent().find("img");
                //console.log(myImg);
                TweenLite.set(this.target.parentNode, {
                    width: this.x,
                    height: this.y
                });
            }
        });
    });
})(jQuery)