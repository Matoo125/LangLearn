<template>
  <section class="hero" :class="hColor">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">
          <slot>Header</slot>
        </h1>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    hColor: {
      type: String,
      required: true
    }
  }
}
</script>