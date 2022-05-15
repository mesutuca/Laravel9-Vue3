<template>
  <section class="relative py-16 bg-blueGray-50">
    <div class="w-full mb-12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-pink-900 text-white">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
          <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1 ">
              <h3 class="font-semibold text-lg text-white">İmage Upload</h3>
            </div>
          </div>
        </div>
        <div class="block w-full overflow-x-auto">
          <table class="items-center w-full bg-transparent border-collapse">
            <thead>
            <tr>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">İD</th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">GÖRSEL</th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">RESİM ADI</th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">SIRALAMA</th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">KAYIT TARİHİ</th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">DURUM</th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">İŞLEM</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(file,index) in files" :key="file.id">
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ index }}</td>
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                <img class="h-12 w-12 bg-white rounded-full border" :src="file.src" :alt="file.title" height="70">
              </td>
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ file.title }}</td>
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">0</td>
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">a</td>
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <div class="flex items-center justify-center w-full">
                  <div class="form-check form-switch">
                    <input v-model="file.status" false-value="off" true-value="on" class="form-check-input appearance-none w-9 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm" type="checkbox" role="switch">
                  </div>
                </div>
              </td>
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <button class="px-6 py-2 rounded bg-amber-400 hover:bg-amber-500 text-amber-100" @click="$emit('deleteFile',file.id)">Sil</button>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

</template>
<script>
export default {
  name: 'ImageList',
  props: ['items'],
  computed: {
    files() {
      const items = this.items
      return items
    }
  },
  methods: {
    deleteFile(id) {
      console.log(id)
    }
  }
}
</script>
<!--
<script setup>
import {getFileSize} from '../../utilities/file'

const props = defineProps({
  items: Object,
  progress: String
})

function progressBar(index) {
  return props.progress[index] + '%'
}
</script>
-->
<style scoped lang="scss">
.form-check-input {
  background-image: url("data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%22-4 -4 8 8%22%3E%3Ccircle r=%223%22 fill=%22%23fff%22/%3E%3C/svg%3E");
  background-position: 0;
  transition: background-position .15s ease-in-out;

  &:checked {
    background-position: 100%;
    background-color: #0d6efd;
    border-color: #0d6efd;
  }
}

.card {
  position: relative;
  display: flex;
  min-width: 0;
  overflow-wrap: break-word;
  background-color: rgba(255, 255, 255, var(--opacity, 1));
  background-clip: padding-box;
  box-shadow: rgba(0, 0, 0, 0.15) 0 2px 8px;
  backdrop-filter: var(--filter, blur(10px));
  -webkit-backdrop-filter: var(--filter, blur(10px));
  border: 1px solid var(--alga-border-color, rgba(0, 0, 0, .125));

  &-image {
    width: 100%;
  }

  &-figure {
    position: relative;
    width: 100%;
    margin: 0;
  }

  &-figure &-caption {
    position: absolute;
    right: 10px;
    bottom: 10px;
    z-index: 1001;
    border-radius: .25rem;
    padding: .5rem;
    background: #333;
    color: #fff;
  }

  &-content {
    display: flex;
    flex-direction: column;
  }

  &-header {
    padding: 0.5rem 1rem;
    margin-bottom: 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
  }

  &-body {
    flex: 1 1 auto;
    padding: 1rem 1rem;
  }

  &-footer {
    padding: 0.5rem 1rem;
    border-top: 1px solid rgba(0, 0, 0, 0.125);
  }

  &-title {
    margin-top: 0;
    margin-bottom: 0.5rem;
  }

  &-subtitle {
    margin-top: -0.25rem;
    margin-bottom: 0;
  }

  &-text {
    margin-bottom: 0;
  }

  & > *:first-child {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
  }

  & > *:last-child {
    border-bottom-right-radius: inherit;
    border-bottom-left-radius: inherit;
  }
}


.container {
  position: relative;
  padding: 0;
}

.item {
  width: 100%;
  height: 30px;
  background-color: #f3f3f3;
  border: 1px solid #666;
  box-sizing: border-box;
}

/* 1. declare transition */
.fade-move,
.fade-enter-active,
.fade-leave-active {
  transition: all 0.5s cubic-bezier(0.55, 0, 0.1, 1);
}

/* 2. declare enter from and leave to state */
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: scaleY(0.01) translate(30px, 0);
}

/* 3. ensure leaving items are taken out of layout flow so that moving
      animations can be calculated correctly. */
.fade-leave-active {
  position: absolute;
}
</style>