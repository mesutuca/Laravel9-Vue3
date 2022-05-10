<template>
  <header class="bg-white dark:bg-black">
    <ul class="flex flex-row gap-2 justify-center">
      <li>
        <router-link to="/">Home</router-link>
      </li>
      <li>
        <router-link to="/about">About</router-link>
      </li>
      <li>
        <router-link to="/contact">Contact</router-link>
      </li>
      <dark-mode/>
    </ul>
  </header>
  <div class="flex flex-row justify-center items-center mx-auto w-full">
    <router-view v-slot="slotProps">
      <transition name="route" mode="out-in">
        <component :is="slotProps.Component"></component>
      </transition>
    </router-view>
  </div>
  <footer class="flex flex-row justify-center">
    Footer
  </footer>
</template>

<script>
import DarkMode from "./components/DarkMode";

export default {
  name: "App",
  components: {DarkMode}
}
</script>

<style>
.route-enter-from,
.route-leave-to {
  opacity: 0;
  transform: translateY(-30px);
}

.route-enter-active,
.route-leave-active {
  transition: all 0.3s ease;
}

.route-enter-to,
.route-leave-from {
  transform: translateY(0);
}
</style>