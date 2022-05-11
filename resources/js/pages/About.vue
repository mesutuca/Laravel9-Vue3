<template>
  <div class="home">
    <DropZone @drop.prevent="drop" @change="selectedFile"/>
    <ImageList :items="dropzoneFile"/>
  </div>
</template>

<script setup>
import DropZone from "../components/upload/DropZone";
import {ref} from "vue";
import ImageList from "../components/upload/ImageList";

let dropzoneFile = ref([]);
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
</script>

<style scoped lang="scss">
.home {
  height: 100vh;
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