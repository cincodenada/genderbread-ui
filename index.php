<?php require_once('config.php') ?>
<html>
    <head>
        <link rel="stylesheet" href="css/customTheme.css"/>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/base/jquery-ui.css"/>
        <script type="text/javascript">
            $(function() {
                $('#slider').slider();
            });
        </script>
    </head>
    <body>
        <div class="wrapper">
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
                <img src="images/genderbread_man.png" id="genderbread_man"/>
                <a href="http://bit.ly/ipmgbqr"><img id="readmore" src="images/readmore.png"/></a>
            </div>
            <div id="right">
                <?php foreach($sliders as $id=>$conf): ?>
                <?php $lbl = $conf['labels']; ?>
                <div class="aspect" id="<?php echo $id ?>">
                    <h1><img src="images/<?php echo $id ?>.png" alt="<?php echo $lbl['title'] ?>"/>
                    <div class="zero">
                        <?php echo $lbl['zero'] ?>
                    </div>
                    <div class="slider_wrapper">
                        <div id="slider">
                        </div>
                        <div class="arrowhead blue">
                        </div>
                    </div>
                    <div class="presets">
                        <div class="info">
                            5 (of infinite) possible plot and label combos
                        </div>
                        <?php
                            $presets = $conf['presets'];
                            shuffle($presets);
                            if(count($presets) > 5) {
                                $presets = array_slice($presets, 0, 5);
                            }
                        ?>
                        <?php foreach($presets as $info): ?>
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
                            <div class="marker_top">
                                <img 
                                    id="top" 
                                    alt="<?php echo "{$lbl['top']}: $top" ?>" 
                                    src="images/preset_marker.png"
                                    style="left:<?php echo $bottom * 100 ?>%;"
                                />
                            </div>
                            <div class="marker_bottom">
                                <img 
                                    id="bottom" 
                                    alt="<?php echo "{$lbl['bottom']}: $bottom" ?>" 
                                    src="images/preset_marker.png"
                                    style="left:<?php echo $bottom * 100 ?>%;"
                                />
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
    </body>
</html>
