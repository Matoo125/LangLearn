<template>
<div class="field">
  <label class="label">
    <slot name="label"></slot>
  </label>
  <div class="control">
    <input type="text" 
           class="input"
           :placeholder="iPlaceholder"
           v-model="iModel">
  </div>
</div>
</template>

<script>
export default {
  props: {
    iPlaceholder: {
      type: String,
      required: false
    },
    value: {
      type: String
    }
  },
  computed: {
    iModel: {
      get () {
        return this.value
      },
      set (val) {
        this.$emit('input', val)
      }
    }
  }
}
</script>