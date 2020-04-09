<template>
  <nav
    class="py-3"
    aria-label="Page navigation"
  >
    <ul class="pagination">
      <li class="page-item">
        <a
          class="page-link"
          href="#"
          aria-label="Previous"
        >
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>

      <li
        v-for="(page, index) in pageNumbers"
        :key="index"
        class="page-item"
      >
        <a
          class="page-link"
          href="#"
        >{{ index + 1 }}</a>
      </li>

      <li class="page-item">
        <a
          class="page-link"
          href="#"
          aria-label="Next"
        >
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    countTasks: {
      type: Number,
      default: 0,
      },
  },
  data() {
    return {
    }
  },
  computed: {
    pageNumbers: function () {
        return Math.trunc(this.countTasks / 3) + 1;
      }
  },
  mounted() {
    console.log(this.pageNumbers);
  }
}
</script>

<style>

</style>