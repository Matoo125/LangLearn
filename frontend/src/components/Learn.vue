<template>
<section class="hero">
  <div class="hero-body">
    <p class="title">
      Learn
    </p>

    <div class="columns">
      <div class="column is-4" v-if="active">
        <div class="field">
          <label class="label is-large">{{ active.translation }}</label>
          <div class="control has-icons-left has-icons-right">
            <input class="input is-large" placeholder="enter translation">
            <span class="icon is-small is-left">
              <i class="fa fa-envelope"></i>
            </span>
            <span class="icon is-small is-right">
              <i class="fa fa-check"></i>
            </span>
          </div>
        </div>

        <div class="field">
          <p class="control">
            <button class="button is-info">
              check
            </button>
          </p>
      </div>
    </div>
    </div>


  </div>

</section>
</template>

<script>
import {API} from '@/tools/Api.js'

export default {
  name: 'Learn',
  data () {
    return {
      toLearn: null,
      active: null,
      answer: null
    }
  },
  mounted: function () {
    this.loadWords()
  },
  methods: {
    loadWords () {
      API.get('words/learningList', {
        params: {
          w: 1,
          t: 2
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
      this.active = this.toLearn[Math.floor(Math.random() * this.toLearn.length)]
    },
    checkAnswer () {

    }
  }
}
</script>

<style scoped>

</style>
