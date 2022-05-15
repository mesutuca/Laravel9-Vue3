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
      <td>nnn</td>
    </tr>
    </tbody>
  </table>
</template>

<script>
import API from "../services";

export default {
  name: "Post",
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