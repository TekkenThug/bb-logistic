<template>
  <div :class="$style.DefaultLayout">
    <Sidebar />

    <main :class="$style.main">
      <ThemeToggle :class="$style.themeToggle" />

      <router-view />
    </main>
    <!--        <message :text="'Тестовая модалка'" />-->

    <Footer :class="$style.footer" />
  </div>
</template>

<script setup>
import Footer from '@/components/common/footer';
import Sidebar from '@/components/common/sidebar';
import ThemeToggle from '@/components/common/theme-toggle';

// mounted() {
  //     this.$echo.channel('new-order').listen('ImportantOrderCreated', (payload) => {
  //         this.info = payload;
  //     });
  // }
</script>

<style module>
.DefaultLayout {
  display: grid;
  grid-template-rows: 1fr 60px;
  min-height: 100vh;
}

.main {
  padding: 40px;
  flex-grow: 1;
}

.main,
.footer {
  margin-left: 52px;
}

.themeToggle {
  position: absolute;
  top: 20px;
  right: 40px;
}
</style>