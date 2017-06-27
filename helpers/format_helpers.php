<?php
  // Format The Date
  function formatDate($date){
    return date('F j, Y, g:i a',strtotime($date));
  }

  //Section Read More
  function shortenText($text, $chars = 300 ){
    $text = $text." ";
    $text = substr($text, 0, $chars);
    $text = substr($text, 0, strrpos($text,' '));
    $text = $text.". . .";
    return $text;
  }
?>
