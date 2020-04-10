<template>
  <div>
    <div
      v-if="sessionStatus.success"
      class="alert alert-success"
      role="alert"
    >
      {{ sessionStatus.success }}
    </div>
    <div
      v-if="sessionStatus.error"
      class="alert alert-danger"
      role="alert"
    >
      {{ sessionStatus.error }}
    </div>
  </div>
</template>

<script>
export default {
    props: {
    sessionStatus: {
      type: Object,
      default: () => [],
        },
    },
}
</script>

<style>
</style>