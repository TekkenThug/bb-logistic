<template>
  <div :class="$style.DefaultLayout">
    <Sidebar :class="$style.sidebar" />

    <main :class="$style.main">
      <ThemeToggle :class="$style.themeToggle" />

      <router-view />
    </main>
    <!--        <message :text="'Тестовая модалка'" />-->

    <Footer />
  </div>
</template>

<script setup>
import Footer from "@/components/common/footer";
import Sidebar from "@/components/common/sidebar";
import ThemeToggle from "@/components/common/theme-toggle"

// mounted() {
  //     this.$echo.channel('new-order').listen('ImportantOrderCreated', (payload) => {
  //         this.info = payload;
  //     });
  // }
</script>

<style module>
.DefaultLayout {
  display: grid;
  grid-template-columns: 240px 1fr;
  grid-template-rows: 1fr 60px;
  min-height: 100vh;
}

.main {
  padding: 40px;
  flex-grow: 1;
}

.sidebar {
  grid-area: 1 / 1 / 3 / 2; 
}

.themeToggle {
  position: absolute;
  top: 20px;
  right: 40px;
}
</style>