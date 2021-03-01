<?php
namespace app\models;
class Search extends AppModel
{
//в модель пост, а вызов в контрол арр
         public function search($search)
         {
         //разбить на массив по пробелу
        //  debug($search);
         $array_search = explode(" ", trim($search['search']));
         // debug($array_search);
         
         //задать макс длину запроса и мин 1символ ????
     
         //все данные из бд
         $arr_title_bd = \R::getAll("SELECT `title`, `id` from `posts_content`");
         //  debug(array_values($arr_title_bd));
        //  debug($arr_title_bd);
     
         //проверить в бд по title в постах совпадение с запросом  и учесть по одной букве запрос
         //слово |  строка(title)
         $arr_matches = [];
         foreach ($array_search as $ind => $word) {
             //select * from posts_content
         //  echo 'ищем  ' . strval($word);
         //  debug($arr_title_bd);
             foreach ($arr_title_bd as $key => $value) {
             //    echo '<br>';
             //  echo 'где ищем: ';
             // $titles = array_values($arr_title_bd[$key]);
             $titles =($arr_title_bd[$key]['title']);
            //  debug($titles);
            //  echo 'ключ:  ' . ($key);
             $find_symbol = stripos(($titles), strval($word));
            //  debug($find_symbol);
             // $find_symbol =  strrpos($titles[0], strval($word));
             if ($find_symbol) {
                 
                //  debug($find_symbol);
                // echo 'true';
                 $find_post = \R::getRow("SELECT * FROM `posts_content` WHERE id = ? LIMIT 1", [$arr_title_bd[$key]['id']]);
                //  echo 'найденный пост:  ';
                //  debug($find_post);
                 $arr_matches[] = $find_post;
                //  debug($arr_matches);
                //  echo $arr_title_bd[$key]['id']; //id КОТ НУЖНО ЗАПОМНИТЬ ЧТОБЫ ФОРМИРОВАТЬ МАССИВ ИЗ ЭТИХ ПОСТОВ
                //  echo "буква {$word} найдена в строке {$arr_title_bd[$key]['title']}!";
                //  debug($arr_title_bd);
             }

         }
        //  debug(array_keys($arr_title_bd[$ind ], $word));
       }
    //    debug($arr_matches);
       return $arr_matches;
       }

}
