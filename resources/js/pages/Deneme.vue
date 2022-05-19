<template>
  <Multi api-url="/postimage"/>
</template>

<script>
import yeniolsun from '../components/yeniolsun'
import Multi from "../components/MultiUpload/Multi";

export default {
  name: "Deneme",
  components: {
    Multi,
    Dropzone: yeniolsun
  }
}
</script>

<style scoped>

</style>