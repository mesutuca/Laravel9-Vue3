<template>
  <table>
    <thead>
    <tr>
      <th>ID</th>
      <th>TİTLE</th>
      <th>SLUG</th>
      <th>ACTİON</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(post,index) in getPost" :key="index">
      <th>{{ post.id }}</th>
      <td>{{ post.title }}</td>
      <td>{{ post.slug }}</td>
      <td>
        <router-link :to="{name:'postdetail',params:{id:post.id}}"
                     class="px-6 py-2 rounded bg-amber-400 hover:bg-amber-500 text-amber-100">Resimler
        </router-link>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script>
import API from "../../services";

export default {
  name: "Posts",
  data() {
    return {
      getPost: [],
    }
  },
  async created() {
    await API.get('/posts')
        .then(res => {
          this.getPost = res.data
        })
  },
}
</script>

<style scoped>

</style>