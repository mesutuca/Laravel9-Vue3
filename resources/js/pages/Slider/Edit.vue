<template>
  <div class="bg-slate-50 flex overflow-hidden dark:bg-slate-900">
    <div>
      <button v-if="!editForm" @click="editForm = true">Düzenle</button>
      <button v-else @click="editForm = false">Kapat</button>
    </div>
    <div
        class="relative bg-white/40 w-64 sm:w-[43rem] lg:w-64 xl:w-[43rem] mx-auto border border-slate-100">
      <form @submit.prevent="handleChange(getData.id)"
            enctype="multipart/form-data"
            class="relative h-full flex flex-col justify-center space-y-8 sm:space-y-5 lg:space-y-8 xl:space-y-5 xl:px-5">
        <img v-if="getData.image" :src="getData.image" :alt="getData.title">
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Title</label>
            <input type="text" class="w-4/5 border rounded" v-model="getData.title" :disabled="!editForm">
          </div>
        </div>
        <div
            class="flex justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Language</label>
            <select v-model="getData.language" class="w-4/5 border rounded" :disabled="!editForm">
              <option v-for="(lang,index) in langData" :key="index" :value="lang.slug">{{ lang.name }}</option>
            </select>
          </div>
        </div>
        <div
            class="flex justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <label for="" class="w-1/5">Upload</label>
          <input @change="handleImageSelected" type="file" class="w-4/5 border rounded" :disabled="!editForm">
        </div>
        <button class="border rounded bg-amber-500 p-2" type="submit">Upload</button>
      </form>
    </div>
  </div>
</template>

<script>
import API from "../../services";

export default {
  name: "Edit",
  props: ['id'],
  data() {
    return {
      getData: [],
      editForm: false,
      langData: [
        {
          name: 'Türkçe',
          slug: 'tr',
        },
        {
          name: 'İngilizce',
          slug: 'en',
        },
        {
          name: 'Arapça',
          slug: 'arr',
        }
      ],
    }
  },
  methods: {
    handleImageSelected(e) {
      if (!e.target.files.length) return;
      this.imageFile = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.imageFile);
      reader.onload = e => {
        this.getData.image = e.target.result;
      };
    },
    async handleChange(id) {
      const config = {headers: {'content-type': 'multipart/form-data'}}
      const form = new FormData();
      form.append('title', this.getData.title);
      form.append('language', this.getData.language)
      form.append('order', this.getData.order)
      form.append('image', this.imageFile ? this.imageFile : this.getData.image)
      form.append('status', this.getData.status)
      form.append('_method', 'PUT')
      await API.post('/sliders' + '/' + id, form)
    }
  },
  created() {
    API.get('/sliders/' + this.id + '/detail')
        .then(res => {
          this.getData = res.data
        })
    // .catch(err => this.$router.push({name: 'error'}))
  }
}
</script>

<style scoped>

</style>