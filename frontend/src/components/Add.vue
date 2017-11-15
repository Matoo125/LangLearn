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

      <div class="column is-4" v-show="extraFields">

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
        
      </div>

    </div>  



  </div>

</div>


</template>

<script>
import axios from 'axios'
export default {
  name: 'Add',
  data () {
    return {
      form: {
        word: '',
        translation: '',
        defitinition: '',
        sentence: ''
      },
      word: null,
      defitinitions: null,
      sentences: null,
      translations: null,
      extraFields: false
    }
  },
  methods: {
    update () {
      this.addDefinition()
      this.addSentence()
    },
    addDefinition () {
      var data = new FormData()
      data.append('definition', this.form.definition)
      data.append('word_id', this.word)
      axios.post(process.env.API + 'definitions/add', data)
      .then(r => { console.log(r) })
      .catch(e => { console.log(e) })
    },
    addSentence () {
      var data = new FormData()
      data.append('sentence', this.form.sentence)
      data.append('word_id', this.word)
      axios.post(process.env.API + 'sentences/add', data)
      .then(r => { console.log(r) })
      .catch(e => { console.log(e) })
    },
    addTranslation () {},
    checkDuplicates () {
      axios.get(process.env.API + 'words/find', {
        params: {
          lang: '1',
          word: this.form.word
        }
      }).then(r => {
        console.log(r)
        if (!r.data.word) {
          this.addWord()
        } else {
          alert('this word already exists')
        }
      }).catch(e => { console.log(e) })
    },
    addWord () {
      var data = new FormData()
      data.append('lang', 1)
      data.append('word', this.form.word)
      axios.post(process.env.API + 'words/add', data)
      .then(r => {
        console.log(r)
        this.word = r.data.id
        this.extraFields = true
      }).catch(e => { console.log(e) })
    },
    loadTranslations () {
      // axios.get(process.env.API + '')
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
