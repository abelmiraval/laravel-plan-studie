<template>
  <v-container fluid grid-list-lg text-xs-center>
    <v-layout row wrap>
      <v-flex xs12 sm12 md12>
        <v-card>
          <v-card-title class="headline font-weight-regular border-gray">NUEVO CURSO</v-card-title>
          <v-card-text>
            <v-form>
              <!-- <v-container> -->
              <!-- wrap -->
              <v-layout wrap>
                <v-flex xs12 sm6 md2>
                  <v-text-field v-model="code" label="Código de curso" required></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md5>
                  <v-text-field v-model="name" label="Nombre de curso" required></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md3 d-flex>
                  <v-select
                    :items="areas"
                    v-model="area"
                    item-text="name"
                    item-value="id"
                    label="Area"
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6 md2>
                  <v-select
                    :items="natures"
                    v-model="nature"
                    item-text="name"
                    item-value="id"
                    label="Naturaleza"
                  ></v-select>
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field v-model="main_objective" label="Objetivo Principal" required></v-text-field>
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field v-model="secondary_objective" label="Objetivo Secundario" required></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md2>
                  <v-text-field
                    v-model="theoretical_hours"
                    :mask="mask_theoretical_hours"
                    label="Horas Teóricas"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md2>
                  <v-text-field
                    v-model="practical_hours"
                    :mask="mask_practical_hours"
                    label="Horas Prácticas"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12 sm4 md2>
                  <v-text-field v-model="credits" :mask="mask_credit" label="Créditos" required></v-text-field>
                </v-flex>

                <v-flex xs12 sm4 md3>
                  <v-text-field v-model="level" label="Semestre" required></v-text-field>
                </v-flex>

                <v-flex xs12 sm4 md3 d-flex>
                  <v-select
                    :items="terms"
                    v-model="condition"
                    item-text="name"
                    item-value="id"
                    label="Cóndicion"
                  ></v-select>
                </v-flex>

                <v-flex xs12 sm6 md4 d-flex>
                  <v-select
                    v-model="requeriments"
                    v-bind:items="courses"
                    attach
                    chips
                    label="Requsitios"
                    item-text="name"
                    item-value="id"
                    multiple
                  ></v-select>
                </v-flex>
              </v-layout>

              <!-- </v-container> -->
              <v-layout wrap>
                <v-flex xs12 md12>
                  <v-toolbar flat color="white">
                    <v-toolbar-title>Tema</v-toolbar-title>
                    <v-divider class="mx-2" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog_topic" max-width="600px">
                      <template v-slot:activator="{ on }">
                        <v-btn
                          color="primary"
                          dark
                          class="mb-2"
                          v-on="on"
                          @click="getTopics"
                        >Agregar tema</v-btn>
                      </template>
                      <v-card>
                        <v-card-title>
                          <span class="headline">Seleccionar Tema</span>
                        </v-card-title>
                        <v-card-text>
                          <v-container grid-list-md>
                            <v-data-table
                              v-model="selected_topics"
                              :headers="headers_modal"
                              :items="topics"
                              item-key="name"
                              class="elevation-1 custom-table"
                            >
                              <template v-slot:items="props">
                                <td>
                                  <v-checkbox v-model="props.selected" primary hide-details></v-checkbox>
                                </td>
                                <td class="text-xs-center">{{props.index + 1}}</td>
                                <td class="text-xs-center">{{ props.item.name }}</td>
                              </template>
                            </v-data-table>
                          </v-container>
                        </v-card-text>

                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue darken-1" flat @click="close_dialog_course">Cerrar</v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-dialog>
                  </v-toolbar>

                  <v-data-table
                    :headers="headers"
                    :items="selected_topics"
                    class="elevation-1 custom-table"
                    :hide-actions="true"
                  >
                    <template v-slot:items="props">
                      <td class="text-md-center">{{ props.index + 1}}</td>
                      <td class="text-md-center">{{ props.item.name }}</td>
                      <td class="justify-center layout px-0">
                        <v-icon small @click="deleteItemtopics(props.item)">delete</v-icon>
                      </td>
                    </template>
                    <template slot="no-data">
                      <v-alert
                        :value="true"
                        color="info"
                        icon="warning"
                        style="margin: 1.5em 0"
                      >Aún no se han agregado temas</v-alert>
                    </template>
                  </v-data-table>
                </v-flex>
              </v-layout>
            </v-form>
          </v-card-text>
          <v-btn color="success darken-1" dark @click="save" style="margin: 1.2em 0;">Guardar Curso</v-btn>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    dialog_topic: false,
    mask_theoretical_hours: "##",
    mask_practical_hours: "##",
    mask_credit: "##",
    searchRequeriment: "",
    headers: [
      { text: "N°", value: "name" },
      { text: "Nombre", value: "fat" },
      { text: "Actions", value: "name", sortable: false }
    ],
    headers_modal: [
      { text: "#", value: "", sortable: false },
      { text: "N°", value: "name" },
      { text: "Nombre", value: "fat" }
    ],
    code: "",
    name: "",
    area: {},
    nature: {},
    condition: {},
    main_objective: "",
    secondary_objective: "",
    theoretical_hours: "",
    practical_hours: "",
    credits: "",
    level: "",
    requeriments: [],
    selected_topics: [],
    courses: [],
    topics: [],
    areas: [],
    natures: [],
    terms: []
  }),

  computed: {},

  watch: {},

  created() {
    this.initialize();
  },

  mounted() {
    // axios.get("/api/requeriments").then(({ data }) => {
    //   this.courses = data;
    // });

    axios.get("/api/courses").then(({ data }) => {
      this.courses = data;
    });

    axios.get("/api/topics").then(({ data }) => {
      this.topics = data;
    });

    axios.get("/api/terms").then(({ data }) => {
      this.terms = data;
    });

    axios.get("/api/natures").then(({ data }) => {
      this.natures = data;
    });

    axios.get("/api/areas").then(({ data }) => {
      this.areas = data;
    });
  },

  methods: {
    initialize() {
      // this.areas = [
      //   "Formación  General",
      //   "Formación Específica",
      //   "Formación Especializada"
      // ];
      // this.natures = ["Teórico", "Práctico"];
      // this.terms = ["Obligatorio", "Electivo"];
      // this.courses = ["NS-01", "NS-02", "NS-03"];
    },

    getTopics() {
      axios.get("/api/topics").then(({ data }) => {
        this.topics = data;
      });
    },
    getCourses() {
      axios.get("/api/courses").then(({ data }) => {
        this.courses = data;
      });
    },

    deleteItemtopics(item) {
      const index = this.selected_topics.indexOf(item);
      confirm("Esta seguro de querer eliminar?") &&
        this.selected_topics.splice(index, 1);
    },

    close_dialog_course() {
      this.dialog_topic = false;
    },

    save() {
      if (!this.code) {
        notify.error("Ingrese el codigo del curso");
        return;
      }
      if (!this.name) {
        notify.error("Ingrese el nombre del curso");
        return;
      }
      if (!this.nature) {
        notify.error("Ingrese la naturaleza");
        return;
      }
      if (!this.main_objective) {
        notify.error("Ingrese el objetivo principal");
        return;
      }
      if (!this.secondary_objective) {
        notify.error("Ingrese el objetivo secundario");
        return;
      }

      if (!this.theoretical_hours) {
        notify.error("Ingrese horas teóricas");
        return;
      }
      if (!this.practical_hours) {
        notify.error("Ingrese horas prácticas");
        return;
      }
      if (!this.credits) {
        notify.error("Ingrese créditos");
        return;
      }
      if (!this.level) {
        notify.error("Ingrese semestre");
        return;
      }

      if (!this.condition) {
        notify.error("Ingrese condición");
        return;
      }

      if (!this.selected_topics.length === 0) {
        notify.error("Agregue al menos un tema");
        return;
      }

      if (!this.courses.length === 0) {
        notify.error("Agregue al menos un requisito");
        return;
      }

      const topics = this.selected_topics.map(c => c.id);

      const data = {
        code: this.code,
        name: this.name,
        area: this.area,
        nature: this.nature,
        main_objective: this.main_objective,
        secondary_objective: this.secondary_objective,
        theoretical_hours: this.theoretical_hours,
        practical_hours: this.practical_hours,
        credits: this.credits,
        level: this.level,
        condition: this.condition,
        topics: topics,
        requeriments: this.requeriments
      };

      console.log(data);

      axios
        .post("/api/course/create", data)
        .then(({ data }) => {
          notify.showCool(data.message);
          this.getCourses();
          // this.reset();
        })
        .catch(response => {
          console.log(response);
          notify.error(response.message);
        });
    },
    reset() {
      (this.code = ""),
        (this.name = ""),
        (this.area = ""),
        (this.nature = ""),
        (this.main_objective = ""),
        (this.secondary_objective = ""),
        (this.theoretical_hours = ""),
        (this.practical_hours = ""),
        (this.credits = ""),
        (this.level = ""),
        (this.condition = ""),
        (this.selected_topics = []),
        (this.requeriments = []);
    }
  }
};
</script>

