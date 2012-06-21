<?php require_once('config.php') ?>
<html>
    <head>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/base/jquery-ui.css"/>
        <link href='http://fonts.googleapis.com/css?family=Neucha' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/style.css"/>

        <script type="text/javascript">
            $(function() {
                //Slidify!
                $('.slider').slider({
                    create: function(evt, ui) {
                        contdiv = $(evt.target);
                        formtype = contdiv.closest('.aspect').attr('id');
                        formpos = contdiv.closest('.slider').hasClass('top') ? 'top' : 'bottom';
                        inputelm = $('<input type="hidden" value="0"/>').attr('name',formtype + '-' + formpos);
                        contdiv.append(inputelm);
                    },
                    change: function(evt, ui) {
                        $(ui.handle).siblings('input').val(ui.value);
                    }
                });

                //Make the buttons work
                $('#sharebox li#export a').click(function() {
                    $('#slider_form').submit();
                });
                $('#sharebox li#link a').click(function() {
                    data = $('#slider_form').serialize();
                    $('#slider_form').submit();
                });
                $('.preset_box').click(function() {
                    presetbox = $(this);
                    sliderbox = presetbox.closest('.aspect').find('.sliders');
                    sliderbox.find('.top').slider('value',presetbox.find('.top').data('value')*100);
                    sliderbox.find('.bottom').slider('value',presetbox.find('.bottom').data('value')*100);
                });
            });
        </script>

        <style>
            /* Generated styles for aspect colors */
            <?php foreach($sliders as $id=>$conf): ?>
            #<?php echo $id ?> .slider_wrapper .ui-slider,
            #<?php echo $id ?> .preset_box
            {
                background: <?php echo $conf['color'] ?>
            }
            #<?php echo $id ?> .masked,
            #<?php echo $id ?> .slider_wrapper .ui-slider .ui-slider-handle 
            {
                background-color: <?php echo $conf['color'] ?>
            }
            #<?php echo $id ?> .presets .info
            {
                color: <?php echo $conf['color'] ?>
            }
            <?php endforeach; ?>
        </style>
    </head>
    <body>
        <img id="onion" style="display:none;" src="images/Genderbread-2.1.png"/>
        <div id="wrapper">
            <div id="top">
                <h1>The Genderbread Person v2.0</h1>
                <h2>by itspronouncedmetrosexual.com and cincodenada</h2>
            </div>
            <div id="left">
                <div class="infobox">
                    Gender is one of those things everyone thinks they understand, but most people don't.
                    Like <em>Inception</em>.  Gender isn't binary.  It's not either/or.
                    In many cases it's both/and.  A bit of this, a dash of that.
                    This tasty little guide is meant to be an appetizer for understanding.
                    It's okay if you're hungry for more.
                </div>
                <img src="images/genderbread_person.png" id="genderbread_person"/>
                <a href="http://bit.ly/ipmgbqr"><img id="readmore" src="images/readmore.png"/></a>
            </div>
            <div id="right">
                <form id="slider_form" method="post" action="genimage.php" target="_blank">
                <?php foreach($sliders as $id=>$conf): ?>
                <?php $lbl = $conf['labels']; ?>
                <div class="aspect" id="<?php echo $id ?>">
                    <h1><img src="images/<?php echo $id ?>.png" alt="<?php echo $lbl['title'] ?>"/></h1>
                    <div class="zero">
                        <?php echo $lbl['zero'] ?>
                        <span class="brace">{</span>
                    </div>
                    <div class="sliders">
                        <div class="slider_wrapper">
                            <div class="slider top"></div>
                        </div>
                        <div class="arrowhead masked"></div>
                        <div class="label">
                            <?php echo $lbl['top'] ?>
                        </div>
                        <div class="slider_wrapper">
                            <div class="slider bottom"></div>
                        </div>
                        <div class="arrowhead masked"></div>
                        <div class="label">
                            <?php echo $lbl['bottom'] ?>
                        </div>
                    </div>
                    <div class="presets">
                        <div class="info">
                            5 (of infinite) possible plot and label combos
                        </div>
                        <?php
                            $presets = array();
                            $preset_list = array_keys($conf['presets']);

                            shuffle($preset_list);
                            if(count($preset_list) > 5) {
                                $preset_list = array_slice($preset_list, 0, 5);
                            }

                            $keys = array_keys($preset_default);
                            foreach($preset_list as $label) {
                                $vals = $conf['presets'][$label];
                                $presets[$label] = array_combine(
                                    array_slice($keys, 0, count($vals)),
                                    $vals
                                );
                            }
                        ?>
                        <div class="box_wrapper">
                            <?php foreach($presets as $label=>$info): ?>
                            <?php
                                //Add some randomness
                                $info = array_merge($preset_default, $info);
                                $rand = $info['rand'] * 100;
                                $top = $info['top'] + mt_rand(-$rand, $rand)/100;
                                $bottom = $info['bottom'] + mt_rand(-$rand, $rand)/100;

                                //Ensure we're between zero and one
                                $top = max(0,min(1,$top));
                                $bottom = max(0,min(1,$bottom));
                            ?>
                            <div class="preset_box">
                            <div class="marker top" data-value="<?php echo $top ?>">
                                    <img 
                                        class="star" 
                                        alt="<?php echo "{$lbl['top']}: $top" ?>" 
                                        src="images/preset_star_top.png"
                                        style="left:<?php echo $top * 100 ?>%;"
                                    />
                                </div>
                                <div class="marker bottom" data-value="<?php echo $bottom ?>">
                                    <img 
                                        class="star" 
                                        alt="<?php echo "{$lbl['bottom']}: $bottom" ?>" 
                                        src="images/preset_star_bottom.png"
                                        style="left:<?php echo $bottom * 100 ?>%;"
                                    />
                                </div>
                                <div class="label">
                                    "<?php echo $label ?>"
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <?php endforeach; ?>
                </form>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div id="sharebox">
            <div id="content">
                <div class="tabcontent" id="content_export">
                </div>
                <div class="tabcontent" id="content_facebook">
                </div>
                <div class="tabcontent" id="content_tumblr">
                </div>
                <div class="tabcontent" id="content_twitter">
                </div>
            </div>
            <div id="tabs">
                <ul>
                    <li id="export">
                        <a href="#export">
                            <img src="images/share/export.png"/>
                        </a>
                    </li>
                    <li id="link">
                        <a href="#link">
                            <img src="images/share/link.png"/>
                        </a>
                    </li>
                    <li id="share" class="divider">
                        SHARE:
                    </li>
                    <li id="facebook">
                        <a href="#facebook">
                            <img src="images/share/facebook.png"/>
                        </a>
                    </li>
                    <li id="tumblr">
                        <a href="#tumblr">
                            <img src="images/share/tumblr.png"/>
                        </a>
                    </li>
                    <li id="twitter">
                        <a href="#twitter">
                            <img src="images/share/twitter.png"/>
                        </a>
                    </li>
                </ul> 
            </div>
        </div>
    </body>
</html>
