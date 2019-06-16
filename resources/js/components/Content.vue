<template>
  <v-container fluid grid-list-lg text-xs-center>
    <v-layout row wrap>
      <v-flex xs12 sm12 md12>
        <v-card>
          <v-toolbar flat color="white">
            <v-toolbar-title>CONTENIDOS</v-toolbar-title>
            <v-divider class="mx-2" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="500px">
              <template v-slot:activator="{ on }">
                <v-btn color="primary" dark class="mb-2" v-on="on">Nuevo Contenido</v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12 sm6 md4>
                        <v-text-field v-model="editedItem.code" label="Código"></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm8 md8>
                        <v-text-field v-model="editedItem.name" label="Nombre"></v-text-field>
                      </v-flex>
                    </v-layout>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="error darken-1" flat @click="close">Cancel</v-btn>
                  <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
          <v-data-table :headers="headers" :items="contents" class="elevation-1">
            <template v-slot:items="props">
              <td class="text-xs-center">{{ props.item.code }}</td>
              <td class="text-xs-center">{{ props.item.name }}</td>
              <td class="justify-center layout px-0">
                <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
                <v-icon small @click="deleteItem(props.item)">delete</v-icon>
              </td>
            </template>
            <template slot="no-data">
              <v-alert
                :value="true"
                color="info"
                icon="warning"
                style="margin: 1.5em 0"
              >Aún no se han agregado contenidos :(</v-alert>
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
    dialog: false,
    headers: [
      { text: "Código", value: "code" },
      { text: "Nombre", value: "name" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    contents: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      code: ""
    },
    defaultItem: {
      name: "",
      code: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nueva Contenido" : "Editar Contenido";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  mounted() {
    axios.get("/api/contents").then(({ data }) => {
      this.contents = data;
    });
  },
  methods: {
    initialize() {
      this.reset();
      this.close();
      this.getcontents();
    },

    getcontents() {
      axios.get("/api/contents").then(({ data }) => {
        this.contents = data;
      });
    },
    editItem(item) {
      this.editedIndex = this.contents.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.contents.indexOf(item);
      const result = confirm("Estas seguro de querer eliminar este item?");
      if (result) {
        axios
          .delete("/api/content/delete/" + item.id, {})
          .then(({ data }) => {
            notify.showCool(data.message);
            this.initialize();
          })
          .catch(({ error }) => {
            notify.error(error.message);
          });
      }
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },
    reset() {
      this.editedItem["code"] = "";
      this.editedItem["name"] = "";
    },

    save() {
      if (this.editedIndex > -1) {
        // Object.assign(this.contents[this.editedIndex], this.editedItem);
        axios
          .put("/api/content/update/" + this.editedItem.id, {
            code: this.editedItem.code,
            name: this.editedItem.name
          })
          .then(({ data }) => {
            notify.showCool(data.message);
            this.initialize();
          })
          .catch(error => {
            console.log(error.response.data.message);
            notify.error(error.response.data.message);
          });
      } else {
        if (!this.editedItem.code) {
          notify.error("Ingrese código");
          return;
        }
        if (!this.editedItem.name) {
          notify.error("Ingrese nombre ");
          return;
        }
        const data = {
          code: this.editedItem.code,
          name: this.editedItem.name
        };
        axios
          .post("/api/content/create", data)
          .then(({ data }) => {
            notify.showCool(data.message);
            this.initialize();
          })
          .catch(error => {
            console.log("Entro aqui");
            notify.error(error.response.data.message);
            // notify.error("Ocurrio un problema");
          });
      }
    }
  }
};
</script>
