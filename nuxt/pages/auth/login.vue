<template>
  <b-container class="mt-5">
    <b-row align-h="center">
      <b-col cols="12" sm="8" md="6">
        <b-card title="Login Form">
            <b-alert v-if="loginError" variant="danger" show>
                Invalid credentials. Please check your email and password.
            </b-alert>
            <b-form @submit.prevent="login">
                <b-form-group
                label="Email address"
                label-for="email"
                >
                <b-form-input
                    id="email"
                    v-model="email"
                    type="email"
                    required
                ></b-form-input>
                </b-form-group>

                <b-form-group
                label="Password"
                label-for="password"
                >
                <b-form-input
                    id="password"
                    v-model="password"
                    type="password"
                    required
                ></b-form-input>
                </b-form-group>

            <b-button type="submit" variant="primary">Login</b-button>
          </b-form>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: 'it-gates@gmail.com',
      password: 'password',
      loginError: false,
    };
  },
  methods: {
    async login() {
      try {
        const response = await this.$axios.post('/auth/login', {
          email: this.email,
          password: this.password,
        });

        localStorage.setItem('access_token', response.data.access_token);
        
        this.$router.push('/');
      } catch (error) {
        console.error('Login error:', error);
        this.loginError = true;
      }
    },
  },
};
</script>
