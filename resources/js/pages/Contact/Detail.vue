<template>
  <div class="bg-slate-50 flex overflow-hidden dark:bg-black">
    <div
        class="relative bg-white/40 w-64 sm:w-[43rem] lg:w-64 xl:w-[43rem] mx-auto border border-slate-100">
      <form @submit.prevent="handleSubmit"
            class="relative h-full flex flex-col justify-center space-y-8 sm:space-y-5 lg:space-y-8 xl:space-y-5 xl:px-5">
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Title</label>
            <input type="text" class="w-4/5 border rounded" v-model="getData.title">
          </div>
        </div>
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Addresss</label>
            <textarea class="w-4/5 border rounded resize-none" rows="3" v-model="getData.address"/>
          </div>
        </div>

        <draggable
            class="space-y-4"
            tag="transition-group"
            :component-data="{
          tag: 'div',
          type: 'transition-group',
          name: !drag ? 'flip-list' : null
        }"
            :list="getData.informations"
            v-bind="dragOptions"
            @start="drag = true"
            @end="drag = false"
            item-key="order"
            handle=".handle"
        >
          <template #item="{ element, index }">
            <div
                class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
              <div class="flex flex-row w-full items-center">
                <div class="cursor-move handle w-8 text-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor"
                       viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                  </svg>
                </div>
                <label for="" class="w-2/5">{{ types[`${element.name}`] }}</label>
                <input type="text" class="w-3/5 border rounded" v-model="element.value">
                <button @click="removeAt(index)">
                  <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20">
                    <path
                        d="M25.707,6.293c-0.195-0.195-1.805-1.805-2-2c-0.391-0.391-1.024-0.391-1.414,0c-0.195,0.195-17.805,17.805-18,18c-0.391,0.391-0.391,1.024,0,1.414c0.279,0.279,1.721,1.721,2,2c0.391,0.391,1.024,0.391,1.414,0c0.195-0.195,17.805-17.805,18-18C26.098,7.317,26.098,6.683,25.707,6.293z"/>
                    <path
                        d="M23.707,25.707c0.195-0.195,1.805-1.805,2-2c0.391-0.391,0.391-1.024,0-1.414c-0.195-0.195-17.805-17.805-18-18c-0.391-0.391-1.024-0.391-1.414,0c-0.279,0.279-1.721,1.721-2,2c-0.391,0.391-0.391,1.024,0,1.414c0.195,0.195,17.805,17.805,18,18C22.683,26.098,23.317,26.098,23.707,25.707z"/>
                  </svg>
                </button>
              </div>
            </div>
          </template>

        </draggable>
        {{ getData.informations }}

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="relative inline-block text-left">
          <div class="flex flex-row space-x-4">
            <button @click="addItem('phone')"
                    type="button"
                    class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
              Telefon Numarası
            </button>
            <button @click="addItem('fax')"
                    type="button"
                    class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
              Fax Numarası
            </button>
            <button @click="addItem('email')"
                    type="button"
                    class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
              E-mail Adresi
            </button>
            <button @click="addItem('whatsapp')"
                    type="button"
                    class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
              Whatsapp Numarası
            </button>
            <button @click="addItem('directions')"
                    type="button"
                    class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
              Yol Tarifi Ekle
            </button>
            <button @click="addItem('map')"
                    type="button"
                    class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
              Map Görseli Ekle
            </button>
          </div>
        </div>
        <button class="border rounded bg-amber-500 p-2" type="submit">Save</button>
      </form>
    </div>
  </div>
</template>

<script>
import draggable from "vuedraggable";
import API from "../../services";

export default {

  name: "Detail",
  display: "Transitions",
  order: 7,
  components: {
    draggable
  },

  props: ['id'],
  data() {
    return {
      getData: [],
      editForm: false,
      error: [],
      drag: false,
      idx: 0,
      types: {
        phone: 'Telefon Numarası',
        fax: 'Fax Numarası',
        email: 'E-mail Adresi',
        whatsapp: 'Whatsapp',
        directions: 'Yol Tarifi',
        map: 'Google Map',
      }
    }
  },
  computed: {
    dragOptions() {
      return {
        animation: 200,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
      };
    },
  },
  methods: {
    addItem(item) {

      this.getData.informations.push({
        order: this.idx++,
        name: item,
        value: null
      })
    },
    removeAt(idx) {
      this.getData.informations.splice(idx, 1);
      this.idx--
    },
    async handleSubmit() {
      API.put('/contacts' + '/' + this.id, this.getData)
          .then(res => {
            console.log(res)
          })
          .catch(err => {
            console.log(err)
          })
    },
  },
  async created() {
    await API.get('/contacts/' + this.id)
        .then(res => {
          this.getData = res.data
        })
        .catch(err => this.$router.push({name: 'error'}))
  },
}
</script>

<style scoped>

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

.list-group {
  min-height: 20px;
}

.list-group-item {
  cursor: move;
}

.list-group-item i {
  cursor: pointer;
}
</style>