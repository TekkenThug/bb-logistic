<template>
  <div>
      <Navbar :role="role" />
      
      <div class="container">
          <router-view></router-view>
      </div>
<!--        <message :text="'Тестовая модалка'" />-->
  </div>
</template>

<script>
import Navbar from "@/components/Navbar";

export default {
  name: "LayoutApp",

  components: { Navbar },

  props: {
    role: {
      type: String,
      required: true
    }
  }
  // mounted() {
  //     this.$echo.channel('new-order').listen('ImportantOrderCreated', (payload) => {
  //         this.info = payload;
  //     });
  // }
}
</script>

<style scoped>

</style>
