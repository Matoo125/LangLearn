<template>
  <div class="control">
    <button class="button" :class="bType" @click="bClick()">
      <slot>Button</slot>
    </button>
  </div>
</template>

<script>
export default {
  props: {
    bClick: {
      type: Function,
      required: true
    },
    bType: {
      type: String,
      required: false
    }
  }
}
</script>