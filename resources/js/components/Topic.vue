<template>
  <v-container fluid grid-list-lg text-xs-center>
    <v-layout row wrap>
      <v-flex xs12 sm12 md12>
        <v-card>
          <v-toolbar flat color="white">
            <v-toolbar-title>Temas</v-toolbar-title>
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
                <v-btn color="primary" dark class="mb-10 ml-2" v-on="on">Nuevo Tema</v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12 md2>
                        <v-text-field v-model="editedItem.code" label="Código de tema" required></v-text-field>
                      </v-flex>

                      <v-flex xs12 md5>
                        <v-text-field v-model="editedItem.name" label="Nombre de tema" required></v-text-field>
                      </v-flex>

                      <v-flex xs12 md5>
                        <v-text-field
                          v-model="editedItem.knowledge"
                          label="Área de conocimiento"
                          required
                        ></v-text-field>
                      </v-flex>

                      <v-flex xs12 md5>
                        <v-text-field
                          v-model="editedItem.specific"
                          label="Área especifica"
                          required
                        ></v-text-field>
                      </v-flex>

                      <v-flex xs12 md7>
                        <v-textarea
                          auto-grow
                          rows="1"
                          label="Contenido"
                          v-model="editedItem.content"
                          required
                        ></v-textarea>
                      </v-flex>
                    </v-layout>

                    <v-layout wrap>
                      <v-flex xs12 md12>
                        <v-toolbar flat color="white">
                          <v-toolbar-title>Capacidades</v-toolbar-title>
                          <v-divider class="mx-2" inset vertical></v-divider>
                          <v-spacer></v-spacer>
                          <v-dialog v-model="dialog_capacity" max-width="700px">
                            <template v-slot:activator="{ on }">
                              <v-btn
                                color="primary"
                                dark
                                class="mb-2"
                                v-on="on"
                                @click="getCapacities"
                              >Agregar capacidad</v-btn>
                            </template>
                            <v-card>
                              <v-card-title>
                                <span class="headline">Seleccionar Capacidad</span>
                                <v-spacer></v-spacer>
                                <v-text-field
                                  v-model="search_capacity"
                                  append-icon="search"
                                  label="Search"
                                  single-line
                                  hide-details
                                ></v-text-field>
                              </v-card-title>
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-data-table
                                    v-model="editedItem.capacities"
                                    :headers="headers_modal"
                                    :items="capacities_all"
                                    :search="search_capacity"
                                    item-key="name"
                                    class="elevation-1"
                                  >
                                    <template v-slot:items="props">
                                      <td>
                                        <v-checkbox v-model="props.selected" primary hide-details></v-checkbox>
                                      </td>
                                      <td class="text-xs-left">{{ props.item.code}}</td>
                                      <td class="text-xs-left">{{ props.item.name }}</td>
                                    </template>
                                  </v-data-table>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                  color="error darken-1"
                                  flat
                                  @click="close_dialog_capacity"
                                >Cerrar</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-dialog>
                        </v-toolbar>

                        <v-data-table
                          :headers="headers"
                          :items="editedItem.capacities"
                          :hide-actions="true"
                          class="elevation-1"
                        >
                          <template v-slot:items="props">
                            <td class="text-md-left">{{ props.index + 1}}</td>
                            <td class="text-md-left">{{ props.item.code }}</td>
                            <td class="text-md-left">{{ props.item.name }}</td>
                            <td class="justify-center layout px-0">
                              <v-icon small @click="deleteItemCapacities(props.item)">delete</v-icon>
                            </td>
                          </template>
                          <template slot="no-data">
                            <v-alert
                              :value="true"
                              color="info"
                              icon="warning"
                              style="margin: 1.5em 0"
                            >Aún no se han agregado capacidades</v-alert>
                          </template>
                        </v-data-table>
                      </v-flex>
                      <!--
                      <v-flex xs12 md6>
                        <v-toolbar flat color="white">
                          <v-toolbar-title>Contenido</v-toolbar-title>
                          <v-divider class="mx-2" inset vertical></v-divider>
                          <v-spacer></v-spacer>
                          <v-dialog v-model="dialog_content" max-width="600px">
                            <template v-slot:activator="{ on }">
                              <v-btn
                                color="primary"
                                dark
                                class="mb-2"
                                v-on="on"
                                @click="getContents"
                              >Agregar contenido</v-btn>
                            </template>
                            <v-card>
                              <v-card-title>
                                <span class="headline">Seleccionar Contenido</span>
                              </v-card-title>
                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-data-table
                                    v-model="editedItem.contents"
                                    :headers="headers_modal"
                                    :items="contents_all"
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
                                <v-btn
                                  color="error darken-1"
                                  flat
                                  @click="close_dialog_content"
                                >Cerrar</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-dialog>
                        </v-toolbar>

                        <v-data-table
                          :headers="headers"
                          :items="editedItem.contents"
                          class="elevation-1 custom-table"
                          :hide-actions="true"
                        >
                          <template v-slot:items="props">
                            <td class="text-md-center">{{ props.index + 1}}</td>
                            <td class="text-md-center">{{ props.item.name }}</td>
                            <td class="justify-center layout px-0">
                              <v-icon small @click="deleteItemContents(props.item)">delete</v-icon>
                            </td>
                          </template>
                          <template slot="no-data">
                            <v-alert
                              :value="true"
                              color="info"
                              icon="warning"
                              style="margin: 1.5em 0"
                            >Aún no se han agregado contenido</v-alert>
                          </template>
                        </v-data-table>
                      </v-flex>-->
                    </v-layout>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="error darken-1" flat @click="close">Cancel</v-btn>
                  <v-btn color="blue darken-1" flat @click="save">Guardar Tema</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
          <v-data-table
            :headers="headers_topics"
            :items="topics"
            :search="search"
            class="elevation-1"
          >
            <template v-slot:items="props">
              <td class="text-xs-left">{{ props.item.code }}</td>
              <td class="text-xs-left">{{ props.item.name }}</td>
              <td class="text-xs-left">{{ props.item.knowledge }}</td>
              <td class="text-xs-left">{{ props.item.specific }}</td>
              <td class="text-xs-left">{{ props.item.content }}</td>
              <td class="justify-center layout px-0">
                <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
                <v-icon small @click="deleteItemTopic(props.item)">delete</v-icon>
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
    search_capacity: "",
    dialog: false,
    dialog_content: false,
    dialog_capacity: false,
    headers: [
      { text: "N°", value: "index", sortable: false },
      { text: "Código", value: "code" },
      { text: "Nombre", value: "name" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    headers_modal: [
      { text: "#", value: "", sortable: false },
      { text: "Código", value: "code" },
      { text: "Nombre", value: "name" }
    ],
    headers_topics: [
      { text: "Código", value: "code" },
      { text: "Nombre", value: "name" },
      { text: "Área de conocimiento", value: "knowledge" },
      { text: "Área de específica", value: "specific" },
      { text: "Contenido", value: "content" },
      { text: "Actions", value: "name", sortable: false }
    ],
    editedItem: {
      code: "",
      name: "",
      knowledge: "",
      specific: "",
      contents: [],
      capacities: []
    },
    topics: [],
    capacities_all: [],
    contents_all: [],
    editedIndex: -1
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo Tema" : "Editar Tema";
    }
  },

  watch: {},

  created() {
    this.initialize();
  },

  mounted() {
    axios.get("/api/capacities").then(({ data }) => {
      this.capacities_all = data;
    });
    axios.get("/api/contents").then(({ data }) => {
      this.contents_all = data;
    });
  },

  methods: {
    initialize() {
      this.getTopics();
      this.reset();
    },

    getCapacities() {
      this.search_capacity = "";
      axios.get("/api/capacities").then(({ data }) => {
        this.capacities_all = data;
      });
    },
    getContents() {
      axios.get("/api/contents").then(({ data }) => {
        this.contents_all = data;
      });
    },
    getTopics() {
      axios.get("/api/topics").then(({ data }) => {
        this.topics = data;
      });
    },

    deleteItemCapacities(item) {
      const index = this.editedItem.capacities.indexOf(item);
      confirm("Esta seguro de querer eliminar?") &&
        this.editedItem.capacities.splice(index, 1);
    },

    // deleteItemContents(item) {
    //   const index = this.editedItem.contents.indexOf(item);
    //   confirm("Esta seguro de querer eliminar?") &&
    //     this.editedItem.contents.splice(index, 1);
    // },

    close_dialog_capacity() {
      this.dialog_capacity = false;
    },
    close_dialog_content() {
      this.dialog_content = false;
    },

    save() {
      const capacities = this.editedItem.capacities.map(c => c.id);
      // const contents = this.editedItem.contents.map(c => c.id);

      const data = {
        code: this.editedItem.code,
        name: this.editedItem.name,
        knowledge: this.editedItem.knowledge,
        specific: this.editedItem.specific,
        capacities: capacities,
        content: this.editedItem.content
      };

      if (!this.editedItem.code) {
        notify.error("Ingrese el codigo de tema");
        return;
      }
      if (!this.editedItem.name) {
        notify.error("Ingrese el nombre del tema");
        return;
      }
      if (!this.editedItem.knowledge) {
        notify.error("Ingrese el área de conocimiento");
        return;
      }
      if (!this.editedItem.specific) {
        notify.error("Ingrese el área específica");
        return;
      }

      if (this.editedItem.capacities.length === 0) {
        notify.error("Agregue al menos una capacidad");
        return;
      }

      if (!this.editedItem.content) {
        notify.error("Agregue contenido");
        return;
      }

      if (this.editedIndex > -1) {
        axios
          .put("/api/topic/update/" + this.editedItem.id, data)
          .then(({ data }) => {
            notify.showCool(data.message);
            this.initialize();
            this.close();
          })
          .catch(error => {
            console.log(error.response.data.message);
            notify.error(error.response.data.message);
          });
      } else {
        axios
          .post("/api/topic/create", data)
          .then(({ data }) => {
            notify.showCool(data.message);
            this.initialize();
            this.close();
          })
          .catch(response => {
            notify.error("Ocurrio un error");
          });
      }
    },
    deleteItemTopic(item) {
      const index = this.topics.indexOf(item);
      const result = confirm("Estas seguro de querer eliminar este item?");
      if (result) {
        axios
          .delete("/api/topic/delete/" + item.id, {})
          .then(({ data }) => {
            notify.showCool(data.message);
            this.initialize();
          })
          .catch(({ error }) => {
            notify.error(error.message);
          });
      }
    },
    reset() {
      (this.editedItem.code = ""),
        (this.editedItem.name = ""),
        (this.editedItem.knowledge = ""),
        (this.editedItem.specific = ""),
        (this.editedItem.capacities = []),
        (this.editedItem.content = "");
    },
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedIndex = -1;
      }, 300);
    },
    editItem(item) {
      this.editedIndex = this.topics.indexOf(item);
      this.editedItem = Object.assign({}, item);
      console.log(this.editedItem);
      this.dialog = true;
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
