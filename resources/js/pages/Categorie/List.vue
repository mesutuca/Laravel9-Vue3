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
      <tr v-for="(categori,index) in getData" :key="index" @dblclick="dbleclick(categori)">
        <td>{{ categori.id }}</td>
        <td>{{ categori.title }}</td>
        <td>{{ categori.slug }}</td>
        <td>{{ categori.language }}</td>
      </tr>
      </tbody>
    </table>
    <br>
    <router-link :to="{name:'newcategori'}">
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
      getData: null,
      show: false,
    }
  },
  methods: {
    showpage() {
      this.show = !this.show
    },
    dbleclick(data) {
      this.$router.push({name: 'categoridetail', params: {id: data.id}})
      this.$root.$emit('setMessageTags', data)
    }
  },
  async created() {
    await API.get('/categories')
        .then(res => {
          this.getData = res.data
        })
        .catch(err => {
          console.log(err)
        })
  }
}
</script>

<style scoped>

</style>