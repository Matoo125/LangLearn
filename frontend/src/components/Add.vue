<template>

<div>
  <section class="hero is-primary">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">
          Add new Word
        </h1>
      </div>
    </div>
  </section>
<br>
  <div class="container">
    
    <div class="columns">
      <div class="column is-4">
        <div class="field">
          <label class="label">Word</label>
          <div class="control">
            <input class="input" type="text" v-model="form.word" placeholder="Enter the Term">
          </div>
        </div>
        <a class="button is-success" @click="checkDuplicates()">Check</a>
      </div>

      <div class="column is-4" v-show="word">

        <div class="field">
          <label class="label">Translation</label>
          <div class="control">
            <input class="input" type="text" v-model="form.translation" placeholder="Translation">
          </div>
        </div>


        <div class="field">
          <label class="label">Definition</label>
          <div class="control">
            <input class="input" type="text" v-model="form.definition" placeholder="Definition">
          </div>
        </div>

        <div class="field">
          <label class="label">Example Sentense</label>
          <div class="control">
            <input class="input" type="text" v-model="form.sentence" placeholder="Sentense">
          </div>
        </div>

        <a class="button is-success" @click="update()">Update</a>

      </div>

      <div class="column is-4">
        <div class="card" v-if="sentences">
          <div class="card-header">
            <p class="card-header-title">
              Translations
            </p>
          </div>
          <div class="card-content">
            <p v-for="translation in translations">
              {{ translation.word }}
            </p>
          </div>
        </div>

        <div class="card" v-if="sentences">
          <div class="card-header">
            <p class="card-header-title">
              Example Sentences
            </p>
          </div>
          <div class="card-content">
            <p v-for="sentence in sentences">
              {{ sentence.sentence }}
            </p>
          </div>
        </div>

        <div class="card"  v-if="definitions">
          <div class="card-header">
            <p class="card-header-title">
              Defitions
            </p>
          </div>
          <div class="card-content">
            <p v-for="definition in definitions">
              {{ definition.definition }}
            </p>
          </div>
        </div>
      </div>

    </div>  



  </div>

</div>


</template>

<script>
import {API} from '@/tools/Api.js'
import { mapMutations, mapState } from 'vuex'

export default {
  name: 'Add',
  data () {
    return {
      form: {
        word: '',
        translation: '',
        defitinition: '',
        sentence: ''
      }
    }
  },
  computed: mapState([
    'word', 'translations', 'sentences', 'definitions'
  ]),
  methods: {
    ...mapMutations([
      'set_word'
    ]),
    update () {
      this.addDefinition()
      this.addSentence()
      this.addTranslation()
    },
    addTranslation () {
      var data = new FormData()
      data.append('word_id', this.word.id)
      data.append('lang', '2')
      data.append('translation', this.form.translation)
      API.post('translations/add', data)
      .then(r => { console.log(r) })
      .catch(e => { console.log(e) })
    },
    addDefinition () {
      var data = new FormData()
      data.append('definition', this.form.definition)
      data.append('word_id', this.word.id)
      API.post('definitions/add', data)
      .then(r => { console.log(r) })
      .catch(e => { console.log(e) })
    },
    addSentence () {
      var data = new FormData()
      data.append('sentence', this.form.sentence)
      data.append('word_id', this.word.id)
      API.post('sentences/add', data)
      .then(r => { console.log(r) })
      .catch(e => { console.log(e) })
    },
    checkDuplicates () {
      var data = {
        lang: '1',
        word: this.form.word
      }
      this.$store.dispatch('find_word', data)
      .then(r => {
        alert('this word already exists')
        this.$store.dispatch('load_sentences')
        this.$store.dispatch('load_definitions')
        this.$store.dispatch('load_translations')
      })
      .catch(e => {
        this.addWord(data)
      })
    },
    addWord (data) {
      this.$store.dispatch('add_word', data)
    },
    loadTranslations () {
      // API.get('')
    },
    loadDefinitions () {

    },
    loadSentences () {
    }
  }
}
</script>

<style scoped>

</style>
