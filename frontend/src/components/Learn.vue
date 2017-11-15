<template>
<section class="hero">
  <div class="hero-body">
    <p class="title">
      Learn
    </p>

    <div class="columns">
      <div class="column is-4">
        <div class="field">
          <label class="label is-large">Slovo</label>
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
export default {
  name: 'Learn',
  data () {
    return {
    }
  }
}
</script>

<style scoped>

</style>
