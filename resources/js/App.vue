<template>
  <header>
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
    </ul>
  </header>
  <div class="flex flex-row justify-center items-center mx-auto w-full">
    <router-view/>
  </div>
  <footer class="flex flex-row justify-center">
    Footer
  </footer>
</template>

<script>
export default {
  name: "App"
}
</script>

<style scoped>

</style>