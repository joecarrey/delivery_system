<template>
  <v-app id="inspire">
    <v-main>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card color="primary">
              <v-card-title class="text-center justify-center py-6">
                <h1 class="font-weight-bold display-3 white--text">Register</h1>
              </v-card-title>

              <v-tabs
                v-model="tab"
                background-color="transparent"
                color="white"
                grow
              >
                <v-tab>
                  Client
                </v-tab>
                <v-tab>
                  Courier
                </v-tab>
              </v-tabs>

              <v-tabs-items v-model="tab">
                <v-tab-item>
                  <v-card
                    color="basil"
                    flat
                  >
                  <v-form>
                    <v-text-field
                      label="Name"
                      v-model="register.name"
                      prepend-icon="mdi-account"
                      type="text"
                      required
                    ></v-text-field>

                    <v-text-field
                      label="Email"
                      v-model="register.email"
                      prepend-icon="mdi-account"
                      type="email"
                      required
                    ></v-text-field>

                    <v-text-field
                      id="password"
                      label="Password"
                      v-model="register.password"
                      prepend-icon="mdi-lock"
                      type="password"
                      required
                    ></v-text-field>
                  </v-form>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary">Register</v-btn>
                  </v-card-actions>
                  </v-card>
                </v-tab-item>
                <!--  -->
                <v-tab-item>
                  <v-card
                    color="basil"
                    flat
                  >
                  <v-form>
                    <v-text-field
                      label="Name"
                      v-model="register.name"
                      prepend-icon="mdi-account"
                      type="text"
                      required
                    ></v-text-field>

                    <v-text-field
                      label="Email"
                      v-model="register.email"
                      prepend-icon="mdi-account"
                      type="email"
                      required
                    ></v-text-field>

                    <v-text-field
                      id="password"
                      label="Password"
                      v-model="register.password"
                      prepend-icon="mdi-lock"
                      type="password"
                      required
                    ></v-text-field>
                  </v-form>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" @click='registerIt'>Register</v-btn>
                  </v-card-actions>
                  </v-card>
                </v-tab-item>
              </v-tabs-items>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    name: 'Register',
    props: {
      source: String,
    },
    data() {
      return {
          tab: null,
          register:{
            name:"",
            email:"",
            password:""
          }
      }
    },
    methods: {
      registerIt() {
        axios.post('http://delivery.test/api/register', this.register).then(response => {console.log(response)});
      }
    }
  }
</script>

<style scope>
/* Helper classes */
.basil {
  background-color: #FFFBE6 !important;
}
.v-form {
  margin: 0px 50px;
}
</style>