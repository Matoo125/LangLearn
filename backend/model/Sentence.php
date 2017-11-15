<?php 

namespace m4\wordMaster\model;

use m4\m4mvc\core\Model;

class Sentence extends Model
{
  protected static $table = 'sentences';
  protected static $table2 = 'words2sentences';

  public function find ($filters)
  {
    $q = $this->query->select()
                     ->from(self::$table . ' s')
                     ->join(
                        'left', 
                        self::$table2 . ' w2s', 
                        'w2s.sentence_id = s.id')
                     ->where(array_keys($filters));
    return $this->fetch($q->build(), $filters);
  }

  public function list ($filters = null)
  {
    $q = $this->query->select()
                     ->from(static::$table . ' s');
    $q->join('left', 'words2sentences w2s', ' w2s.sentence_id = s.id');
    $q->where(array_keys($filters));
    return $this->fetchAll($q->build(), $filters);
  }

 public function add ($data)
  {
    $q = $this->query->insert('sentence')->into(self::$table);
    $sentence_id = $this->save(
      $q->build(), ['sentence' => $data['sentence']], true
    );

    $q = $this->query->insert('word_id', 'sentence_id')
                     ->insertSubquery([
                      'sort' => '(SELECT IFNULL(MAX(sort), 0) + 1 
                                  FROM words2sentences w2d 
                                  WHERE word_id = :word_id)'])
                     ->into(self::$table2);

    $this->save($q->build(), [
      'word_id' => $data['word_id'],
      'sentence_id' => $sentence_id,
    ]);
    return $sentence_id;
  }



}