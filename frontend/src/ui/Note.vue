<template>
<div>
  <div class="notification" :class="nColor">
    <button class="delete"></button>
    <slot>Note is here</slot>
  </div>
</div>
</template>

<script>
export default {
  props: {
    nColor: {
      type: String,
      required: false
    }
  }
}
</script>