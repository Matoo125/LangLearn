<template>

<div>
  <v-hero hColor="is-dark">All words</v-hero>

  <v-wrap>
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
  </v-wrap>

</div>

</template>

<script>
// import axios from 'axios'
import {API} from '@/tools/Api.js'
import { Hero, Wrap } from '@/ui'

export default {
  name: 'List',
  components: {
    'v-hero': Hero,
    'v-wrap': Wrap
  },
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
