<?php 
require_once('config.php');

$outimg = imagecreatefrompng('images/template/blank.png');
imagealphablending($outimg, true);
foreach($sliders as $id => $info) {
    $handle = imagecreatefrompng("images/template/handle-$id.png");
    imagealphablending($handle, true);
    $hw = imagesx($handle);
    $hh = imagesy($handle);
    foreach(array('top','bottom') as $num => $which) {
        $val = $_POST["$id-$which"];
        $x = $template_data['slider_start'] + ($val/100) * ($template_data['slider_end'] - $template_data['slider_start']);
        $y = $template_data['y_vals'][$id][$num];
        
        imagecopymerge($outimg, $handle, $x,$y, 0,0,$hw,$hh, 100);
    }
    imagedestroy($handle);
}

header('Content-Type: image/png');
imagealphablending($outimg, false);
imagesavealpha($outimg, true);
imagepng($outimg);

imagedestroy($outimg);
?>
