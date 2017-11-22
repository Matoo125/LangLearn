<?php 

namespace m4\wordMaster\model;

use m4\m4mvc\core\Model;

class Word extends Model
{
  protected static $table = 'words';

  public function learningList ($filters)
  {
    $sql = "SELECT 
            w.id,
            w.word,
            w.difficulty,
            GROUP_CONCAT(distinct t.id) as translation_id,
            GROUP_CONCAT(distinct t.word) as translation

            from words w

            left join words2translations w2t1 
              on w.id = w2t1.word_1_id
            left join words2translations w2t2 
              on w.id = w2t2.word_2_id

            left join words t 
              on w2t1.word_2_id = t.id or 
                 w2t2.word_1_id = t.id


            where w.lang = :w and 
                  t.lang = :t
            group by w.id";
      return $this->fetchAll($sql, $filters);
  }
}

/*
select 
w.id,
w.word,
w.difficulty,
GROUP_CONCAT(distinct t.id) as translation_id,
GROUP_CONCAT(distinct t.word) as translation

from words w

left join words2translations w2t1 on w.id = w2t1.word_1_id
left join words2translations w2t2 on w.id = w2t2.word_2_id

left join words t on w2t1.word_2_id = t.id or w2t2.word_1_id = t.id


where w.lang = 2 and t.lang = 1

group by w.id
 */