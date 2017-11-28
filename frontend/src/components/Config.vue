<template>
<div>
  <v-hero hColor="is-warning">Config</v-hero>

  <v-wrap>
    hello
  </v-wrap>
</div>
</template>

<script>
import { Button, Hero, Note, Wrap } from '@/ui'

export default {
  name: 'Config',
  components: {
    'v-button': Button,
    'v-hero': Hero,
    'v-note': Note,
    'v-wrap': Wrap
  }
}
</script>
