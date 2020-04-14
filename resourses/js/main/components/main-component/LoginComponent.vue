<template>
  <div class="py-4">
    <a
      :href="domain + '/login'"
      class="text-monospace"
    >Войти с правами администратора</a>
    <hr>
  </div>
</template>

<script>
export default {
  props: {
    domain: {
      type: String,
      default: '',
    },
  },
    data() {
    return {
      formRoute: this.domain + '/add_task',
    };
  },
}
</script>

<style></style>
