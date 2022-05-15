<template>
  <div class="home max-w-7xl">
    <DropZone @drop.prevent="imagesInserted" @change="imagesInserted"/>
    <ProgresBar :progress="progress" v-if="isUploading"/>
    <ImageList :items="uploadedImages" @deleteFile="ImageDetele"/>
  </div>
</template>

<script>
import API from "../../services";
import DropZone from "../../components/upload/DropZone";
import ImageList from "../../components/upload/ImageList";
import ProgresBar from "./ProgresBar";

export default {
  name: 'Multi',
  props: {
    apiUrl: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      progress: 0,
      files: null,
      isUploading: false,
      uploadedImages: [],
      getFile: []
    }
  },
  async created() {
    await API.get(this.apiUrl)
        .then(res => {
          this.getFile = res.data
          this.uploadedImages = res.data
        })
  },
  methods: {
    ImageDetele(id) {
      // console.log(this.uploadedImages.target)
      // console.log(id)
      API.delete(this.apiUrl + '/' + id)
          .then(res => {
            if (res.status === 200) {
              this.uploadedImages.splice(this.uploadedImages.indexOf(id), 1);
            }
          })
          .catch(err => {
            console.log(err)
          })
    },
    async imagesInserted(e) {
      this.files = e.target.files || e.dataTransfer.files;
      await this.uploadImagesMethod();
    },
    async uploadImagesMethod() {
      this.isUploading = true;
      let formData = new FormData();
      for (let file of this.files) {
        formData.append('file_name[]', file, file.name)
      }
      this.isUploading = true;
      await API.post(this.apiUrl, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
        onUploadProgress: e => {
          if (e.lengthComputable) {
            this.progress = (e.loaded / e.total) * 100
          }
        }
      }).then(res => {
        res.data.forEach(element => {
          this.uploadedImages.push({
            id: element.id,
            title: element.title,
            src: element.src,
            status: element.status,
          })
        })

        setTimeout(() => {
          this.isUploading = false;
          this.files = null;
        }, 1000)

      }).catch(err => {
        console.log(err)
      })
    },
  },

  components: {ProgresBar, DropZone, ImageList}
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