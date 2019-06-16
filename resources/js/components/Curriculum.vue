<template>
  <v-container fluid grid-list-lg text-xs-center>
    <div>
      <h5>
        UNIVERSIDAD NACIONAL AGRARIA DE LA SELVA - FACULTAD DE INGENIERIA EN INFORMATICA Y SISTEMAS
        <br>
        <br>CURRICULO GENERAL
      </h5>
    </div>
    <br>
    <br>
    <!-- <div class="container-search">
      <v-flex xs12 sm6 md3>
        <v-text-field v-model="search" label="Escriba el semestre"></v-text-field>
      </v-flex>
      <v-btn color="primary darken-1" outline @click="onSearch">Buscar</v-btn>
    </div>-->
    <v-layout row wrap>
      <v-flex xs12 sm12 md12>
        <v-card>
          <v-data-table
            :headers="headers"
            :items="plans"
            class="elevation-1"
            :loading="loading"
            :pagination.sync="pagination"
            hide-actions
          >
            <template slot="no-data">
              <v-alert
                :value="plans.length === 0"
                color="error"
                icon="warning"
                v-if="!loading"
              >Ningún registro coincide con la búsqueda :(</v-alert>
            </template>
            <template v-slot:items="props">
              <td class="text-xs-left">{{ props.item.area }}</td>
              <td class="text-xs-left">{{ props.item.code }}</td>
              <td class="text-xs-left">{{ props.item.name }}</td>
              <td class="text-xs-left">{{ props.item.content }}</td>
              <td class="text-xs-left">{{ props.item.main_objective }}</td>
              <td class="text-xs-left">{{ props.item.secondary_objective }}</td>
            </template>
          </v-data-table>
          <!-- <div class="text-xs-center pt-2">
            <v-pagination
              v-model="pagination.current"
              :length="pagination.total"
              @input="onPageChange"
            ></v-pagination>
          </div>-->
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    headers: [
      { text: "Área", value: "area" },
      { text: "Código", value: "code" },
      { text: "Nombre", value: "name" },
      { text: "Contenido", value: "content" },
      { text: "Ojetivo Principal", value: "main_objective" },
      { text: "Ojbetivo Secundario", value: "secondary_objective" }
    ],
    search: "",
    plans: [],
    loading: true,
    pagination: {
      rowsPerPage: 10,
      current: 1,
      total: 0
    }
  }),

  computed: {},

  watch: {},

  mounted() {
    this.getSearchPlans();
  },
  methods: {
    initialize() {
      this.getplans();
    },
    onSearch() {
      this.getSearchPlans();
    },
    getSearchPlans() {
      const params = {
        search: this.search,
        page: this.pagination.current
      };
      axios
        .get(`/api/curriculum`, { params })
        .then(({ data }) => {
          console.log(data);
          this.plans = data;
          this.pagination.current = data.current_page;
          this.pagination.total = data.last_page;
          this.loading = false;
        })
        .catch(error => {
          notify.error(error.response.data.message);
          this.loading = false;
        });
    },
    onPageChange() {
      this.getSearchPlans();
    }
  }
};
</script>
<style>
.container-search {
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
