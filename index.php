<?php require_once('config.php') ?>
<html>
    <head>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/base/jquery-ui.css"/>

        <link rel="stylesheet" href="css/customTheme.css"/>

        <script type="text/javascript">
            $(function() {
                $('.slider').slider();
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
            #<?php echo $id ?> .slider_wrapper .ui-slider .ui-slider-handle {
                background-color: <?php echo $conf['color'] ?>
            }
            <?php endforeach; ?>
        </style>
    </head>
    <body>
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
                                <div class="marker">
                                    <img 
                                        class="star" 
                                        alt="<?php echo "{$lbl['top']}: $top" ?>" 
                                        src="images/preset_star_top.png"
                                        style="left:<?php echo $top * 100 ?>%;"
                                    />
                                </div>
                                <div class="marker">
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
                </div>
                <?php endforeach; ?>
            </div>
            <div style="clear:both;"></div>
        </div>
    </body>
</html>
