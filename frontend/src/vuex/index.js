import Vue from 'vue'
import Vuex from 'vuex'
import {API} from '@/tools/Api.js'

Vue.use(Vuex)

const state = {
  word: null,
  translations: {},
  sentences: {},
  definitions: {}
}

const mutations = {
  set_word (state, word) {
    state.word = word
  },
  set_translations (state, translations) {
    state.translations = translations
  },
  set_sentences (state, sentences) {
    state.sentences = sentences
  },
  set_definitions (state, definitions) {
    state.definitions = definitions
  }
}

const actions = {
  find_word ({ commit, state }, params) {
    let data = {
      lang: params.lang,
      word: params.word
    }
    return new Promise(
      (resolve, reject) => {
        API.get('words/find', { params: data })
        .then(r => {
          console.log(r)
          commit('set_word', r.data.word)
          resolve(r)
        })
        .catch(e => {
          console.log(e)
          console.log('word not found')
          reject(e)
        })
      }
    )
  },
  load_sentences ({ commit, state }, params) {
    var wordId = (params && params.word_id) ? params.word_id : state.word.id
    API.get('sentences/list?word_id=' + wordId)
    .then(r => {
      console.log(r)
      commit('set_sentences', r.data.sentences)
    })
    .catch(e => {
      console.log(e)
    })
  },
  load_definitions ({ commit, state }, params) {
    var wordId = (params && params.word_id) ? params.word_id : state.word.id
    API.get('definitions/list?word_id=' + wordId)
    .then(r => {
      console.log(r)
      commit('set_definitions', r.data.definitions)
    })
    .catch(e => {
      console.log(e)
    })
  },
  load_translations ({ commit, state }, params) {
    var wordId = (params && params.word_id) ? params.word_id : state.word.id
    API.get('translations/list?word_id=' + wordId)
    .then(r => {
      console.log(r)
      commit('set_translations', r.data.translations)
    })
    .catch(e => {
      console.log(e)
    })
  },
  add_word ({ commit, state }, params) {
    var data = new FormData()
    data.append('lang', params.lang)
    data.append('word', params.word)
    API.post('words/add', data)
    .then(r => {
      console.log('word has been added from vuex')
      console.log(r)
      var word = {
        id: r.data.id,
        word: params.word,
        lang: params.lang
      }
      commit('set_word', word)
    })
    .catch(e => { console.log(e) })
  }
}

const store = new Vuex.Store({
  state,
  mutations,
  actions
})

export default store
