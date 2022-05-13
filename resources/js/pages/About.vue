<template>
  <div class="home max-w-7xl">
    <DropZone @drop.prevent="handleFiles" @change="handleFiles"/>
    <ImageList :items="fileitems" :progress="fileProgress"/>
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
      fileitems: [],
    }
  },
  watch: {
    dropzoneFile: {
      handler(newVal) {
        const fileItemLength = ((this.fileitems.length >= 1) ? this.fileitems.length : 0) + 1;
        if (newVal.length >= 1) {
          newVal.forEach((item, index) => {
            const id = fileItemLength + index
            this.storeFiles(item, id)
                .then(res => {
                  const storeObj = {
                    id: id,
                    item: item
                  }
                  this.fileitems.push(storeObj)
                })
          })
        }

      },
      deep: true
    }
  },
  methods: {
    async getAllFiles() {
      // const response = await axios.get('/postimage')
      // return response.json()
    },
    async storeFiles(file, index) {
      const config = {
        headers: {'content-type': 'multipart/form-data'},
        onUploadProgress: (progressEvent) => {
          let context = this
          const totalLength = progressEvent.lengthComputable ? progressEvent.total : null;
          console.log("onUploadProgress", totalLength);
          if (totalLength !== null) {
            context.fileProgress[index] = Math.round((progressEvent.loaded * 100) / progressEvent.total);
          }
        }
      }
      const formData = new FormData();
      formData.append('file', file)
      await axios.post('/postimage', formData, config)
          .then(response => {
            return (response + 'axios')
          })
          .catch(error => {
            this.error = error.response.data.errors;
          })
    },
    handleFiles(e) {
      const inputValue = e.target.files || e.dataTransfer.files || this.$refs.dropzoneFile.files
      for (let i = 0; i < inputValue.length; i++) {
        const fileitem = inputValue[i]
        this.dropzoneFile.push(fileitem)
      }
    },
  },

  components: {DropZone, ImageList}
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