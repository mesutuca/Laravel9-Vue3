<template>
  <div class="bg-slate-50 flex overflow-hidden dark:bg-black">
    <div
        class="relative bg-white/40 w-64 sm:w-[43rem] lg:w-64 xl:w-[43rem] mx-auto border border-slate-100">
      <form @submit.prevent=""
            class="relative h-full flex flex-col justify-center space-y-8 sm:space-y-5 lg:space-y-8 xl:space-y-5 xl:px-5">
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Title</label>
            <input type="text" class="w-4/5 border rounded" v-model="title">
          </div>
        </div>
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Addresss</label>
            <textarea class="w-4/5 border rounded" v-model="address"></textarea>
          </div>
        </div>

        <div v-for="(item,index) in Items" :key="index"
             class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">{{ item.label }}</label>
            <input type="text" class="w-4/5 border rounded" v-model="item.value">
            <button class="border border-gray-300" @click="removeItem(index)">Remove</button>
          </div>
        </div>
        {{ Items }}

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="relative inline-block text-left">
          <div>
            <button @click="addItem('phone')"
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
              Telefon
            </button>
            <button @click="addItem('fax')"
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
              Fax
            </button>
            <button @click="addItem('email')"
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
              E-mail
            </button>
            <button @click="addItem('whatsapp')"
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
              Whatsapp
            </button>
          </div>
        </div>
        <button class="border rounded bg-amber-500 p-2" type="submit">Save</button>
      </form>
    </div>
  </div>

  <draggable
      class="list-group flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3"
      tag="transition-group"
      :component-data="{
          tag: 'div',
          type: 'transition-group',
          name: !drag ? 'flip-list' : null
        }"
      :list="Items"
      v-bind="dragOptions"
      @start="drag = true"
      @end="drag = false"
      item-key="order"

  >
    <template #item="{ element, index }">
      <div class="flex flex-row w-full cursor-move">
        <label for="" class="w-1/5">{{ element.name }}</label>
        <input type="text" class="w-4/5 border rounded" v-model="element.text">
        <i class="fa fa-times close" @click="removeAt(index)"></i>
      </div>
    </template>

  </draggable>
</template>

<script>
import draggable from "vuedraggable";

let id = 1;

export default {
  name: "Add",
  display: "Transitions",
  order: 7,
  components: {
    draggable
  },
  data() {
    return {
      title: '',
      address: '',
      googleAdres: '',
      Items: [],
      drag: false
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
    }
  },
  methods: {
    addItem(item) {
      id++;
      this.Items.push({
        order: id,
        name: item,
        text: null
      })
    },
    removeAt(idx) {
      this.Items.splice(idx, 1);
    },
    checkMove: function (e) {
      window.console.log("Future index: " + e.draggedContext.futureIndex);
    }
  }
}
</script>

<style scoped>
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