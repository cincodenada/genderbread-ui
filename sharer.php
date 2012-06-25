<?php require_once('config.php') ?>
<?php
$gbid = $_GET['gbid'];
$saved = (substr($gbid,0,2) != 'f_');
?>
<html>
    <head>
    </head>
    <body>
        Here's your genderbread person:
        <img src="../cache/<?php echo $gbid ?>.png" />
        You can share them and things if you want.
    </body>
</html>
