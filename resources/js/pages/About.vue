<template>
  <div class="home max-w-7xl">
    <DropZone @drop.prevent="drop" @change="selectedFile"/>
    <ImageList :items="dropzoneFile" :progress="fileProgress"/>
  </div>
</template>

<script setup>
import DropZone from "../components/upload/DropZone";
import {ref, watch} from "vue";
import ImageList from "../components/upload/ImageList";
import axios from "axios";

let dropzoneFile = ref([]);
let fileProgress = ref({});
const drop = (e) => {
  for (let i = 0; i < e.dataTransfer.files.length; i++) {
    const file = e.dataTransfer.files[i];
    let reader = new FileReader();
    reader.addEventListener('load', () => {
      dropzoneFile.value.push({
        name: file.name,
        data: reader.result,
        type: file.type,
        size: file.size
      });
    }, {once: true});
    reader.readAsDataURL(file)
  }
};
const selectedFile = () => {
  for (let i = 0; i < document.querySelector(".dropzoneFile").files.length; i++) {
    const file = document.querySelector(".dropzoneFile").files[i];
    let reader = new FileReader();
    reader.addEventListener('load', () => {
      dropzoneFile.value.push({
        name: file.name,
        data: reader.result,
        type: file.type,
        size: file.size
      });
    }, {once: true});
    reader.readAsDataURL(file)
  }
}
watch(dropzoneFile, (newVal) => {
  newVal.forEach((item, index) => {
    setData(item, index).then(res => console.log(res))
  })
}, {deep: true})

async function setData(file, index) {
  const form = new FormData();
  form.append('image', file)
  const response = await axios.post('/postimage', form, {
    onUploadProgress: (progressEvent) => {
      const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');
      if (totalLength !== null) {
        fileProgress.value[index] = Math.round((progressEvent.loaded * 100) / totalLength);
      }
    }
  })
  return response
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