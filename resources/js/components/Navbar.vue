<template>
  <v-toolbar color="blue darken-3" dark app :clipped-left="$vuetify.breakpoint.mdAndUp" fixed>
    <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
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
export default {
  data: () => ({
    drawer: null
  })
};
</script>
