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
        echo "<script>alert('Заполните поле ввода!');</script>";
     }
     $data[$key] = trim($value);
     $data[$key] = strip_tags($value);
     $data[$key] = h($value);
   //   strip_tags($data[$key]);
     return $data;
  }

}
  function addCommentInDb($comment, $id_post)
  {
     $res_insert = \R::exec("INSERT INTO comments (id_post, author, mail, comment) VALUES (?,?,?,?)", [$id_post, $comment['userName'], $comment['email'],  $comment['comment']]);
   //   echo 'ky-ky';
   // var_dump($res_insert);
   if ($res_insert == 1) {
      echo "<script>alert('Комментарий отправлен на проверку!');</script>";
      header('Refresh: 1');
   } else {
      echo "<script>alert('При отправке комментария произошла ошибка!');</script>";
   }

  }

  function search($search)
  {
   //разбить на массив по пробелу
   $array_search = explode(" ", trim($search['search']));
   debug($array_search);
  //задать макс длину запроса и мин 1символ ????

  //все данные из бд
  $arr_title_bd = \R::getAll("SELECT `title`, `id` from `posts_content`");
   //  debug(array_values($arr_title_bd));
   // debug( $arr_title_bd);

  //проверить в бд по title в постах совпадение с запросом  и учесть по одной букве запрос
  //слово |  строка(title)
  foreach ($array_search as $ind => $word) {
    //select * from posts_content
   //  echo 'ищем  ' . strval($word);
   //  debug($arr_title_bd);
    
    foreach ($arr_title_bd as $key => $value) {
      $arr_matches = [];
      //    echo '<br>';

      //  echo 'где ищем: ';
      // $titles = array_values($arr_title_bd[$key]);
      $titles =($arr_title_bd[$key]['title']);
      // debug($titles);
      $find_symbol =  stripos(($titles), strval($word));
      // $find_symbol =  strrpos($titles[0], strval($word));
      if ($find_symbol) {
         $find_post = R::getRow("SELECT * FROM `posts_content` WHERE id=? LIMIT 1", [$arr_title_bd[$key]['id']]);
         $arr_matches[] = $find_post ;
         // echo $arr_title_bd[$key]['id']; //id КОТ НУЖНО ЗАПОМНИТЬ ЧТОБЫ ФОРМИРОВАТЬ МАССИВ ИЗ ЭТИХ ПОСТОВ
         // echo "буква {$word} найдена в строке {$arr_title_bd[$key]['title']}!";
         // debug($arr_title_bd);
      }
      // debug($arr_matches);
      //НЕ ИЩЕТ С НУЛЕВОГО СИМВОЛА!!!!!!!!!!!!!!!
    }

   //  debug(array_keys($arr_title_bd[$ind ], $word));
  }
  debug($arr_matches);
  if (!$arr_matches) {
   echo 'постов не найдено!';
  } else {
     echo 'посты найдены';
  }
  //совпадения добавлять в массив

  }
