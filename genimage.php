<?php 
require_once('config.php');

/**
 * genKey 
 * Generates a four-character minimum key based on an integer
 * This is pretty much just zero-padded Base64, but with 52 (26*2)
 * characters instead.  And it's a-padded, since a is zero.
 *
 * The goal is to get a nice-looking, short, unique key to tag onto
 * URLs to refer to individual genderbreads.
 * 
 * @param mixed $int The id number to transform into a key
 * @param int $padding The number of "digits" to pad to
 * @access public
 * @return string A padded key that maps to the given integer
 */
function genKey($int, $padding = 3) {
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
    for($curpad = strlen($out); $curpad <= $padding; $curpad++) {
        $out = "a$out";
    }
    return $out;
}

//Initialize MongoDB
$m = new Mongo();
$db = $m->genderbread;
$gblist = $db->genderbreads;

$newgb = empty($_GET['key']);
if($newgb) {
    $newgb = true;
    //Pull in the values we want from POST
    $gbdata = array_intersect_key(
        $_POST,
        array_flip(array('name'))
    );
    //Fill out the $gbdata array
    foreach($sliders as $id => $info) {
        foreach(array('top','bottom') as $which) {
            $gbdata['handles'][$id][$which] = $_POST["$id-$which"];
        }
    }
} else {
    $gbdata = $gblist->findOne(array('key' => $_GET['key']));
}

//Generate the image from the $gbdata array
$outimg = imagecreatefrompng('images/template/blank.png');
imagealphablending($outimg, true);
foreach($gbdata['handles'] as $id => $valarr) {
    $handle = imagecreatefrompng("images/template/handle-$id.png");
    imagealphablending($handle, true);
    $hw = imagesx($handle);
    $hh = imagesy($handle);
    $yvals = array_combine(array('top','bottom'),$template_data['y_vals'][$id]);
    foreach($valarr as $which => $val) {
        $x = $template_data['slider_start'] + ($val/100) * ($template_data['slider_end'] - $template_data['slider_start']);
        $y = $yvals[$which];
        
        imagecopymerge($outimg, $handle, $x,$y, 0,0,$hw,$hh, 100);
    }
    imagedestroy($handle);
}

if($newgb) {
    //If it was a new genderbread, save it to the db
    $success = false;
    $jump_ahead = 0;
    $gbdata['created'] = time();
    while($success == false && $jump_ahead < 50) {
        $jump_ahead++;
        $link = $gblist->find()->sort(array('index' => -1))->limit(1);
        $mostrecent = $link->hasNext() ? $link->getNext() : array('index' => 1);

        $gbdata['index'] = $mostrecent['index'] + $jump_ahead;
        $gbdata['key'] = genKey($gbdata['index']);
        $status = $gblist->insert($gbdata);
        $success = ($status['err'] == null);
    }
}

if($newgb && !$success) {
    $filename = uniqid('f_'); //Generate a failed-save filename
} else {
    $filename = $gbdata['key'];
}

//Combine and save the image
imagealphablending($outimg, false);
imagesavealpha($outimg, true);
imagepng($outimg, "cache/$filename.png");

if($newgb) {
    //If it's a new genderbread, redirect them
    //to their genderbread page
    imagedestroy($outimg);
    header("Location: gb/$filename");
} else {
    //We could redirect to the image, but might as well just 
    //dump it here and save a redirect
    header('Content-Type: image/png');
    imagepng($outimg);
    imagedestroy($outimg);
}
?>
