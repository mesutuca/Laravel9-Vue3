<template>
  <div class="flex flex-col">
    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>TİTLE</th>
        <th>SLUG</th>
        <th>LANGUAGE</th>
        <th>STATUS</th>
        <th>ACTİON</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(post,index) in provideData.getData" :key="index" @dblclick="dbleclick(post)">
        <td>{{ index }}</td>
        <td>{{ post.title }}</td>
        <td>{{ post.slug }}</td>
        <td>{{ post.language }}</td>
        <td>
          <div class="flex items-center justify-center w-full">
            <div class="form-check form-switch">
              <input v-model="post.status" false-value="off" true-value="on"
                     class="form-check-input appearance-none w-9 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
                     type="checkbox" role="switch"
                     @change="statusChange(post)">
            </div>
          </div>
        </td>
        <td>
          <button class="px-6 py-2 rounded bg-amber-400 hover:bg-amber-500 text-amber-100"
                  @click="deleteCategory(index,post.id)">Sil
          </button>
          <router-link :to="{name:'postImage',params:{id:post.id}}"
                       class="px-6 py-2 rounded bg-amber-400 hover:bg-amber-500 text-amber-100">Resimler
          </router-link>
        </td>
      </tr>
      </tbody>
    </table>
    <br>
    <router-link :to="{name:'newpost'}">
      Post Ekle
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
      provideData: {
        getData: [],
      },
      show: false,
    }
  },
  provide() {
    return {
      provideData: this.provideData,
      addNewItem: this.addNewItem
    }
  },
  methods: {
    addNewItem(data) {
      this.provideData.getData.push({
        id: data.id, title: data.title,
        slug: data.slug, image: data.image,
        language: data.language, status: data.status,
        created_at: data.created_at, updated_at: data.updated_at
      })
      setTimeout(() => {
        this.$router.push({name: 'postdetail', params: {id: data.id}})
      }, 1000)
    },
    dbleclick(data) {
      this.$router.push({name: 'postdetail', params: {id: data.id}})
    },

    statusChange(file) {
      API.put('/posts' + '/' + file.id, file)
    },
    deleteCategory(index, id) {
      API.delete('/posts' + '/' + id)
          .then(res => {
            if (res.status === 200) {
              this.provideData.getData.splice(this.provideData.getData.indexOf(index), 1);
            }
          })
          .catch(err => {
            console.log(err)
          })
    },
  },
  async created() {
    await API.get('/posts')
        .then(res => {
          this.provideData.getData = res.data
        })
        .catch(err => {
          console.log(err)
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