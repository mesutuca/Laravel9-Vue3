<template>
  <Multi api-url="/postimage" :id="this.$route.params.id"/>
</template>

<script>
import Multi from "../../components/MultiUpload/Multi";

export default {
  name: "Images",
  components: {
    Multi

  }
}
</script>

<style scoped>

</style>