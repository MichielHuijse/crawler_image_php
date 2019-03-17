<?php


class fileNameHandler {

  public static function process($name){

   $name = fileNameHandler::trimEndAfterJpegName($name);
    if(strlen($name) > 50) {
   $name = fileNameHandler::shortenJpegName($name);
   }
   return $name = fileNameHandler::cleanUpFileName($name);

  }

  public static function isJpeg($img_name) {
    if (strpos ( $img_name ,'.jpg' )) {
      // echo ('<br> JPEG<br>');
      return TRUE;
    }
    /// echo ('<br> GEEN JPEG <br>');
    return FALSE;

  }

  private static function trimEndAfterJpegName($img_name) {
    $img_name = substr ( $img_name, 0 , (strpos ( $img_name ,'.jpg' )+4));
    return $img_name;
  }

  private static function shortenJpegName($img_name) {
    return $img_name = substr($img_name, 0, 50).'.jpg';
  }

  private static function cleanUpFileName($img_name) {
    $bad = array_merge(
      array_map('chr', range(0,31)),
      array("<", ">", ":", '"', "/", "\\", "|", "?", "*"));
    return $img_name = str_replace($bad, "", $img_name);
  }
}