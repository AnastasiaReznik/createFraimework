<?php
function debug($arr)
{
   echo '<pre>' . print_r($arr, true) . '</pre>';
}
function h($str)
{
   return htmlspecialchars($str, ENT_QUOTES);
}

function checkDataForm($data)
{
  foreach ($data as $key => $value) {
     if (empty($value)) {
      $data['error'] = "Необходимо заполнить поле ";
      $data['empty_field'] = 'comment';
      return $data;
     }
     $data[$key] = trim($value);
     $data[$key] = strip_tags($value);
     $data[$key] = h($value);
      return $data;
  }
}

