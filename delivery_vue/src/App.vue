<template>
  <v-app>
    <v-card
      class="mx-auto overflow-hidden rounded-0"
      width="100%"
    >
      <v-app-bar
        color="primary"
        dark
      >
        <div class="title">
          <v-toolbar-title>Delivery System</v-toolbar-title>
        </div>
          <router-link to="/register" tag="span" id="reg"><v-btn text>Register</v-btn></router-link>
          <router-link to="/" tag="span" id="log"><v-btn text>Login</v-btn></router-link>
      </v-app-bar>
    </v-card>
    <v-main>
      <!-- <Login /> -->
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>
// import Login from './components/Login';

export default {
  name: 'App',

  components: {
    // Login,
  },

  data: () => ({
    
  }),
  created(){
    if (this.$route.path == '/register') {
      this.$router.replace({
        name: 'Login',
        params: {
          id: '/'
        }
      })
    }
  }
};
</script>

<style scope>
  .title {
    width: 100%;
  }
</style>