<style>
.border-gray {
  border-bottom: 1px solid #949494;
}

.custom-table th:not(:first-child),
.table-modal th:not(:first-child) {
  text-align: right !important;
}
.custom-table th:last-child {
  text-align: center !important;
}
.border-gray {
  border-bottom: 1px solid #949494;
}
.total-flex {
  display: flex;
  justify-content: flex-end;
  margin: 0 16px;
}
.total-header {
  padding: 10px;
  display: flex;
  justify-content: space-between;
  min-width: 200px;
}
.total-header div:first-child {
  padding-right: 20px;
  text-transform: uppercase;
}
.total-header div:last-child {
  min-width: 10%;
}
.custom-table thead tr > th:nth-of-type(3),
.table-modal thead tr > th:last-child {
  width: 200px;
}
.text-right {
  text-align: right;
}
.text-left {
  text-align: left;
}
.product-td {
  min-width: 200px !important;
}
@media (max-width: 500px) {
  .v-text-field {
    padding-top: 0;
  }
  .custom-table td,
  .custom-table th,
  .table-modal td,
  .table-modal th {
    padding: 0 12px !important;
  }
  table .v-input {
    font-size: 13px !important;
  }
}
.theme--light.v-table tbody tr[active] {
  background: rgba(97, 180, 247, 0.15);
}
.theme--light.v-table tbody tr[active]:hover {
  background: rgba(97, 180, 247, 0.3);
}
.P0 {
  color: #00e676;
}
.P1 {
  color: #ff5722;
}
.P2 {
  color: #ff9800;
}
.P3 {
  color: #9c27b0;
}
.P4 {
  color: #ffc107;
}
</style>
