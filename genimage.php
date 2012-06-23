<?php 
require_once('config.php');

function genKey($int) {
    $letterset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $base = strlen($letterset);
    $out = '';
    for($curpow = floor(log($int, $base)); $curpow >= 0; $curpow--) {
        $curval = pow($base, $curpow);
        $curpart = floor($int/$curval);
        $int -= $curpart * $curval;
        $out .= $letterset[$curpart];
    }
    //Pad to three characters
    for($curpad = strlen($out); $curpad <= 3; $curpad++) {
        $out = "a$out";
    }
    return $out;
}

$m = new Mongo();
$db = $m->genderbread;
$gblist = $db->genderbreads;

$newgb = array(
    'name' => $_POST['name'],
);

$outimg = imagecreatefrompng('images/template/blank.png');
imagealphablending($outimg, true);
foreach($sliders as $id => $info) {
    $handle = imagecreatefrompng("images/template/handle-$id.png");
    imagealphablending($handle, true);
    $hw = imagesx($handle);
    $hh = imagesy($handle);
    foreach(array('top','bottom') as $num => $which) {
        $val = $_POST["$id-$which"];
        $newgb["$id-$which"] = $val;

        $x = $template_data['slider_start'] + ($val/100) * ($template_data['slider_end'] - $template_data['slider_start']);
        $y = $template_data['y_vals'][$id][$num];
        
        imagecopymerge($outimg, $handle, $x,$y, 0,0,$hw,$hh, 100);
    }
    imagedestroy($handle);
}

$success = false;
$jump_ahead = 0;
while($success == false && $jump_ahead < 50) {
    $jump_ahead++;
    $link = $gblist->find()->sort(array('index' => -1))->limit(1);
    $mostrecent = $link->hasNext() ? $link->getNext() : array('index' => 1);

    $newgb['index'] = $mostrecent['index'] + $jump_ahead;
    $newgb['key'] = genKey($newgb['index']);
    $status = $gblist->insert($newgb);
    $success = ($status['err'] == null);
}

if($success) {
    $filename = $newgb['key'];
} else {
    $filename = uniqid('f_');
}

//header('Content-Type: image/png');
imagealphablending($outimg, false);
imagesavealpha($outimg, true);
imagepng($outimg, "cache/$filename.png");
imagedestroy($outimg);

header("Location: gb/$filename");
?>
