<template>
    <div :class="$style.DefaultLayout">
        <Navbar :role="role" />
        
        <main :class="$style.main">
          <div class="container">
            <router-view></router-view>
          </div>
        </main>
  <!--        <message :text="'Тестовая модалка'" />-->
        <Footer />
    </div>
  </template>
  
  <script>
  import Navbar from "@/components/navbar";
  import Footer from "@/components/footer";
  
  export default {
    name: "DefaultLayout",
  
    components: { Navbar, Footer },
  
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
  
  <style module>
    .DefaultLayout {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .main {
      flex-grow: 1;
    }
  </style>
  