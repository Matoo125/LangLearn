<template>
<nav class="navbar is-transparent" role="navigation" aria-label="dropdown navigation">
  <a class="navbar-item">
    WordMaster
  </a>

  <router-link :to="{ name: 'Learn' }" class="navbar-item">
    Learn
  </router-link>

  <router-link :to="{ name: 'List' }" class="navbar-item">
    List
  </router-link>

  <router-link :to="{ name: 'Add' }" class="navbar-item">
    Add
  </router-link>

  </div>
</nav>
</template>

<script>
export default {
  name: 'Navbar',
  data () {
    return {

    }
  }
}
</script>

<style scoped>

</style>

