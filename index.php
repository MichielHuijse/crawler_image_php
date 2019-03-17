<?php

//define('ROOT_PATH' , '/Users/michiel/vsites/imagecrawler/');
if (!defined('ROOT_PATH')) define('ROOT_PATH', '/Users/michiel/vsites/imagecrawler/');

require_once(ROOT_PATH ."src/thumbnail.php");
require_once(ROOT_PATH ."src/saveFile.php");
require_once(ROOT_PATH ."src/fileNameHandler.php");
require_once(ROOT_PATH ."simple_html_dom.php"); //using PHP Simple HTML DOM Parser to get element in your link

//if(isset($_POST['submit'])){

$baseSource = 'fill in a website here';
$directory = 'fill in your local directory here';

  for ( $i = 1; $i < 20; $i++ ) {

    $domObject = file_get_html("http://www.cartermuseum.org/collections/smith/collection.php?mcat=60&scat=63&pagen={$i}");
    $image = $domObject->find("img");


  // Loop over all images.
  foreach( $image as $img ) {

      // Set variables.
      $source = $img->src;
      $name = basename( $source );

    // We only want images, nog menu links or socialbuttons.
    if (!fileNameHandler::isJpeg( $name )) {
      continue;
    }
    // Is it a thumbnail? Then got to this page and comeback.
    if (thumbnail::isThumbNail( $img )) {
        New thumbnail( $directory, $img );
        continue;
    }

    $cleanName = fileNameHandler::process( $name );
    $saveTo =  $directory . $cleanName;
    $source =  'http://www.cartermuseum.org/collections/smith/' . $source;

    new saveFile( $saveTo, $source, $cleanName );
}
  }


// Is thumbnail for another source page?
// @todo built subpage.

//    echo $result . '<br> <br>';
//    $a = `pwd`;



exit;
	
?>

<form id="form1" name="form1" method="post" action="">
  <table width="700" border="1" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2"><label for="textfield"></label>
      <input style="width:100%;" type="text" name="url" id="textfield" />
      </td>
      
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle"><input type="submit" name="submit" id="button" value="Submit" /></td>
    </tr>
  </table>
</form>
