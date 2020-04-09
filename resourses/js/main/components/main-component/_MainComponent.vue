<template>
  <div class="container">
    <login-component />
    
    <task-list-component
      :tasks="propsData[0].tasks"
    />
    <pagination-component 
      v-if="propsData[0].tasks.length > 2"
      :count-tasks="propsData[0].tasks.length"
    />
    <add-task-component />
    <sort-block-component />
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
props: {
    propsData: {
      type: Array,
      default: () => [],
        },
    },
  mounted() {
      console.log(this.propsData);
  },
}
</script>

<style>

</style>