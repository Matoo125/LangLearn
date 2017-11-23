<template>
<div>

  <v-hero hColor="is-primary">
    Learn
  </v-hero>

  <div class="container">
    <section class="section">
      <div class="columns">
        <div class="column is-4" v-if="active">
          <div class="field">
            <label class="label is-large">
              {{ active.translation }}
            </label>
            <div class="control">
              <input v-model="answer" 
                     class="input is-large" 
                     placeholder="enter translation">
            </div>
          </div>

          <div class="field is-grouped">
            <v-button b-type="is-info" 
                      :b-click="checkAnswer">check</v-button>

            <v-button b-type="is-secondary" 
                      :b-click="showAnswer">I don't know</v-button>
          </div>
          
        </div> <!-- end column -->

        <v-note class="column is-4" 
                nColor="is-info" 
                v-if="note.show">{{ note.text }}</v-note>

      </div> <!-- end columns -->
    </section>
  </div> <!-- end container -->

</div>
</template>

<script>
import {API} from '@/tools/Api.js'
import { Button, Hero, Note } from '@/ui'

export default {
  name: 'Learn',
  components: {
    'v-button': Button,
    'v-hero': Hero,
    'v-note': Note
  },
  data () {
    return {
      toLearn: null,
      active: null,
      answer: null,
      note: {
        show: false,
        text: ''
      }
    }
  },
  mounted: function () {
    this.loadWords()
  },
  methods: {
    loadWords () {
      API.get('words/learningList', {
        params: {
          w: this.$store.state.config.knownLang,
          t: this.$store.state.config.learnLang
        }
      })
      .then(r => {
        console.log(r)
        this.toLearn = r.data.learningList
        this.pickWord()
      })
      .catch(e => { console.log(e) })
    },
    pickWord () {
      let items = this.toLearn.length
      this.active = this.toLearn[Math.floor(Math.random() * items)]
    },
    checkAnswer () {
      this.note.show = true
      if (this.answer === this.active.word) {
        this.note.text = 'correct'
        console.log('correct')
      } else {
        this.note.text = 'incorrect'
        console.log('incorrect')
      }
    },
    showAnswer () {

    }
  }
}
</script>

<style scoped>

</style>
