<template>
  <div class="bg-slate-50 flex overflow-hidden dark:bg-black">
    <div
        class="relative bg-white/40 w-64 sm:w-[43rem] lg:w-64 xl:w-[43rem] mx-auto border border-slate-100">
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
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Title</label>
            <input type="text" class="w-4/5 border rounded" v-model="title">
          </div>
          <slug-widget :title="title" :subdirectory="categori_slug" @slug-changed="updateSlug"/>
        </div>
        <div
            class="flex justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Language</label>
            <select v-model="language" class="w-4/5 border rounded">
              <option v-for="(lang,index) in langData" :key="index" :value="lang.slug">{{ lang.name }}</option>
            </select>
          </div>
        </div>
        <div v-if="additionalInput"
             class="flex justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Categori</label>
            <select class="w-4/5 border rounded" v-model="catID">
              <option v-for="(cat,index) in categories" :key="index" :value="cat.id">{{ cat.title }}</option>
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
import slugWidget from "./../slugWidget";
import API from "../../services";


export default {
  name: "FileUpload",
  props: {
    apiUrl: {
      type: String,
      required: true
    },
    additionalInput: {
      type: Boolean,
      required: false,
    }
  },
  inject:['addNewItem'],
  components: {
    slugWidget
  },

  data() {
    return {
      title: '',
      slug: '',
      language: 'tr',
      imageUrl: '',
      imageFile: '',
      categories: [],
      catID: '',
      categori_slug: null,
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

  async created() {
    if (this.additionalInput) {
      await API.get('/categories')
          .then(res => {
            this.categories = res.data
          })
    }
  },
  methods: {
    dynamicModel() {
    },
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
      form.append('title', this.title)
      form.append('slug', this.slug)
      if (this.additionalInput) {
        form.append('cat_id', this.catID)
      }
      form.append('language', this.language)
      form.append('image', this.imageFile)
      await API.post(this.apiUrl, form, config)
          .then(response => {
            this.addNewItem(response.data.data)
          })
          .catch(error => {
            this.error = error.response.data.errors;
          })
    }
  },
  watch: {
    catID: {
      handler: function (val) {
        return this.categories.find(element => {
          if (element.id === val) {
            return this.categori_slug = element.slug
          }
        });
      },
      deep: true
    }
  }
}
</script>

<style scoped>

</style>
