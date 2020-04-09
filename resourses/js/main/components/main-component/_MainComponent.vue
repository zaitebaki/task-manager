<template>
  <div>
    <login-component />
    <add-task-component />
    <task-list-component />
    <sort-block-component />
    <pagination-component />
  </div>
</template>

<script>
import LoginComponent from './LoginComponent.vue';
import AddTaskComponent from './AddTaskComponent.vue';
import TaskListComponent from './TaskListComponent.vue';
import SortBlockComponent from './SortBlockComponent.vue';
import PaginationComponent from './PaginationComponent.vue';

export default {
  components: {
    'login-component': LoginComponent,
    'add-task-component': AddTaskComponent,
    'task-list-component': TaskListComponent,
    'sort-block-component': SortBlockComponent,
    'pagination-component': PaginationComponent
  },
}
</script>

<style>

</style>