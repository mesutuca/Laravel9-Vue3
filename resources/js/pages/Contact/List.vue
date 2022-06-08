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
        <td>
          <div class="flex items-center justify-center w-full">
            <div class="form-check form-switch">
              <input v-model="item.status" false-value="off" true-value="on"
                     class="form-check-input appearance-none w-9 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
                     type="checkbox" role="switch"
                     @change="statusChange(item)">
            </div>
          </div>
        </td>
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
    statusChange(item) {
      API.put('/contacts' + '/' + item.id, item)
    },
  },
  created() {
    API.get('/contacts')
        .then(response => {
          this.getData = response.data
        })
        .catch(error => {
          console.log(error)
        })
  }
}
</script>

<style scoped lang="scss">
.form-check-input {
  background-image: url("data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%22-4 -4 8 8%22%3E%3Ccircle r=%223%22 fill=%22%23fff%22/%3E%3C/svg%3E");
  background-position: 0;
  transition: background-position .15s ease-in-out;

  &:checked {
    background-position: 100%;
    background-color: #0d6efd;
    border-color: #0d6efd;
  }
}
</style>