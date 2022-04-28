<template>
    <div class="bg-slate-50 flex overflow-hidden h-[28rem]">
        <div
            class="relative bg-white/40 w-64 sm:w-[36rem] lg:w-64 xl:w-[36rem] mx-auto border border-slate-100">
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
                        <label for="" class="w-1/5">Name</label>
                        <input type="text" class="w-4/5 border rounded" v-model="name">
                    </div>
                    <div class="flex flex-row slug-widget items-center">
                        <div class="icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="url-wrapper">
                            <span class="rout-url">{{ url }}</span>
                            <span class="subdirectoy-url">{{ subdirectory }}</span>
                            <span class="slug" v-show="slug && !isEditing">{{ slug }}</span>
                            <input class="border" type="text" v-show="isEditing"/>
                        </div>
                        <div class="button ml-2">
                            <button class="border px-2" v-show="!isEditing" @click.prevent="editSlug">Edit</button>
                            <button class="border px-2" v-show="isEditing" @click.prevent="saveSlug">Save</button>
                        </div>
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
import axios from "axios";

export default {
    name: "FileUpload",
    data() {
        return {
            name: '',
            url: 'http://localhost:8080',
            subdirectory: '/category/',
            slug: '',
            isEditing: false,
            imageUrl: '',
            imageFile: '',
            error: []
        }
    },
    methods: {
        editSlug() {
            this.isEditing = true
        },
        saveSlug() {
            this.isEditing = false
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
            form.append('name', this.name)
            form.append('slug', this.slug)
            form.append('image', this.imageFile)
            await axios.post('/post', form, config)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    this.error = error.response.data.errors;
                })
        }
    }
}
</script>

<style scoped>

</style>
