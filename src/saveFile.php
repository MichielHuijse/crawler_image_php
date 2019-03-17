<?php

class saveFile {

public function __construct( $saveTo, $source, $cleanName ) {

$this->save( $saveTo, $source, $cleanName );
}

  public function save ( $saveTo, $source, $cleanName ) {
    try {
      file_put_contents($saveTo, file_get_contents($source));
      echo ('<br>' . $cleanName . '<br>');
    } catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
  }
}