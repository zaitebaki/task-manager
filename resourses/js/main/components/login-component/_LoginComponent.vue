<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-6 py-5">
        <p class="font-weight-bold">
          Вход для администратора
        </p>
        <hr>
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Логин</label>
            <input
              id="inputLogin"
              type="text"
              class="form-control"
              aria-describedby="введите логин"
              placeholder="введите логин"
            >
            <small
              id="emailHelp"
              class="form-text text-muted"
            >Неправильно введен логи или пароль</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Пароль</label>
            <input
              id="inputPassword"
              type="password"
              class="form-control"
            >
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

}
</script>

<style>

</style>