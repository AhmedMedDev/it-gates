<template>
  <div>
    <b-navbar type="dark" variant="dark">
      <b-navbar-brand href="#">Todo</b-navbar-brand>
      <b-navbar-nav class="ml-auto">
        <b-nav-item @click="logout">Logout</b-nav-item>
      </b-navbar-nav>
    </b-navbar>
    <Nuxt />
  </div>
</template>

<script>
export default {
  methods: {
    logout() {
      localStorage.removeItem('access_token');
      this.$router.push('/auth/login');
    },
  },
};
</script>