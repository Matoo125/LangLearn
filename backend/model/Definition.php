<?php 

namespace m4\wordMaster\model;

use m4\m4mvc\core\Model;

class Definition extends Model
{
  protected static $table = 'definitions';
  protected static $table2 = 'words2definitions';

  public function find ($filters)
  {
    $q = $this->query->select()
                     ->from(self::$table . ' d')
                     ->join(
                      'left', 
                      self::$table2 . ' w2d', 
                      'w2d.definition_id = d.id');
    $where = [];
    foreach ($filters as $key => $value) {
      $where[] =  $key . " = :" . $key . " "; 
    }
    $q->where(implode(' AND ', $where));
    return $this->fetch($q->build(), $filters);
  }

  public function list ($filters = null)
  {
    $q = $this->query->select()
                     ->from(static::$table . ' d');
    $q->join('left', self::$table2 . ' w2d', ' w2d.definition_id = d.id');
    $q->where(array_keys($filters));
    return $this->fetchAll($q->build(), $filters);
  }

  public function add ($data)
  {
    $q = $this->query->insert('definition')->into(self::$table);
    $definition_id = $this->save(
      $q->build(), ['definition' => $data['definition']], true
    );

    $q = $this->query->insert('word_id', 'definition_id')
                     ->insertSubquery([
                      'sort' => '(SELECT IFNULL(MAX(sort), 0) + 1 
                                  FROM words2definitions w2d 
                                  WHERE word_id = :word_id)'])
                     ->into(self::$table2);

    $this->save($q->build(), [
      'word_id' => $data['word_id'],
      'definition_id' => $definition_id,
    ]);

    return $definition_id;
  }


}