<template>
  <form
    id="sortForm"
    :action="formRoute"
    method="post"
  >
    <div class="form-group row">
      <label
        for="exampleFormControlSelect1"
        class="col-sm-3 col-form-label"
      >Сортировка по:</label>
      <div
        id="exampleFormControlSelect1"
        class="col-sm-4"
      >
        <select
          id="sortSelectedElement"
          class="form-control"
          name="sortSelectedElement"
          @change="onChangeSelectedTask"
        >
          <option
            value="default"
            :selected="orderSort === 'default'"
          >
            по умолчанию
          </option>
          <option
            value="name"
            :selected="orderSort === 'name'"
          >
            по имени
          </option>
          <option
            value="status"
            :selected="orderSort === 'status'"
          >
            по статусу
          </option>
        </select>
      </div>
    </div>
  </form>
</template>

<script>
export default {
    props: {
    orderSort: {
      type: String,
      default: 'default',
    },
  },
    data: function() {
    return {
        formRoute: document.location.href
      };
  },
  mounted() {
  },
  methods: {
    onChangeSelectedTask() {
      document.getElementById("sortForm").submit();
    }
  }
}
</script>

<style>

</style>