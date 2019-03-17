<template>
  <v-toolbar color="blue darken-3" dark app :clipped-left="$vuetify.breakpoint.mdAndUp" fixed>
    <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
      <v-toolbar-side-icon @click.stop="state = !state" v-model="state"></v-toolbar-side-icon>
      <span class="hidden-sm-and-down">Plan Estudios</span>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn icon>
      <v-icon>apps</v-icon>
    </v-btn>
    <v-btn icon>
      <v-icon>notifications</v-icon>
    </v-btn>
    <v-btn icon large>
      <v-avatar size="32px" tile>
        <img src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png" alt="Vuetify">
      </v-avatar>
    </v-btn>
  </v-toolbar>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  data() {
    return {
      state: true,
      name: ""
    };
  },
  watch: {
    // whenever question changes, this function will run
    state: function() {
      console.log("hola");
    }
  },
  computed: {
    ...mapState(["drawer"])
  },
  watch: {
    state: function(val, old) {
      return this.sendState(val);
    }
  },
  methods: {
    ...mapActions(["modifyDrawer"]),
    sendState: function(value) {
      this.modifyDrawer(value);
    }
  }
};
</script>
