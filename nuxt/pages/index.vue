<template>
  <div>
    <b-sidebar id="sidebar" ref="sidebar" title="Sidebar" right shadow @hidden="resetForm">
      <div class="px-3 py-2">
        <form @submit.prevent>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" v-model="newTodo.title" required/>
            </div>
            <div class="form-group">
              <label for="notes">Notes</label>
              <textarea class="form-control" id="notes" v-model="newTodo.notes" required ></textarea>
            </div>
            <div class="form-group">
              <label for="due_date">Due Date</label>
              <b-form-datepicker
                id="due_date"
                v-model="newTodo.due_date"
                required
              ></b-form-datepicker>
            </div>
            <button v-if="updating" @click="update" class="btn btn-primary">Update Todo</button>
            <button v-else @click="store" class="btn btn-primary">Add Todo</button>
        </form>
        <div v-if="successMessage" class="alert alert-success mt-3">
          {{ successMessage }}
        </div>
      </div>
    </b-sidebar>
    
    <b-container>
      <div class="d-flex align-items-center justify-content-between mt-5 mb-3">
        <div class="d-flex align-items-center justify-content-between">
          <b-button variant="danger" class="mr-2" @click="remaining">{{ todos.length -  completed_count }} remaining</b-button>
          <b-button variant="success" @click="completed">{{ completed_count }} completed</b-button>
        </div>
          <b-button variant="primary" v-b-toggle.sidebar>add task</b-button>
      </div>
      <div v-for="todo in filteredTodos" :key="todo.id">
        <b-card class="mt-2" shadow>
          <b-card-title :style="{ 'text-decoration': todo.is_completed ? 'line-through' : 'none' }">
            {{ todo.title }}
          </b-card-title>
          <b-card-sub-title>
            {{ todo.due_date }}
          </b-card-sub-title>
          <b-card-text>
          <div class="row">
            <div class="col-8">{{ todo.notes }}</div>
            <div class="col-4 justify-content-end d-flex">
                <div>
                  <b-button @click="edit(todo)" variant="info" v-b-toggle.sidebar>edit</b-button>
                  <b-button @click="update(todo)" 
                    :class="[todo.is_completed ? 'btn-success' : 'btn-danger']" 
                    class="card-link" 
                    v-text="todo.is_completed ? 'done' : 'in progress'"></b-button>
                </div>
            </div>
          </div>
          </b-card-text>
        </b-card>
      </div>
    </b-container>
  </div>
</template>

<script>
export default {
  middleware: 'authenticated',
  data() {
    return {
      todos: [],
      filteredTodos: [],
      newTodo: {
        title: '',
        notes: '',
        due_date: null,
      },
      successMessage: '',
      updating: false,
    };
  },
  computed: {
    completed_count() {
      return this.todos.filter(todo => todo.is_completed).length;
    },
  },
  methods: {
    async fetchTodos() {
      try {
        const accessToken = localStorage.getItem('access_token');
        
        const response = await this.$axios.get(`/todos`, {
          headers: {
            Authorization: `Bearer ${accessToken}`,
          },
        });
        
        this.todos = response.data.payload;
        this.filteredTodos = this.todos;
      }  catch (error) {
        console.error('Error fetching todos:', error);
      }
    },
    remaining() {
      this.filteredTodos = (this.filteredTodos.length == this.todos.length) 
      ? this.todos.filter(todo => !todo.is_completed)
      : this.todos;
    },
    completed() {
      this.filteredTodos = (this.filteredTodos.length == this.todos.length) 
      ? this.todos.filter(todo => todo.is_completed)
      : this.todos;
    },
    async update(todo) {
      try {
        const accessToken = localStorage.getItem('access_token');

        const response = await this.$axios.put(`/todos/${todo.id}`,
          {
            is_completed: !todo.is_completed,
          },
          {
            headers: {
              Authorization: `Bearer ${accessToken}`,
            },
          }
        );

        this.fetchTodos();
      } catch (error) {
        console.error('Error marking todo as completed:', error);
      }
    },
    async store() {
      try {
        const accessToken = localStorage.getItem('access_token');
        const response = await this.$axios.post(`/todos`, this.newTodo,
          {
            headers: {
              Authorization: `Bearer ${accessToken}`,
            },
          }
        );

        this.successMessage = 'Todo added successfully';
        this.newTodo = {}
        this.fetchTodos();
      } catch (error) {
        console.error('Error adding todo:', error);
      }
    },
    edit(todo) {
      this.updating = true
      this.newTodo = todo
    },
    resetForm() {
      this.newTodo = {}
      this.updating = false;
    },
  },
  async created() {
    await this.fetchTodos();
  },
};
</script>