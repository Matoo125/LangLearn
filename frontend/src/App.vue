<template>
  <div id="app">
    <navbar></navbar>
    <router-view/>
  </div>
</template>

<script>
import navbar from './components/Navbar.vue'
export default {
  name: 'app',
  components: {
    navbar
  }
}
</script>

<style lang="scss">
// Import Bulma and Buefy styles
@import "~bulmaswatch/litera/_variables.scss";
@import "~bulma";
@import "~bulmaswatch/litera/_overrides.scss";
@import "~buefy/src/scss/buefy";
</style>
