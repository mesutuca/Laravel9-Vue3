<template>
  <div class="home max-w-7xl">
    <div>
      <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select an
        option</label>
      <select id="countries" v-model="language"
              @change="languagechange(language)"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option v-for="(lang,index) in langs" :key="index" :value="lang.slug">{{ lang.title }}</option>
      </select>
    </div>
    <DropZone @drop.prevent="imagesInserted" @change="imagesInserted"/>
    <ProgresBar :progress="progress" v-if="isUploading"/>
    <ImageList :items="uploadedImages" @deleteFile="ImageDetele" @statusChange="statusChange"/>
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
      deneme: [],
      getFile: [],
      language: 'tr',
      langs: [
        {
          title: 'Türkçe',
          slug: 'tr'
        },
        {
          title: 'İngilizce',
          slug: 'en'
        },
        {
          title: 'Arapça',
          slug: 'ar'
        }
      ]
    }
  },
  async created() {
    await API.get(this.apiUrl + '/' + this.language)
        .then(res => {
          this.getFile = res.data
          this.uploadedImages = res.data
        })
  },
  methods: {
    async languagechange(lang) {
      await API.get(this.apiUrl + '/' + lang)
          .then(res => {
            this.uploadedImages = res.data
          })
    },
    statusChange(file) {
      console.log(file)
      API.put(this.apiUrl + '/' + file.id, file)
    },
    ImageDetele(index, id) {
      API.delete(this.apiUrl + '/' + id)
          .then(res => {
            if (res.status === 200) {
              this.uploadedImages.splice(index, 1);
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
        formData.append('language', this.language)
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
            order: element.order,
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