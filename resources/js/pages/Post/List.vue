<template>
  <div class="flex flex-col">
    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>TİTLE</th>
        <th>SLUG</th>
        <th>LANGUAGE</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(post,index) in getData" :key="index" @dblclick="dbleclick(post)">
        <td>{{ post.id }}</td>
        <td>{{ post.title }}</td>
        <td>{{ post.slug }}</td>
        <td>{{ post.language }}</td>
      </tr>
      </tbody>
    </table>
    <br>
    <router-link :to="{name:'newpost'}">
      Kategori Ekle
    </router-link>

    <router-view/>
  </div>
</template>

<script>
import API from "../../services";

export default {
  name: "List",
  data() {
    return {
      getData: [],
    }
  },
  methods: {
    dbleclick(data) {
      this.$router.push({name: 'postdetail', params: {id: data.id}})
    }
  },
  async created() {
    await API.get('/posts')
        .then(res => {
          this.getData = res.data
        })
  }
}
</script>

<style scoped>

</style>