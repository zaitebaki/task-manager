<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-6 py-5">
        <p class="font-weight-bold">
          Редактирование задачи
        </p>
        <hr>
        <form
          id="editForm"
          method="post"
          :action="formRoute"
        >
          <div class="form-group">
            <label for="exampleInputEmail1">Имя пользователя</label>
            <input
              id="inputLogin"
              type="text"
              class="form-control"
              name="name"
              aria-describedby="Имя пользователя"
              :value="propsData.task[0].user_name"
              required
            >
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input
              id="inputLogin"
              type="text"
              class="form-control"
              name="email"
              aria-describedby="Имя пользователя"
              :value="propsData.task[0].email"
              required
            >
          </div>
          <div class="form-group">
            <label for="addFormTaskInput">Задача</label>
            <textarea
              id="addFormTaskInput"
              class="form-control"
              name="text"
              rows="3"
              :value="propsData.task[0].text"
              required
            />
          </div>
          <div class="form-check py-4">
            <input
              id="exampleCheck1"
              type="checkbox"
              class="form-check-input"
              name="done"
              :checked="propsData.task[0].done === '1'"
            >
            <label
              class="form-check-label"
              for="exampleCheck1"
            >Задача выполнена</label>

            <small
              v-if="propsData.error"
              id="emailHelp"
              class="form-text text-danger"
            >{{ propsData.error }}</small>
          </div>
          <button
            type="submit"
            class="btn btn-primary"
          >
            Отправить изменения
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    propsData: {
      type: Object,
      default: () => [],
    },
  },
    data: function() {
    return {
        formRoute: "http://task/edit/" + this.propsData.pageNumber
    }
  },
  mounted() {
    console.log(this.propsData);
  }
}
</script>

<style>

</style>