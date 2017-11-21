<template>
<section class="hero">
  <div class="hero-body">
    <p class="title">
      List
    </p>

    <ul>
      <li v-for="word in words">{{ word.word }}</li>
    </ul>

  </div>
</section>
</template>

<script>
// import axios from 'axios'
import {API} from '@/tools/Api.js'
export default {
  name: 'List',
  data () {
    return {
      words: null
    }
  },
  mounted: function () {
    if (this.words == null) this.loadWords()
  },
  methods: {
    loadWords () {
      API.get('words/list')
      .then(r => {
        console.log(r)
        this.words = r.data.words
      })
      .catch(e => { console.log(e) })
    }
  }
}
</script>

<style scoped>
</style>
