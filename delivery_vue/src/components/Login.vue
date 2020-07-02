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
                <h1 class="font-weight-bold display-3 white--text">Login</h1>
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
                        label="Email"
                        v-model="login.email"
                        prepend-icon="mdi-account"
                        type="email"
                        required
                      ></v-text-field>

                      <v-text-field
                        id="password"
                        label="Password"
                        v-model="login.password"
                        prepend-icon="mdi-lock"
                        type="password"
                        required
                      ></v-text-field>
                    </v-form>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="primary">Login</v-btn>
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
                        label="Email"
                        v-model="login.email"
                        prepend-icon="mdi-account"
                        type="email"
                        required
                      ></v-text-field>

                      <v-text-field
                        id="password"
                        label="Password"
                        v-model="login.password"
                        prepend-icon="mdi-lock"
                        type="password"
                        required
                      ></v-text-field>
                    </v-form>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="primary">Login</v-btn>
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
    props: {
      source: String,
    },
    data() {
      return {
        tab: null,
        login: {
          email: "",
          password: ""
        }
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