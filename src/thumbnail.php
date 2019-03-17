<?php

require_once(ROOT_PATH .'index.php');
require_once(ROOT_PATH .'simple_html_dom.php');
require_once(ROOT_PATH .'src/fileNameHandler.php');
require_once(ROOT_PATH .'src/saveFile.php');

class thumbnail {

public function __construct($directory, $img) {

  $this->directory = $directory;
  $this->getSourcePage($img);

}

public static function isThumbNail($img) {
  if ($img->parent()->hasAttribute('href')) {
  return TRUE;
  }
  else return FALSE;
}


public function getSourcePage($img) {

  $subPage = $img->parent();
  $domObjectSubpage = file_get_html('http://www.cartermuseum.org/collections/smith/' . $subPage->attr['href']);
  self::getImages($domObjectSubpage);

}

  private function getImages($domObjectSubpage) {
    $imgSub = $domObjectSubpage->find("img");
    foreach ($imgSub as $img) {

      $source=$img->src;
      $name = basename($source);

      // We only want images, not menu links or socialbuttons.
      if (!fileNameHandler::isJpeg($name)) {
        continue;
      }
        $source = $img->src;
        $source =  'http://www.cartermuseum.org/collections/smith/' . $source;

      $cleanName = fileNameHandler::process($name);
      $saveTo =  $this->directory . $cleanName;
      new saveFile($saveTo, $source);
    }
  }
}