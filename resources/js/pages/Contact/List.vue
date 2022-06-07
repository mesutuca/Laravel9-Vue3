<template>
  <div class="flex flex-col">
    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>TİTLE</th>
        <th>ADDRESS</th>
        <th>STATUS</th>
        <th>ACTİON</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(item,index) in getData" :key="index" @dblclick="dbleclick(item)">
        <td>{{ index++ }}</td>
        <td>{{ item.title }}</td>
        <td>{{ item.address }}</td>
        <td>{{ item.status }}</td>
        <td>{{ item.id }}</td>
      </tr>
      </tbody>
    </table>
    <br>
    <router-link :to="{name:'newcontact'}">
      Contact Ekle
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
      this.$router.push({name: 'contactdetail', params: {id: data.id}})
    },
  },
  created() {
    API.get('/contact')
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