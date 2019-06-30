<template>
  <v-container fluid grid-list-lg text-xs-center>
    <v-layout row wrap>
      <v-flex xs12 sm12 md12>
        <v-card>
          <v-toolbar flat color="white">
            <v-toolbar-title>CURSOS</v-toolbar-title>
            <v-divider class="mx-2" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="search"
              label="Buscar"
              single-line
              hide-details
            ></v-text-field>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="1200px">
              <template v-slot:activator="{ on }">
                <v-btn color="primary" dark class="mb-10 ml-2" v-on="on">Nuevo Curso</v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12 sm6 md2>
                        <v-text-field v-model="editedItem.code" label="Código de curso" required></v-text-field>
                      </v-flex>

                      <v-flex xs12 sm6 md5>
                        <v-text-field v-model="editedItem.name" label="Nombre de curso" required></v-text-field>
                      </v-flex>

                      <v-flex xs12 sm6 md3 d-flex>
                        <v-select
                          :items="areas"
                          v-model="editedItem.area"
                          item-text="name"
                          item-value="id"
                          label="Area"
                        ></v-select>
                      </v-flex>

                      <v-flex xs12 sm6 md2>
                        <v-select
                          :items="natures"
                          v-model="editedItem.nature"
                          item-text="name"
                          item-value="id"
                          label="Naturaleza"
                        ></v-select>
                      </v-flex>

                      <v-flex xs12 md6>
                        <v-text-field
                          v-model="editedItem.main_objective"
                          label="Objetivo Principal"
                          required
                        ></v-text-field>
                      </v-flex>

                      <v-flex xs12 md6>
                        <v-text-field
                          v-model="editedItem.secondary_objective"
                          label="Objetivo Secundario"
                          required
                        ></v-text-field>
                      </v-flex>

                      <v-flex xs12 sm6 md2>
                        <v-text-field
                          v-model="editedItem.theoretical_hours"
                          :mask="mask_theoretical_hours"
                          label="Horas Teóricas"
                        ></v-text-field>
                      </v-flex>

                      <v-flex xs12 sm6 md2>
                        <v-text-field
                          v-model="editedItem.practical_hours"
                          :mask="mask_practical_hours"
                          label="Horas Prácticas"
                        ></v-text-field>
                      </v-flex>

                      <v-flex xs12 sm4 md2>
                        <v-text-field
                          v-model="editedItem.credits"
                          :mask="mask_credit"
                          label="Créditos"
                          required
                        ></v-text-field>
                      </v-flex>

                      <v-flex xs12 sm4 md3>
                        <v-text-field v-model="editedItem.level" label="Semestre" required></v-text-field>
                      </v-flex>

                      <v-flex xs12 sm4 md3 d-flex>
                        <v-select
                          :items="terms"
                          v-model="editedItem.term"
                          item-text="name"
                          item-value="id"
                          label="Cóndicion"
                        ></v-select>
                      </v-flex>

                      <v-flex xs12 sm6 md4 d-flex>
                        <v-select
                          v-model="editedItem.requeriments"
                          v-bind:items="requeriments_all"
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
                          <v-toolbar-title>Temas</v-toolbar-title>
                          <v-divider class="mx-2" inset vertical></v-divider>
                          <v-spacer></v-spacer>
                          <v-dialog v-model="dialog_topic" max-width="900px">
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
                                <v-spacer></v-spacer>
                                <v-text-field
                                  v-model="search_topic"
                                  append-icon="search"
                                  label="Search"
                                  single-line
                                  hide-details
                                ></v-text-field>
                              </v-card-title>
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-data-table
                                    v-model="editedItem.topics"
                                    :headers="headers_modal"
                                    :items="topics_all"
                                    :search="search_topic"
                                    item-key="name"
                                    class="elevation-1"
                                  >
                                    <template v-slot:items="props">
                                      <td>
                                        <v-checkbox
                                          v-model="props.selected"
                                          primary
                                          hide-details
                                          @change="verifyTopicInCourse(props.selected)"
                                        ></v-checkbox>
                                      </td>
                                      <td class="text-xs-left">{{ props.item.code }}</td>
                                      <td class="text-xs-left">{{ props.item.name }}</td>
                                      <td class="text-xs-left">{{ props.item.content }}</td>
                                    </template>
                                  </v-data-table>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                  color="error darken-1"
                                  flat
                                  @click="close_dialog_course"
                                >Cerrar</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-dialog>
                        </v-toolbar>

                        <v-data-table
                          :headers="headers_topic"
                          :items="editedItem.topics"
                          class="elevation-1"
                          :hide-actions="true"
                        >
                          <template v-slot:items="props">
                            <td class="text-xs-left">{{ props.index + 1}}</td>
                            <td class="text-xs-left">{{ props.item.name }}</td>
                            <td class="text-xs-left">{{ props.item.code }}</td>
                            <td class="text-xs-left">{{ props.item.content }}</td>
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
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="error darken-1" flat @click="close">Cancel</v-btn>
                  <v-btn color="blue darken-1" flat @click="save">Guardar Curso</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>

          <v-data-table :headers="headers" :items="courses" :search="search" class="elevation-1">
            <template v-slot:items="props">
              <td class="text-xs-left">{{ props.item.code }}</td>
              <td class="text-xs-left">{{ props.item.name }}</td>
              <td class="text-xs-left">{{ props.item.area.name }}</td>
              <td class="text-xs-left">{{ props.item.nature.name }}</td>
              <td class="text-xs-left">{{ props.item.theoretical_hours }}</td>
              <td class="text-xs-left">{{ props.item.practical_hours }}</td>
              <td class="text-xs-left">{{ props.item.credits }}</td>
              <td class="text-xs-left">{{ props.item.level }}</td>
              <td class="text-xs-left">{{ props.item.term.name }}</td>
              <td
                class="text-xs-center"
              >{{ props.item.requeriments.map(r => " " + r.requeriment.name).toString() }}</td>

              <td class="justify-center layout px-0">
                <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
              </td>
            </template>
            <template slot="no-data">
              <v-alert
                :value="true"
                color="info"
                icon="warning"
                style="margin: 1.5em 0"
              >Aún no se han agregado cursos :(</v-alert>
            </template>
          </v-data-table>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    search: "",
    search_topic: "",
    dialog: false,
    dialog_topic: false,
    mask_theoretical_hours: "##",
    mask_practical_hours: "##",
    mask_credit: "##",
    mask_level: "####-#",
    search: "",
    headers: [
      { text: "Código", value: "code" },
      { text: "Nombre", value: "name" },
      { text: "Área", value: "area" },
      { text: "Naturaleza", value: "nature" },
      { text: "H.T", value: "theoretical_hours" },
      { text: "H.P", value: "practical_hours" },
      { text: "Créditos", value: "credits" },
      { text: "Semestre", value: "level" },
      { text: "Condición", value: "term" },
      { text: "Requisitos", value: "requeriments" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    headers_topic: [
      { text: "N°", value: "index", sortable: false },
      { text: "Código", value: "code" },
      { text: "Nombre", value: "name" },
      { text: "Contenido", value: "content" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    headers_modal: [
      { text: "#", value: "", sortable: false },
      { text: "Código", value: "code" },
      { text: "Nombre", value: "name" },
      { text: "Contenido", value: "content" }
    ],
    courses: [],
    topics_all: [],
    areas: [],
    natures: [],
    terms: [],
    requeriments_all: [],
    editedItem: {
      code: "",
      name: "",
      area: {},
      nature: {},
      term: {},
      main_objective: "",
      secondary_objective: "",
      theoretical_hours: "",
      practical_hours: "",
      credits: "",
      level: "",
      requeriments: [],
      topics: []
    },
    editedIndex: -1,
    cursos: ""
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo Curso" : "Editar Curso";
    }
  },

  watch: {},

  created() {
    this.initialize();
  },

  mounted() {
    axios.get("/api/requeriments").then(({ data }) => {
      this.requeriments_all = data;
    });

    axios.get("/api/courses").then(({ data }) => {
      this.courses = data;
    });

    axios.get("/api/topics").then(({ data }) => {
      this.topics_all = data;
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
      this.getCourses();
      this.reset();
    },

    getTopics() {
      this.search_topic = "";
      axios.get("/api/topics").then(({ data }) => {
        this.topics_all = data;
      });
    },
    getCourses() {
      axios.get("/api/courses").then(({ data }) => {
        this.courses = data;
      });
    },

    getRequerimentsAll() {
      axios.get("/api/requeriments").then(({ data }) => {
        this.requeriments_all = data;
      });
    },

    deleteItemtopics(item) {
      const index = this.editedItem.topics.indexOf(item);
      confirm("Esta seguro de querer eliminar?") &&
        this.editedItem.topics.splice(index, 1);
    },

    async verifyTopicInCourse(selected) {
      console.log("Se selecciono lo siguiente", selected);
      let lengthTopicsSelected = this.editedItem.topics.length;
      if (selected === undefined) {
        if (lengthTopicsSelected > 0) {
          const id = this.editedItem.topics[lengthTopicsSelected - 1].id;
          try {
            let response = await axios.get("/api/course/verifyTopic/" + id);
            this.cursos = response.data;
          } catch (err) {
            console.log(err);
          }
          console.log("Estos son los cursos", this.cursos);
          if (this.cursos) {
            notify.show({
              text:
                "Este tema fue asignado a los siguientes cursos:" + this.cursos,
              color: "warning",
              timeout: 5000,
              dismissible: false
            });
          }
        }
      }
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },
    close_dialog_course() {
      this.dialog_topic = false;
    },

    save() {
      if (!this.editedItem.code) {
        notify.error("Ingrese el codigo del curso");
        return;
      }
      if (!this.editedItem.name) {
        notify.error("Ingrese el nombre del curso");
        return;
      }
      if (!this.editedItem.nature) {
        notify.error("Ingrese la naturaleza");
        return;
      }
      if (!this.editedItem.main_objective) {
        notify.error("Ingrese el objetivo principal");
        return;
      }
      if (!this.editedItem.secondary_objective) {
        notify.error("Ingrese el objetivo secundario");
        return;
      }

      if (!this.editedItem.theoretical_hours) {
        notify.error("Ingrese horas teóricas");
        return;
      }
      if (!this.editedItem.practical_hours) {
        notify.error("Ingrese horas prácticas");
        return;
      }
      if (!this.editedItem.credits) {
        notify.error("Ingrese créditos");
        return;
      }
      if (!this.editedItem.level) {
        notify.error("Ingrese semestre");
        return;
      }

      if (!this.editedItem.term) {
        notify.error("Ingrese condición");
        return;
      }

      if (!this.editedItem.topics.length === 0) {
        notify.error("Agregue al menos un tema");
        return;
      }

      const topics = this.editedItem.topics.map(c => c.id);
      const level_year = this.editedItem.level.substring(
        0,
        this.editedItem.level.length - 1
      );
      const level_age = this.editedItem.level.charAt(
        this.editedItem.level.length - 1
      );

      if (this.editedIndex > -1) {
        const requeriments = this.editedItem.requeriments;
        const editedData = {
          code: this.editedItem.code,
          name: this.editedItem.name,
          area: this.editedItem.area,
          nature: this.editedItem.nature,
          main_objective: this.editedItem.main_objective,
          secondary_objective: this.editedItem.secondary_objective,
          theoretical_hours: this.editedItem.theoretical_hours,
          practical_hours: this.editedItem.practical_hours,
          credits: this.editedItem.credits,
          level: this.editedItem.level,
          term: this.editedItem.term,
          topics: topics,
          requeriments: requeriments
        };
        console.log("Esto es el curso con nuevos valores", editedData);
        axios
          .put("/api/course/update/" + this.editedItem.id, editedData)
          .then(({ data }) => {
            notify.showCool(data.message);
            this.close();
            this.initialize();
            this.getRequerimentsAll();
          })
          .catch(error => {
            console.log(error.response.data.message);
            notify.error(error.response.data.message);
          });
      } else {
        const data = {
          code: this.editedItem.code,
          name: this.editedItem.name,
          area: this.editedItem.area,
          nature: this.editedItem.nature,
          main_objective: this.editedItem.main_objective,
          secondary_objective: this.editedItem.secondary_objective,
          theoretical_hours: this.editedItem.theoretical_hours,
          practical_hours: this.editedItem.practical_hours,
          credits: this.editedItem.credits,
          level: this.editedItem.level,
          term: this.editedItem.term,
          topics: topics,
          requeriments: this.editedItem.requeriments
        };

        axios
          .post("/api/course/create", data)
          .then(({ data }) => {
            notify.showCool(data.message);
            this.close();
            this.initialize();
            this.getRequerimentsAll();
          })
          .catch(response => {
            console.log(response);
            notify.error(response.message);
          });
      }
    },

    editItem(item) {
      this.editedIndex = this.courses.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.editedItem.area = item.area.id;
      this.editedItem.term = item.term.id;
      this.editedItem.nature = item.nature.id;
      this.editedItem.requeriments = item.requeriments.map(
        r => r.course_id_requeriment
      );
      console.log("Este Item voy a editar", this.editedItem);
      this.dialog = true;
    },

    reset() {
      (this.editedItem.code = ""),
        (this.editedItem.name = ""),
        (this.editedItem.area = ""),
        (this.editedItem.nature = ""),
        (this.editedItem.main_objective = ""),
        (this.editedItem.secondary_objective = ""),
        (this.editedItem.theoretical_hours = ""),
        (this.editedItem.practical_hours = ""),
        (this.editedItem.credits = ""),
        (this.editedItem.level = ""),
        (this.editedItem.term = ""),
        (this.editedItem.topics = []),
        (this.editedItem.requeriments = []);
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
