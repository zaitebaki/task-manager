<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-6 py-5">
        <p class="font-weight-bold">
          Вход для администратора
        </p>
        <hr>
        <form
          id="loginForm"
          method="post"
          :action="formRoute"
        >
          <div class="form-group">
            <label for="exampleInputEmail1">Логин</label>
            <input
              id="inputLogin"
              type="text"
              class="form-control"
              name="login"
              aria-describedby="введите логин"
              placeholder="введите логин"
              required
            >
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Пароль</label>
            <input
              id="inputPassword"
              type="password"
              class="form-control"
              placeholder="введите пароль"
              name="password"
              required
            >
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
            Войти
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
        formRoute: "http://manager.devmasta.ru.com/login"
    }
  },
  mounted() {
    console.log(this.propsData);
  }
}
</script>

<style>

</style>