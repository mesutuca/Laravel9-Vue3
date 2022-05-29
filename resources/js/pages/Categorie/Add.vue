<template>
  <FileUpload api-url="/categories" @DBdata="onChange"/>
</template>

<script>
import FileUpload from "../../components/FileUpload/FileUpload";

export default {
  name: "Add",
  components: {FileUpload},
  methods: {
    onChange(a) {
      console.log('EMİT', a)
    }
  }
}
</script>

<style scoped>

</style>