<template>
  <div class="row">
    <div class="col-sm-6">
      <h2>Добавить задачу</h2>
      <hr>
      <form
        id="addTaskForm"
        method="post"
        :action="formRoute"
      >
        <div class="form-group">
          <label for="addFormNameInput">Введите имя</label>
          <input
            id="addFormNameInput"
            type="text"
            class="form-control"
            name="name"
            aria-describedby="emailHelp"
            required
          >
        </div>
        <div class="form-group">
          <label for="addFormEmailInput">Введите email</label>
          <input
            id="addFormEmailInput"
            type="email"
            class="form-control"
            name="email"
            required
          >
        </div>
        <div class="form-group">
          <label for="addFormTaskInput">Введите задачу</label>
          <textarea
            id="addFormTaskInput"
            class="form-control"
            name="text"
            rows="3"
            required
          />
        </div>
        <button
          type="submit"
          class="btn btn-primary"
        >
          Добавить
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
        formRoute: "http://manager.devmasta.ru.com/add_task"
      };
  },
}
</script>

<style>

</style>