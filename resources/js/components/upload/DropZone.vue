<template>
  <div
      @dragenter.prevent="toggleActive"
      @dragleave.prevent="toggleActive"
      @dragover.prevent
      @drop.prevent="toggleActive"
      :class="{ 'active-dropzone': active }"
      class="dropzone cursor-pointer"
      @click="$refs.dropzoneFile.click()"
  >
    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Yükleme Yapmak için resmi sürükleyip bırakın</span>
      ya da tıklayın</p>
    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG (MAX. 800x400px)</p>
    <label>Dosya Seç</label>
    <input type="file" id="dropzoneFile" ref="dropzoneFile" class="dropzoneFile hidden" multiple accept="image/*"/>
  </div>
</template>

<script>
import {ref} from "vue";

export default {
  name: "DropZone",
  setup() {
    const active = ref(false);
    const toggleActive = () => {
      active.value = !active.value;
    };
    return {active, toggleActive};
  },
};
</script>

<style scoped lang="scss">
.dropzone {
  width: 400px;
  height: 200px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  row-gap: 16px;
  border: 2px dashed #41b883;
  background-color: #fff;
  transition: 0.3s ease all;

  label {
    padding: 8px 12px;
    color: #fff;
    background-color: #41b883;
    transition: 0.3s ease all;
  }

  input {
    display: none;
  }
}

.active-dropzone {
  color: #fff;
  border-color: #fff;
  background-color: #41b883;

  label {
    background-color: #fff;
    color: #41b883;
  }
}
</style>