<template>
  <v-navigation-drawer fixed :clipped="$vuetify.breakpoint.mdAndUp" app :value="drawer">
    <v-list dense>
      <v-list-tile value="true" v-for="(item, i) in items" :key="i" :to="item.path">
        <v-list-tile-action>
          <v-icon light v-html="item.icon"></v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title v-text="item.text"></v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import { mapState } from "vuex";

export default {
  data() {
    return {
      dialog: true,
      items: [
        { icon: "business", text: "Temas", path: "temas" },
        { icon: "dialpad", text: "Curriculo", path: "curriculo" },
        { icon: "content_copy", text: "Plan", path: "plan" }
      ]
    };
  },
  computed: {
    ...mapState(["drawer"])
  },
  props: {
    source: String
  }
};
</script>

