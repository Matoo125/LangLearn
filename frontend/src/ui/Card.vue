<template>
<div class="card">
  <div class="card-header">
    <p class="card-header-title">
      <slot name="title">Card Title</slot>
    </p>
  </div>
  <div class="card-content">
    <slot name="content">Card Content</slot>
  </div>
</div>
</template>