create database learnLang;
use learnLang;

CREATE TABLE words (
  id INT AUTO_INCREMENT PRIMARY KEY,
  word VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL,
  difficulty VARCHAR(255) NOT NULL,
  lang INT(11) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE words2translations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  word_1_id INT(11) NOT NULL,
  word_2_id INT(11) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE definitions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  definition TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);-- word definitions

CREATE TABLE sentences (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sentence TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
); -- example sentences

CREATE TABLE words2sentences (
  id INT AUTO_INCREMENT PRIMARY KEY,
  word_id INT(11) NOT NULL,
  sentence_id INT(11) NOT NULL,
  sort INT (11) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
); -- matching words with sentences

CREATE TABLE words2definitions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  word_id INT(11) NOT NULL,
  definition_id INT(11) NOT NULL,
  sort INT (11) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
); -- matching words with definitions

CREATE TABLE languages(
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL,
  abbreviation VARCHAR(4) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- later: synonyms, audio, images


-- special view
create view vWordsMaster as
select 
w.id, w.word, w.slug, w.difficulty, w.lang, w.created_at, w.updated_at, 

GROUP_CONCAT( distinct w2d.definition_id) defitinition_id, 
GROUP_CONCAT(distinct w2d.sort) definition_sort, 
GROUP_CONCAT(DISTINCT d.definition) definition,

GROUP_CONCAT(DISTINCT w2s.sentence_id) sentence_id, 
GROUP_CONCAT(DISTINCT w2s.sort) sentence_sort,
GROUP_CONCAT(DISTINCT s.sentence) sentence, 

GROUP_CONCAT(DISTINCT t.word) translation
from words w
left join words2definitions w2d on w.id = w2d.word_id
left join words2translations w2t on w.id = w2t.word_1_id
left join words2translations w2t2 on w.id = w2t2.word_2_id
left join words2sentences w2s on w.id = w2s.word_id
left join sentences s on s.id = w2s.sentence_id
left join definitions d on d.id = w2d.definition_id
left join words t on w2t.word_2_id = t.id or w2t2.word_1_id = t.id
group by w.id

-- translations view
create view translations as
select t.*, w.id as word_id from words w
left join words2translations w2t on w2t.word_1_id = w.id or w2t.word_2_id = w.id
left join words t on t.id = case when w2t.word_1_id = w.id then w2t.word_2_id else w2t.word_1_id end
where t.id is not null 
