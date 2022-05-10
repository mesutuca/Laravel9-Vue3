<template>
  <div class="theme-switch-wrapper">
    <label class="theme-switch" for="checkbox">
      <input type="checkbox" id="checkbox" v-model="darkMode" @change="toggleMode">
    </label>
  </div>
</template>

<script setup>
import {ref, computed} from "vue";

const darkMode = ref(false)
const currentTheme = localStorage.getItem("theme") ? localStorage.getItem("theme") : null;
if (currentTheme) {
  document.documentElement.setAttribute("data-theme", currentTheme);

  if (currentTheme === "dark") {
    darkMode.value = true;
    // toggleSwitch.checked = true;
  }
}

function toggleMode(event) {
  if (darkMode.value) {
    document.documentElement.setAttribute("data-theme", "dark");
    localStorage.setItem("theme", "dark"); //add this
  } else {
    document.documentElement.setAttribute("data-theme", "light");
    localStorage.setItem("theme", "light"); //add this
  }
}
</script>

<style scoped>

</style>