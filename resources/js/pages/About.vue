<template>
  <div class="home max-w-7xl">
    <DropZone @drop.prevent="drop" @change="selectedFile"/>
    <ImageList :items="dropzoneFile" :progress="fileProgress"/>
  </div>
</template>

<script>
import axios from "axios";
import DropZone from "../components/upload/DropZone";
import ImageList from "../components/upload/ImageList";

export default {
  data() {
    return {
      dropzoneFile: [],
      fileProgress: [],
      form : new FormData()
    }
  },
  methods: {
    drop(e) {
      console.log(e)
    },
    selectedFile(e) {

      const selectedFiles = e.target.files
      if (!selectedFiles) {
        return false
      }
      for (let i = 0; i < selectedFiles.length; i++) {
        this.dropzoneFile.push(selectedFiles[i])
      }
      this.handleSubmit()
    },
    async handleSubmit() {
      const config = {headers: {'content-type': 'multipart/form-data'}}

      for (let i = 0; i < this.dropzoneFile.length; i++) {
        this.form.append('image[]', this.dropzoneFile[i])
      }

      await axios.post('/postimage', this.form, config)
          .then(response => {
            console.log(response)
          })
          .catch(error => {
            this.error = error.response.data.errors;
          })
    }
  },
  components: {
    DropZone,
    ImageList
  }
}

</script>

<style scoped lang="scss">
.home {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background-color: #f1f1f1;

  h1 {
    font-size: 40px;
    margin-bottom: 32px;
  }

  .file-info {
    margin-top: 32px;
  }
}
</style>