<!-- Footer -->
<?php $baseURL = esc_url(get_template_directory_uri()); ?>
<footer id="footer" class="footer divider bg-theme-colored">
    <div class="container pt-70 pb-40">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                <h4 class="widget-title line-bottom-theme-colored-2"><?php echo get_field('thong_tin', 'option')['title'] ?></h4>
                    <ul class="list angle-double-right list-border">
                        <li><a><?php echo get_field('thong_tin', 'option')['addr'] ?></a></li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone color-general mr-5"></i> 
                            <a href="tel: <?php echo get_field('thong_tin', 'option')['phone'] ?>"><?php echo get_field('thong_tin', 'option')['phone'] ?></a>
                        </li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o color-general mr-5"></i> 
                            <a href="mailto: <?php echo get_field('thong_tin', 'option')['email'] ?>"><?php echo get_field('thong_tin', 'option')['email'] ?></a> 
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <?php
                        $idPolicy = 219;
                    ?>
                    <h4 class="widget-title line-bottom-theme-colored-2"><?php echo get_field('policy', 'option')['title'] ?></h4>
                    <ul class="list angle-double-right list-border">
                        <?php
                            $current_page_id = $idPolicy;
                            $lists = get_field('policy', 'option')['list'];
                            
                            // get all the children of the current page
                            foreach($lists as $list) {
                                echo '<li><a href="'. get_the_permalink($list->ID) .'">'. $list->post_title .'</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title line-bottom-theme-colored-2"><?php echo get_field('list_cate', 'option')['title'] ?></h4>
                    <ul class="list list-border">
                        <?php
                            $listCates = get_field('list_cate', 'option')['list'];
                            if($listCates) :
                                foreach($listCates as $listCate) {
                                    $item = get_term($listCate);
                                    echo '<li><a href="'. get_term_link($item->term_id) .'">'. $item->name .'</a></li>';
                                }
                            endif;
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h4 class="widget-title line-bottom-theme-colored-2"><?php echo get_field('hotline', 'option')['title'] ?></h4>
                    <div class="opening-hours">
                        <ul class="list-border">
                            <li class="clearfix"><a><?php echo get_field('hotline', 'option')['description'] ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end wrapper -->
<!-- Footer Scripts -->
<!-- JS | Calendar Event Data -->
<?php wp_footer() ?>
<script src="<?php echo  $baseURL ?>/js/calendar-events-data.js"></script>
<!-- JS | Custom script for all pages -->
<script src="<?php echo $baseURL ?>/js/custom.js"></script>
<script>
    $(document).ready(function () {
        $('.fb-share').click(function (e) {
            e.preventDefault();
            window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
            return false;
        });
        var head = document.getElementsByTagName('body')[0];
        var lazyLoadScript = document.createElement("script");
        var lazyLoadVersion = !("IntersectionObserver" in window) ? "8.2.1" : "10.3.3";
        lazyLoadScript.src = "https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/" + lazyLoadVersion + "/lazyload.min.js";
        window.lazyLoadOptions = {data_src: "src", data_srcset: "srcset"};
        head.appendChild(lazyLoadScript);
    })
</script>

</body>
<div id="fb-root"></div>
</html>