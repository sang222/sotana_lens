(function($){"use strict";var w=$('.pictureRender').width(),h=$('.pictureRender').height();var genName=new Date().getTime();$('#download').click(function(){{$('.resize-handle').addClass('hiddenResize')
html2canvas($('#exportImage')[0],{onrendered:function(canvas){var url=canvas.toDataURL();console.log(url)
$("<a>",{href:url,download:"sonata_"+genName+"_try"}).on("click",function(){$(this).remove()}).appendTo("body")[0].click()}})}})
$('#webcam').click(function(){$('.resize-handle').removeClass('hiddenResize')
Webcam.set({width:w,height:h,image_format:'jpeg',jpeg_quality:90});Webcam.attach('.pictureRender');if(!$('.pictureRender').is(':empty')){$('#takePicture').show()}})
$('#takePicture').click(function(){Webcam.snap(function(data_uri){console.log(data_uri)
$('.pictureRender').empty();$('.pictureRender').append('<img src="'+data_uri+'" />')});})
$('.draggable').each(function(i,el){var $drag=$(el);var $handle=$("<div class='resize-handle'></div>").appendTo($drag);TweenLite.set($handle,{top:$drag.width(),left:$drag.height()});Draggable.create($drag);Draggable.create($handle,{type:"top,left",onPress:function(e){e.stopPropagation();},onDrag:function(e){TweenLite.set(this.target.parentNode,{width:this.x,height:this.y});}});});})(jQuery);