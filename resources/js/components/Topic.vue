<template>
  <v-container fluid grid-list-lg text-xs-center>
    <v-layout row wrap>
      <v-flex xs12 sm12 md12>
        <v-card>
          <v-card-title class="headline font-weight-regular border-gray">NUEVO TEMA</v-card-title>
          <v-card-text>
            <v-form>
              <!-- <v-container> -->
              <!-- wrap -->
              <v-layout wrap>
                <v-flex xs12 md2>
                  <v-text-field v-model="code" label="Código de tema" required></v-text-field>
                </v-flex>

                <v-flex xs12 md5>
                  <v-text-field v-model="name" label="Nombre de tema" required></v-text-field>
                </v-flex>

                <v-flex xs12 md5>
                  <v-text-field v-model="knowledge" label="Área de conocimiento" required></v-text-field>
                </v-flex>

                <v-flex xs12 md5>
                  <v-text-field v-model="specific" label="Área especifica" required></v-text-field>
                </v-flex>
              </v-layout>
              <!-- </v-container> -->
              <v-layout wrap>
                <v-flex xs12 md6>
                  <v-toolbar flat color="white">
                    <v-toolbar-title>Capacidades</v-toolbar-title>
                    <v-divider class="mx-2" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog_capacity" max-width="500px">
                      <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark class="mb-2" v-on="on">Agregar capacidad</v-btn>
                      </template>
                      <v-card>
                        <v-card-title>
                          <span class="headline">Seleccionar Capacidad</span>
                        </v-card-title>
                        <v-card-text>
                          <v-container grid-list-md>
                            <v-data-table
                              v-model="selected_capacities"
                              :headers="headers_modal"
                              :items="capacities"
                              item-key="name"
                              class="elevation-1"
                            >
                              <template v-slot:items="props">
                                <td>
                                  <v-checkbox v-model="props.selected" primary hide-details></v-checkbox>
                                </td>
                                <td class="text-xs-center">{{ props.index + 1}}</td>
                                <td class="text-xs-center">{{ props.item.name }}</td>
                              </template>
                            </v-data-table>
                          </v-container>
                        </v-card-text>

                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue darken-1" flat @click="close_dialog_capacity">Cerrar</v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-dialog>
                  </v-toolbar>

                  <v-data-table
                    :headers="headers"
                    :items="selected_capacities"
                    :hide-actions="true"
                    class="elevation-1 custom-table"
                  >
                    <template v-slot:items="props">
                      <td class="text-md-center">{{ props.index + 1}}</td>
                      <td class="text-md-center">{{ props.item.name }}</td>
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

                <v-flex xs12 md6>
                  <v-toolbar flat color="white">
                    <v-toolbar-title>Contenido</v-toolbar-title>
                    <v-divider class="mx-2" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog_content" max-width="500px">
                      <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark class="mb-2" v-on="on">Agregar contenido</v-btn>
                      </template>
                      <v-card>
                        <v-card-title>
                          <span class="headline">Seleccionar Contenido</span>
                        </v-card-title>
                        <v-card-text>
                          <v-container grid-list-md>
                            <v-data-table
                              v-model="selected_contents"
                              :headers="headers_modal"
                              :items="contents"
                              item-key="name"
                              class="elevation-1"
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
                          <v-btn color="blue darken-1" flat @click="close_dialog_content">Cerrar</v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-dialog>
                  </v-toolbar>

                  <v-data-table
                    :headers="headers"
                    :items="selected_contents"
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
                </v-flex>
              </v-layout>
            </v-form>
          </v-card-text>
          <v-btn color="success darken-1" dark @click="save" style="margin: 1.2em 0;">Guardar Tema</v-btn>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    dialog_content: false,
    dialog_capacity: false,
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
    knowledge: "",
    specific: "",
    capacities: [],
    selected_capacities: [],
    contents: [],
    selected_contents: []
  }),

  computed: {},

  watch: {},

  created() {
    this.initialize();
  },

  mounted() {
    axios.get("/api/capacities").then(({ data }) => {
      this.capacities = data;
    });
    axios.get("/api/contents").then(({ data }) => {
      this.contents = data;
    });
  },

  methods: {
    initialize() {
      this.capacities = [
        {
          name: "Frozen Yogurt"
        },
        {
          name: "KitKat"
        }
      ];

      this.contents = [
        {
          name: "Arror con pollo"
        },
        {
          name: "Chicharon"
        }
      ];
    },

    deleteItemCapacities(item) {
      const index = this.selected_capacities.indexOf(item);
      confirm("Esta seguro de querer eliminar?") &&
        this.selected_capacities.splice(index, 1);
    },

    deleteItemContents(item) {
      const index = this.selected_contents.indexOf(item);
      confirm("Esta seguro de querer eliminar?") &&
        this.selected_contents.splice(index, 1);
    },

    close_dialog_capacity() {
      this.dialog_capacity = false;
    },
    close_dialog_content() {
      this.dialog_content = false;
    },

    save() {
      const data = {
        code: this.code,
        name: this.name,
        knowledge: this.knowledge,
        specific: this.specific,
        capacities: this.selected_capacities,
        contents: this.selected_contents
      };

      if (!this.code) {
        notify.error("Ingrese el codigo de tema");
        return;
      }
      if (!this.name) {
        notify.error("Ingrese el nombre del tema");
        return;
      }
      if (!this.knowledge) {
        notify.error("Ingrese el área de conocimiento");
        return;
      }
      if (!this.specific) {
        notify.error("Ingrese el área específica");
        return;
      }

      if (this.selected_capacities.length === 0) {
        notify.error("Agregue al menos una capacidad");
        return;
      }

      if (this.selected_contents.length === 0) {
        notify.error("Agregue al menos un contenido");
        return;
      }

      axios
        .post("/api/topic/create", data)
        .then(({ data }) => {
          notify.showCool(data.message);
          this.reset();
        })
        .catch(response => {
          notify.error("Ocurrio un error");
        });

      this.reset();
      console.log(data);
    },
    reset() {
      (this.code = ""),
        (this.name = ""),
        (this.knowledge = ""),
        (this.specific = ""),
        (this.selected_capacities = []),
        (this.selected_contents = []);
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
