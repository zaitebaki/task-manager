<template>
  <div class="container">
    <session-status-component
      v-if="propsData[0].sessionStatus"
      :session-status="propsData[0].sessionStatus"
    />
    <logout-component
      v-if="isAuth"
      :domain="propsData[0].domain"
    />
    <login-component
      v-if="!isAuth" 
      :domain="propsData[0].domain"
    />

    <h2>Текущие задачи</h2>
    <hr>
    <sort-block-component :order-sort="propsData[0].orderSort" />

    <task-list-component
      :tasks="propsData[0].tasks"
      :is-auth="isAuth"
      :page-number="+propsData[0].pageNumber"
      :domain="propsData[0].domain"
    />
    <pagination-component
      :count-tasks="propsData[0].countTasks"
      :page-number="+propsData[0].pageNumber"
      :domain="propsData[0].domain"
    />
    <add-task-component 
      :domain="propsData[0].domain"
    />
  </div>
</template>

<script>
import LoginComponent from './LoginComponent.vue';
import LogoutComponent from './LogoutComponent.vue';
import AddTaskComponent from './AddTaskComponent.vue';
import TaskListComponent from './TaskListComponent.vue';
import SortBlockComponent from './SortBlockComponent.vue';
import PaginationComponent from './PaginationComponent.vue';
import SessionStatusComponent from './SessionStatusComponent.vue';

export default {
  components: {
    'login-component': LoginComponent,
    'logout-component': LogoutComponent,
    'add-task-component': AddTaskComponent,
    'task-list-component': TaskListComponent,
    'sort-block-component': SortBlockComponent,
    'pagination-component': PaginationComponent,
    'session-status-component': SessionStatusComponent,
  },
  props: {
    propsData: {
      type: Array,
      default: () => [],
    },
  },
  computed: {
    isAuth() {
      return this.propsData[0].isAuth;
    },
  },
  mounted() {},
};
</script>

<style></style>
