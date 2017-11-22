Application for Learning Languages

Notes:
http://www.sk-spell.sk.cx/thesaurus/

select all words from lang 1 which have translation in lang 2

```
select 
w.id,
w.word,
w.difficulty,
w.lang,
t.id as translation_id,
t.word as translation,
t.lang as translation_lang

from words w

left join words2translations w2t1 on w.id = w2t1.word_1_id
left join words2translations w2t2 on w.id = w2t2.word_2_id

left join words t on w2t1.word_2_id = t.id or w2t2.word_1_id = t.id


where w.lang = 2 and t.lang = 1



```