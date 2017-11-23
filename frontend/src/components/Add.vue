<template>

<div>
  <v-hero hColor="is-primary">Manage words</v-hero>
<br>
  <div class="container">
    
    <div class="columns">
      <div class="column is-4">
        
        <v-input iPlaceholder="Enter a Term"
                 v-model="form.word">Word</v-input>

        <v-note n-color="is-primary" v-if="note.show">
          {{ note.text }}
        </v-note>

        <v-button b-type="is-success"
                  :b-click="checkDuplicates">Check</v-button>
      </div>

      <div class="column is-4" v-show="word">
        <v-input iPlaceholder="Translation"
                 v-model="form.translation">Add a Translation</v-input>
        <v-input iPlaceholder="Definition"
                 v-model="form.definition">Add a Definition</v-input>
        <v-input iPlaceholder="Sentence"
                 v-model="form.sentence">Add a Sentence</v-input>
        <v-button b-type="is-success"
                  :b-click="update">Update</v-button>
      </div>

      <div class="column is-4">

        <v-card v-if="translations">
          <div slot="title">Translations</div>
          <div slot="content">
            <p v-for="translation in translations">
              {{ translation.word }}
            </p>
          </div>
        </v-card> <!-- end card translations -->

        <v-card v-if="sentences">
          <div slot="title">Sentences</div>
          <div slot="content">
            <p v-for="sentence in sentences">
              {{ sentence.sentence }}
            </p>
          </div>
        </v-card> <!-- end card sentences -->

        <v-card v-if="definitions">
          <div slot="title">Definitions</div>
          <div slot="content">
            <p v-for="definition in definitions">
              {{ definition.definition }}
            </p>
          </div>
        </v-card> <!-- end card definitions -->

      </div> <!-- end column -->
    </div>  <!-- end columns -->
  </div> <!-- end container -->
</div>


</template>

<script>
import {API} from '@/tools/Api.js'
import { mapMutations, mapState } from 'vuex'
import { Button, Hero, Note, Card, Input } from '@/ui'

export default {
  name: 'Add',
  components: {
    'v-button': Button,
    'v-hero': Hero,
    'v-note': Note,
    'v-card': Card,
    'v-input': Input
  },
  data () {
    return {
      note: {
        show: false,
        text: 'Word has been found'
      },
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
      data.append('lang', this.$store.state.config.knownLang)
      data.append('translation', this.form.translation)
      API.post('translations/add', data)
      .then(r => {
        console.log(r)
        this.$store.dispatch('load_translations')
      })
      .catch(e => { console.log(e) })
    },
    addDefinition () {
      var data = new FormData()
      data.append('definition', this.form.definition)
      data.append('word_id', this.word.id)
      API.post('definitions/add', data)
      .then(r => {
        console.log(r)
        this.$store.dispatch('load_definitions')
      })
      .catch(e => { console.log(e) })
    },
    addSentence () {
      var data = new FormData()
      data.append('sentence', this.form.sentence)
      data.append('word_id', this.word.id)
      API.post('sentences/add', data)
      .then(r => {
        console.log(r)
        this.$store.dispatch('load_sentences')
      })
      .catch(e => { console.log(e) })
    },
    checkDuplicates () {
      var data = {
        lang: this.$store.state.config.learnLang,
        word: this.form.word
      }
      this.$store.dispatch('find_word', data)
      .then(r => {
        this.note.show = true
        this.note.text = 'Word has been found'
        this.$store.dispatch('load_sentences')
        this.$store.dispatch('load_definitions')
        this.$store.dispatch('load_translations')
      })
      .catch(e => {
        this.note.show = true
        this.note.text = 'Word has been added'
        this.addWord(data)
      })
    },
    addWord (data) {
      this.$store.dispatch('add_word', data)
    }
  }
}
</script>

<style scoped>

</style>
