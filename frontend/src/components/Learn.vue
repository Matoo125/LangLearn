<template>
<div>

  <v-hero hColor="is-primary">
    Learn
  </v-hero>

  <v-wrap>
    <div class="column is-4" v-if="active">
      <v-input iPlaceholder="Enter a Translation"
                v-model="answer">{{ active.translation }}</v-input>

      <div class="field is-grouped">
        <v-button b-type="is-info"
                  :b-click="checkAnswer">Check</v-button>

        <v-button b-type="is-secondary"
                  :b-click="showAnswer">I don't know</v-button>

        <v-button b-type="is-dark"
                  :b-click="pickWord">Next</v-button>
      </div>

    </div> <!-- end column -->

    <v-note class="column is-4"
            nColor="is-info"
            v-if="note.show">{{ note.text }}</v-note>
  </v-wrap>

</div>
</template>

<script>
import {API} from '@/tools/Api.js'
import { Button, Hero, Note, Input, Wrap } from '@/ui'

export default {
  name: 'Learn',
  components: {
    'v-button': Button,
    'v-hero': Hero,
    'v-note': Note,
    'v-input': Input,
    'v-wrap': Wrap
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
      this.note.show = true
      this.note.text = this.active.word
    }
  }
}
</script>

<style scoped>

</style>
