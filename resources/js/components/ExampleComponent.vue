 <template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>

          <div class="card-body">I'm an example component. {{drawer}}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  mounted() {
    console.log("Component mounted.");
  },
  computed: {
    ...mapState(["drawer"])
  }
};
</script>
