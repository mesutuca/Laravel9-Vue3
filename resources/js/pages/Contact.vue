<template>
  <table class="border-separate border border-slate-400">
    <thead>
    <tr>
      <th class="border border-slate-300">İd</th>
      <th class="border border-slate-300">Title</th>
      <th class="border border-slate-300">Slug</th>
      <th class="border border-slate-300">Img</th>
      <th class="border border-slate-300">Action</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(post,index) in getData" :key="index">
      <td class="border border-slate-300">{{ post.id }}</td>
      <td class="border border-slate-300">{{ post.title }}</td>
      <td class="border border-slate-300">{{ post.slug }}</td>
      <td class="border border-slate-300">
        <img :src="post.image" alt="" class="h-5 w-5">
      </td>
      <td class="border border-slate-300">
        <button id="show-modal" @click="handleModal(post.image)">Show Modal</button>
      </td>
    </tr>
    </tbody>
  </table>
  <Teleport to="body">
    <modal :show="showModal" @close="showModal = false">
      <template>
        <img :src="ImageModal" alt="">
      </template>
    </modal>
  </Teleport>
</template>

<script>
import axios from "axios";
import Modal from '../components/Modal'

export default {
  name: "Contact",
  data() {
    return {
      getData: null,
      showModal: false,
      ImageModal: null
    }
  },
  components: {
    Modal
  },
  methods: {
    handleModal(image) {
      this.ImageModal = image;
      this.showModal = true
    }
  },
  async created() {
    await axios.get('/post')
        .then(response => {
          this.getData = response.data
        })
        .catch(error => {
          console.log(error)
        })

  }
}
</script>

<style scoped>

</style>