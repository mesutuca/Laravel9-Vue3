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
        <div style="background: blue;display: none">{{ items }}</div>
        <div style="background: red;display: none">{{ itemsnew }}</div>
        <div @click="deleteSelect" type="button">Seçili Verileri Sil</div>
        <div class="block w-full overflow-x-auto">
          <table class="items-center w-full bg-transparent border-collapse">
            <thead>
            <tr>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                <input
                    class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                    type="checkbox" v-model="selectAll" :indeterminate.prop="deneme">
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                <svg xmlns="http://www.w3.org/2000/svg" height="20" fill="currentColor" class="bi bi-justify"
                     viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                        d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                İD
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                GÖRSEL
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                RESİM ADI
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                SIRALAMA
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                KAYIT TARİHİ
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                DURUM
              </th>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">
                İŞLEM
              </th>
            </tr>
            </thead>
            <!--            <tbody>-->
            <!-- Detaylı kontrol edilelebilir  https://github.com/SortableJS/vue.draggable.next#componentdata -->
            <draggable v-model="itemsnew" handle=".handle" tag="tbody" item-key="order" @change="log" :move="moveeee">
              <template #item="{ element,index }">
                <tr>
                  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    <input
                        class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="checkbox" v-model="selected" :value="element.id" number>
                  </td>
                  <td class="handle cursor-move border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" fill="currentColor" class="bi bi-justify"
                         viewBox="0 0 16 16">
                      <path fill-rule="evenodd"
                            d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                  </td>
                  <!--            <tr v-for="(file,index) in files" :key="file.id">-->
                  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    {{ element.id }}
                  </td>
                  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                    <img class="h-12 w-12 bg-white rounded-full border" :src="element.image" :alt="element.title"
                         height="70">
                  </td>
                  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    {{ element.title }}
                  </td>
                  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    {{ element.order }}
                  </td>
                  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">a</td>
                  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    <div class="flex items-center justify-center w-full">
                      <div class="form-check form-switch">
                        <input v-model="element.status" false-value="off" true-value="on"
                               class="form-check-input-switch appearance-none w-9 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
                               type="checkbox" role="switch"
                               @change="$emit('statusChange',element)">
                      </div>
                    </div>
                  </td>
                  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    <router-link :to="{name: 'ImageEdit', params: {id: element.id}}"
                                 class="px-6 py-2 rounded bg-amber-400 hover:bg-amber-500 text-amber-100">Düzenle
                    </router-link>
                    <button class="px-6 py-2 rounded bg-amber-400 hover:bg-amber-500 text-amber-100"
                            @click="$emit('deleteFile',index,element.id)">Sil
                    </button>
                  </td>
                </tr>
              </template>
            </draggable>
            <!--            </tbody>-->
          </table>
        </div>
      </div>
    </div>
  </section>

</template>


<script setup>
import draggable from "vuedraggable";
import API from "../../services";
import {ref, computed, watch, watchEffect, defineEmits} from "vue";

const props = defineProps({
  items: Object,
})
const itemsnew = ref()
const emit = defineEmits(['orderChange'])
const selected = ref([])

watch(() => [...props.items], (currentValue, oldValue) => {
  itemsnew.value = currentValue
});
// const items = computed(() => {
//   return itemsnew.value = props.items;
// })
const deneme = ref(false);

const selectAll = computed(({
  get() {
    if (selected.value.length === props.items.length) {
      deneme.value = false
      return true
    } else if (selected.value.length > 0 && selected.value.length !== props.items.length) {
      deneme.value = true
    } else {
      deneme.value = false
      return false
    }
    // return props.items ? selected.value.length === props.items.length : false;
  },
  set(value) {
    let checked = [];
    if (value) {
      props.items.forEach(function (item) {
        checked.push(item.id);
      });
    }
    selected.value = checked;
  }
}))

// watchEffect(async () => itemsnew.value = await props.items)
function log() {

  itemsnew.value.map((testimonial, index) => {
    testimonial.order = index + 1;
  })
  emit('orderChange', itemsnew.value)

}
function deleteSelect() {
  API.put('/sliders/deleteAll', {
    testimonials: selected.value
  }).then((response) => {
    console.log(response)
  })
}
function moveeee(evt) {
  // console.log(evt)
}

</script>

<style scoped lang="scss">

.button {
  margin-top: 35px;
}

.flip-list-move {
  transition: transform 0.5s;
}

.no-move {
  transition: transform 0s;
}

.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}

.sortable-ghost {
  opacity: 0.5;
  background: #c8ebfb;
}

.list-group {
  min-height: 20px;
}

.list-group-item {
  cursor: move;
}

.list-group-item i {
  cursor: pointer;
}

.form-check-input-switch {
  background-image: url("data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%22-4 -4 8 8%22%3E%3Ccircle r=%223%22 fill=%22%23fff%22/%3E%3C/svg%3E");
  background-position: 0;
  transition: background-position .15s ease-in-out;

  &:checked {
    background-position: 100%;
    background-color: #0d6efd;
    border-color: #0d6efd;
  }
}

.form-check-input-in {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e");

  &:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
  }
}

.form-check-input {

  &:checked {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
    background-color: #0d6efd;
    border-color: #0d6efd;
  }

  &:indeterminate {
    background-color: #0d6efd;
    border-color: #0d6efd;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e");
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