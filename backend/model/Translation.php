<?php 
namespace m4\wordMaster\model;
use m4\m4mvc\core\Model;
use m4\m4mvc\helper\Str;

class Translation extends Model
{
  protected static $table = 'translations';

  public function add ($data)
  {
    $word = new Word();

    // check if word exists in database
    $exists = $word->find([
      'word' => $data['translation'],
      'lang' => $data['lang']
    ]);

    if ($exists) { // if not add word to db
      $translation_id = $exists['id']
    }
    else {
      $translation_id = $word->add([
        'word' => $data['translation'],
        'slug' => Str::slugify($data['translation']),
        'lang' => $data['lang'],
        'difficulty' => 10
      ]);
    }

    print_r($exists);die;
    // create connection between words
    $q = $this->query->insert('word_1_id', 'word_2_id')
                     ->into('words2translations')
                     ->build();
    $bind = [
      'word_1_id' => $data['word_id']
      'word_2_id' => $translation_id
    ];
    
    return $this->save($q, $bind);
  }

}