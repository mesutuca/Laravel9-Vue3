<template>
  <div class="bg-slate-50 flex overflow-hidden h-[28rem]">
    <div
      class="relative bg-white/40 w-64 sm:w-[28rem] lg:w-64 xl:w-[28rem] mx-auto border border-slate-100 ">
      <form @submit.prevent="handleSubmit"
            enctype="multipart/form-data"
            class="relative h-full flex flex-col justify-center space-y-8 sm:space-y-5 lg:space-y-8 xl:space-y-5 xl:px-5">
        <img v-show="imageUrl" :src="imageUrl" alt="">
        <div>
          <ul>
            <li v-for="(err,arr,index) in error" :key="index">
              <b>{{ arr }}</b> {{ err }}
            </li>
          </ul>
        </div>
        <div
          class="flex justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <label for="" class="w-1/5">Name</label>
          <input type="text" class="w-4/5 border rounded" v-model="name">
        </div>
        <div
          class="flex justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <label for="" class="w-1/5">Slug</label>
          <input type="text" class="w-4/5 border rounded" v-model="slug">
        </div>
        <div
          class="flex justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <label for="" class="w-1/5">Upload</label>
          <input @change="handleImageSelected" type="file" class="w-4/5 border rounded">
        </div>
        <button class="border rounded bg-amber-500 p-2" type="submit">Upload</button>
      </form>
    </div>
  </div>

</template>

<script>
import axios from "axios";

export default {
  name: "FileUpload",
  data() {
    return {
      name: '',
      slug: '',
      imageUrl: '',
      imageFile: '',
      error: []
    }
  },
  methods: {
    handleImageSelected(e) {
      if (!e.target.files.length) return;
      this.imageFile = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.imageFile);
      reader.onload = e => {
        this.imageUrl = e.target.result;
      };
    },
    async handleSubmit() {
      const config = {headers: {'content-type': 'multipart/form-data'}}
      const form = new FormData();
      form.append('name', this.name)
      form.append('slug', this.slug)
      form.append('image', this.imageFile)
      await axios.post('/post', form, config)
        .then(response => {
          console.log(response)
        })
        .catch(error => {
          this.error = error.response.data.errors;
        })
    }
  }
}
</script>

<style scoped>

</style>
