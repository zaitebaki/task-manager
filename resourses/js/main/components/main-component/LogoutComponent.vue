<template>
  <div>
    <div class="row py-5">
      <div class="col-sm-4">
        <p>Вы зашли как администратор</p>
      </div>
      <div class="col-sm-4">
        <form
          id="logoutForm"
          class="form-inline"
          method="post"
          :action="formRoute"
        >
          <div class="form-group row">
            <button
              type="submit"
              class="btn btn-primary"
            >
              Выйти
            </button>
          </div>
        </form>
      </div>
    </div>
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
      formRoute: this.domain + '/logout',
    };
  },
};
</script>

<style></style>
