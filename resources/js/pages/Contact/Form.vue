<template>
  <div class="bg-slate-50 flex overflow-hidden dark:bg-black">
    <div
        class="relative bg-white/40 w-64 sm:w-[43rem] lg:w-64 xl:w-[43rem] mx-auto border border-slate-100">
      <form @submit.prevent="handleSubmit"
            class="relative h-full flex flex-col justify-center space-y-8 sm:space-y-5 lg:space-y-8 xl:space-y-5 xl:px-5">
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Name</label>
            <input type="text" class="w-4/5 border rounded" v-model="name">
          </div>
        </div>
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Surname</label>
            <input type="text" class="w-4/5 border rounded" v-model="surname">
          </div>
        </div>
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Phone</label>
            <input type="text" class="w-4/5 border rounded" v-model="phone" min="10" max="10">
          </div>
        </div>
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Email</label>
            <input type="email" class="w-4/5 border rounded" v-model="email">
          </div>
        </div>
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Company</label>
            <input type="text" class="w-4/5 border rounded" v-model="company">
          </div>
        </div>
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Subject</label>
            <input type="text" class="w-4/5 border rounded" v-model="subject">
          </div>
        </div>
        <div
            class="flex flex-col justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
          <div class="flex flex-row w-full">
            <label for="" class="w-1/5">Addresss</label>
            <textarea class="w-4/5 border rounded resize-none" rows="3" v-model="message"/>
          </div>
        </div>
        <button class="border rounded bg-amber-500 p-2" type="submit">Save</button>
      </form>
    </div>
  </div>
</template>

<script>
import API from "../../services";

export default {
  name: "Form",
  data() {
    return {
      company: '',
      name: '',
      surname: '',
      phone: '',
      email: '',
      subject: '',
      message: '',
    }
  },
  methods: {
    async handleSubmit() {
      const data = {
        name: this.name,
        surname: this.surname,
        phone: this.phone,
        email: this.email,
        subject: this.subject,
        message: this.message,
      }
      API.post('/contactFoo', data).then(res => {
        console.log(res)
      }).catch(err => {
        console.log(err)
      })
    },
  }
}
</script>

<style scoped>

</style>