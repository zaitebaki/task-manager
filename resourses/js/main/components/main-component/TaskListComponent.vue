<template>
  <div>
    <div class="row">
      <div
        v-for="(task, index) in tasks"
        :key="index"
        class="col-sm-4"
      >
        <div class="card">
          <div class="card-header">
            Автор: {{ task.user_name }}
            <div class="py-2">
              <p class="card-subtitle mb-2 text-muted">
                {{ task.email }}
              </p>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text">
              {{ task.text }}
            </p>
            <p>
              <span
                v-if="task.done === '1'"
                class="badge badge-pill badge-success"
              >Выполнено</span>
              <span
                v-else
                class="badge badge-pill badge-warning"
              >В очереди</span>
              <span
                v-if="task.edited === '1'"
                class="badge badge-pill badge-danger"
              >Отредактировано администратором</span>
            </p>
            <a
              v-if="isAuth"
              :href="getEditLink(task.id)"
              class="btn btn-primary"
            >Редактировать</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    tasks: {
      type: Array,
      default: () => [],
      },
    isAuth: {
      type: Boolean,
      default: false,
      },
    pageNumber: {
      type: Number,
      default: 0,
    },
  },
  mounted() {
  },

  methods: {
    getEditLink(id) {
      return "http://task-manager.devmasta.ru.com/edit/" + id;
    }
  }
}
</script>

<style>
</style>