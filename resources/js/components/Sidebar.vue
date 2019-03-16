<template>
  <v-navigation-drawer fixed :clipped="$vuetify.breakpoint.mdAndUp" app v-model="drawer">
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
export default {
  data: () => ({
    drawer: null,
    dialog: false,
    items: [
      { icon: "business", text: "Temas", path: "temas" },
      { icon: "dialpad", text: "Cursos", path: "cursos" },
      { icon: "content_copy", text: "Plan", path: "plan" }
    ]
  }),
  props: {
    source: String
  }
};
</script>

