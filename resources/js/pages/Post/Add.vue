<template>
  <FileUpload api-url="/posts"/>
</template>

<script>
import FileUpload from "../../components/FileUpload/FileUpload";

export default {
  name: "Add",
  components: {FileUpload}
}
</script>

<style scoped>

</style>