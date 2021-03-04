<?php
function debug($arr)
{
   echo '<pre>' . print_r($arr, true) . '</pre>';
}
function convertToHtmlEntities($str)
{
   return htmlspecialchars($str, ENT_QUOTES);
}

function checkDataForm($data)
{
  foreach ($data as $key => $value) {
   if (empty($data[$key])) {
      $data['empty_field'] = $key;
      return $data;
   }
     $data[$key] = trim($value);
     $data[$key] = strip_tags($value);
     $data[$key] = convertToHtmlEntities($value);
     return $data;
  }
}

