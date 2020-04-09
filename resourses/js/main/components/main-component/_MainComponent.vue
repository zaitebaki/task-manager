<template>
  <div class="container">
    <logout-component 
      v-if="isAuth"
    />
    <login-component 
      v-if="!isAuth"
    />
    
    <h2>Текущие задачи</h2>
    <hr>
    <sort-block-component 
      :order-sort="propsData[0].orderSort"
    />

    <task-list-component
      :tasks="propsData[0].tasks"
    />
    <pagination-component
      :count-tasks="propsData[0].countTasks"
      :page-number="+propsData[0].pageNumber"
    />
    <add-task-component />
  </div>
</template>

<script>
import LoginComponent from './LoginComponent.vue';
import LogoutComponent from './LogoutComponent.vue';
import AddTaskComponent from './AddTaskComponent.vue';
import TaskListComponent from './TaskListComponent.vue';
import SortBlockComponent from './SortBlockComponent.vue';
import PaginationComponent from './PaginationComponent.vue';

export default {
  components: {
    'login-component': LoginComponent,
    'logout-component': LogoutComponent,
    'add-task-component': AddTaskComponent,
    'task-list-component': TaskListComponent,
    'sort-block-component': SortBlockComponent,
    'pagination-component': PaginationComponent
  },
props: {
    propsData: {
      type: Array,
      default: () => [],
        },
    },
  computed: {
    isAuth: function () {
      return this.propsData[0].isAuth;
    }
  },
  mounted() {
      console.log(this.propsData);
  }
}
</script>

<style>

</style>