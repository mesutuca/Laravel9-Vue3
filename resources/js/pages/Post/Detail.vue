<template>
  <div class="bg-slate-50 flex overflow-hidden h-[40rem] dark:bg-black">
    <div
        class="relative bg-white/40 w-64 sm:w-[43rem] lg:w-64 xl:w-[43rem] mx-auto border border-slate-100">
      <form
            enctype="multipart/form-data"
            class="relative h-full flex flex-col justify-center space-y-8 sm:space-y-5 lg:space-y-8 xl:space-y-5 xl:px-5">
        <img v-show="getData.image" :src="getData.image" alt="">
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Title</label>
            <input type="text" class="w-4/5 border rounded" v-model="getData.title">
          </div>
        </div>
        <button class="border rounded bg-amber-500 p-2" type="submit">Upload</button>
      </form>
    </div>
  </div>
</template>

<script>
import API from "../../services";
import SlugWidget from "../../components/slugWidget";

export default {
  name: "Detail",
  components: {SlugWidget},
  data() {
    return {
      getData: null,
    }
  },
  props: {
    id: {
      type: String,
      required: true
    }
  },

  async created() {
    await API.get('/posts/' + this.id)
        .then(res => {
            this.getData = res.data
        })
        .catch(err => this.$router.push({name: 'error'}))
  }
}
</script>

<style scoped>

</style>