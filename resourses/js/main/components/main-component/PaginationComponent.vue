<template>
  <nav
    class="py-3"
    aria-label="Page navigation"
  >
    <ul class="pagination">
      <li
        class="page-item"
        :class="{disabled: pageNumber === 1}"
      >
        <a
          class="page-link"
          :href="getPreviousLink()"
          aria-label="Previous"
        >
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>

      <li
        v-for="(page, index) in pageCount"
        :key="index"
        class="page-item"
        :class="{active: pageNumber === index + 1}"
      >
        <a
          class="page-link"
          :href="getLink(index + 1)"
        >{{ index + 1 }}</a>
      </li>

      <li
        class="page-item"
        :class="{disabled: pageNumber === pageCount}"
      >
        <a
          class="page-link"
          :href="getNextLink()"
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
    pageNumber: {
      type: Number,
      default: 0,
    },
    domain: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      pageLink: this.domain + '/page/',
    };
  },
  computed: {
    pageCount() {
      return Math.trunc(this.countTasks / 3) + 1;
    },
  },
  mounted() {},
  methods: {
    getLink(index) {
      return this.pageLink + index;
    },
    getPreviousLink() {
      return this.pageLink + (this.pageNumber - 1);
    },
    getNextLink() {
      return this.pageLink + (this.pageNumber + 1);
    },
  },
};
</script>

<style></style>
