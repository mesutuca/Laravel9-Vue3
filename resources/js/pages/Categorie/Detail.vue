<template>
  <div class="bg-slate-50 flex overflow-hidden dark:bg-slate-900">
    <div
        class="relative bg-white/40 w-64 sm:w-[43rem] lg:w-64 xl:w-[43rem] mx-auto border border-slate-100">
      <form @submit.prevent="handleSubmit"
            enctype="multipart/form-data"
            class="relative h-full flex flex-col justify-center space-y-8 sm:space-y-5 lg:space-y-8 xl:space-y-5 xl:px-5">
        <img v-if="getData.image" :src="getData.image" alt="">
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Title</label>
            <input type="text" class="w-4/5 border rounded" v-model="getData.title">
          </div>
          <slug-widget :title="getData.title" @slug-changed="updateSlug"/>
        </div>
        <div
            class="flex justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Language</label>
            <select v-model="getData.language" class="w-4/5 border rounded">
              <option v-for="(lang,index) in langData" :key="index" :value="lang.slug">{{ lang.name }}</option>
            </select>
          </div>
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
import API from "../../services";
import SlugWidget from "../../components/slugWidget";
import axios from "axios";

export default {
  name: "Detail",
  props: ['id'],
  components: {SlugWidget},
  data() {
    return {

      getData: null,
      error: [],
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
    updateSlug: function (val) {
      this.slug = val;
    },
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
      form.append('title', this.getData.title)
      form.append('slug', this.getData.slug)
      form.append('language', this.getData.language)
      form.append('image', this.imageFile)
      await axios.post('/categories/' + this.id, form, config)
          .then(response => {
            console.log(response)
          })
          .catch(error => {
            this.error = error.response.data.errors;
          })
    }
  },
  async created() {
    await API.get('/categories/' + this.id)
        .then(res => {
          this.getData = res.data
        })
        .catch(err => this.$router.push({name: 'error'}))
  }
}
</script>

<style scoped>

</style>