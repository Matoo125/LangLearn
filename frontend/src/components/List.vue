<template>

<div>
  <section class="hero is-success">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">
          List
        </h1>
      </div>
    </div>
  </section>

  <div class="container">
    <div class="column is-8">
      <table class="table">
        <thead>
          <tr>
            <th>id</th>
            <th>word</th>
            <th>lang</th>
            <th>level</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="word in words">
            <td>{{ word.id }}</td>
            <td>{{ word.word }}</td>
            <td>{{ word.lang }}</td>
            <td>{{ word.difficulty }}</td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

</div>

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
