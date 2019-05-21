<template>
  <v-container fluid grid-list-lg text-xs-center>
    <div class="container-search">
      <v-flex xs12 sm6 md3>
        <v-text-field v-model="search" label="Escriba el semestre"></v-text-field>
      </v-flex>
      <v-btn color="primary darken-1" outline @click="onSearch">Buscar</v-btn>
    </div>
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
              >Ninguna registro coincide con la búsqueda :(</v-alert>
            </template>
            <template v-slot:items="props">
              <td class="text-xs-center">{{ props.item.course.code }}</td>
              <td class="text-xs-center">{{ props.item.course.name }}</td>
              <td class="text-xs-center">{{ props.item.course.theoretical_hours }}</td>
              <td class="text-xs-center">{{ props.item.course.practical_hours }}</td>
              <td class="text-xs-center">{{ props.item.course.credits }}</td>
              <td
                class="text-xs-center"
              >{{ props.item.course.courses.map(r => " " + r.course.name).toString() }}</td>
              <td class="text-xs-center">{{ props.item.course.level }}</td>
              <td class="text-xs-center">{{ props.item.number_times }}</td>
              <td class="text-xs-center">{{ props.item.course.term.name }}</td>
              <td class="text-xs-center">{{ props.item.curriculum }}</td>
            </template>

          </v-data-table>
          <div class="text-xs-center pt-2">
            <v-pagination
              v-model="pagination.current"
              :length="pagination.total"
              @input="onPageChange"
            ></v-pagination>
          </div>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    headers: [
      { text: "Código", value: "code" },
      { text: "Nombre", value: "name" },
      { text: "Horas Teoricas", value: "theoretical_hours" },
      { text: "Horas practicas", value: "practical_hours" },
      { text: "Creditos", value: "credits" },
      { text: "Requerimientos", value: "courses" },
      { text: "Semestre", value: "level" },
      { text: "N° veces en curricula", value: "number_times" },
      { text: "Cóndicion", value: "name" },
      { text: "Curricula", value: "curriculum" }
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
        .get(`/api/plans`, { params })
        .then(({ data }) => {
          console.log(data);
          this.plans = data.data;
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
