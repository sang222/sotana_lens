<?php
get_header();
$list_try = get_field('try-eye', $_GET['id_lens']);
$img_try = $list_try['url'];
$baseURL = esc_url(get_template_directory_uri());
?>
    <div class=" breadcrumb-colect" style="padding: 5px 0px 65px 0px">
        <div class="fixed-width content-breadcrum">
            <div class="pro-title-breadcrumb text-center">
                <h4><?php echo the_title() ?></h4>
            </div>
            <div class="text-center">
                <nav class="woocommerce-breadcrumb">
                    <a href="<?php echo get_site_url() ?>"><?php echo __('Home', 'localFile') ?></a>&nbsp;&#47;&nbsp;<?php echo the_title() ?></nav>
            </div>
        </div>
    </div>
    <div class="container content-try">
        <div class="row content-try-in">
            <div class="col-md-12 text-center header-try">
                <h5 class="title-try" style="margin-bottom: 30px"><?php echo __('Bạn đang thử', 'localFile') ?> &nbsp;&nbsp;<span
                            class="text-uppercase "><a class="color-secondary" href="<?php echo get_permalink($_GET['id_lens']) ?>"> <?php echo get_the_title($_GET['id_lens']) ?></a>
                </h5></span>
            </div>
            <div class="col-md-2 col-left left-try" >
                <div class="boxTry" id="webcam">
                    <i class="fa fa-camera" aria-hidden="true"></i>
                </div>
                <p class="text-center"><?php echo __('Take a picture', 'localFile') ?></p>
                <div class="boxTry" id="uploadPicture">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                    <input type="file" class="uploadInput" onchange="onFileSelected(event)">
                </div>
                <p class="text-center"><?php echo __('Upload a picture', 'localFile') ?></p>
                <a class="boxTry" id="download" download>
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                </a>
                <p class="text-center"><?php echo __('Download', 'localFile') ?></p>
            </div>
            <div class="col-md-10 col-right">
                <div id="exportImage">
                    <div class="pictureRender">
                        <img src="<?php echo $baseURL ?>/images/myimage/other/modal.jpg">
                    </div>
                    <div id="imageProduct" class="draggable">
                        <img src="<?php echo $img_try ?>" style=alt="">
                        <div class="resize-handle"></div>
                    </div>
                </div>
                <button id="takePicture" style="display: none"><?php echo __('Take picture', 'localFile') ?></button>
            </div>
        </div>
    </div>
    <script>
        function onFileSelected(event) {
            $('.resize-handle').removeClass('hiddenResize')
            var w = $('.pictureRender').width(),
                h = $('.pictureRender').height();
            var selectedFile = event.target.files[0];
            var reader = new FileReader();
            console.log(selectedFile)
            var imgtag = $('.pictureRender');

            reader.addEventListener("load", function () {
                imgtag.empty()
                imgtag.append('<img src="' + reader.result + '" />')
            }, false);

            reader.readAsDataURL(selectedFile);
        }
    </script>
<?php get_footer() ?>