<template>
  <FileUpload api-url="/posts"/>
</template>

<script>
import FileUpload from "../components/FileUpload/FileUpload";

export default {
  name: "Home",
  components: {FileUpload},

}
</script>

<style scoped>

</style>
