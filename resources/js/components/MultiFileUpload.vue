<template>
  <div class="mt-10">
    <form @submit.prevent=""
          enctype="multipart/form-data"
          class="relative h-full flex flex-col justify-center space-y-8 sm:space-y-5 lg:space-y-8 xl:space-y-5 xl:px-5">
      <div
          class="flex justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
        <label for="" class="w-1/5">Upload</label>
        <input @change="handleImageSelected" type="file" class="w-4/5 border rounded" multiple>
      </div>
      <button class="border rounded bg-amber-500 p-2" type="submit">Upload</button>
      <div class="flex">
        <div class="image-preview" v-for="(image,index) in imageFiles">
          <div class="image">
            <img :src="image.data" :alt="image.name" :key="index">
          </div>
          <div class="image-details">
            <div class="image-size">
              <span>{{ image.size }}</span>
            </div>
            <div class="image-name">
              <span>{{ image.name }}</span>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  name: "MultiFileUpload",
  data() {
    return {
      imageFiles: []
    }
  },
  methods: {
    handleImageSelected(e) {
      for (let i = 0; i < e.target.files.length; i++) {
        const file = e.target.files[i];

        let reader = new FileReader();

        reader.addEventListener('load', () => {
          this.imageFiles.push({
            name: file.name,
            data: reader.result,
            type: file.type,
            size: file.size
          });
        }, {once: true});
        reader.readAsDataURL(file)
        console.log(this.imageFiles)
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.image-preview {
  position: relative;
  display: inline-block;
  vertical-align: top;
  margin: 16px;
  min-height: 100px;
  cursor: default;

  &:hover {
    .image-details {
      opacity: 1;
    }

    .image img {
      -webkit-transform: scale(1.05, 1.05);
      -moz-transform: scale(1.05, 1.05);
      -ms-transform: scale(1.05, 1.05);
      -o-transform: scale(1.05, 1.05);
      transform: scale(1.05, 1.05);
      -webkit-filter: blur(8px);
      filter: blur(8px);
    }
  }

  .image {
    border-radius: 20px;
    overflow: hidden;
    width: 120px;
    height: 120px;
    position: relative;
    display: block;
    z-index: 10;

    img {
      display: block;
      height: 100%;
      width: 100%;
      object-fit: cover;
    }
  }

  .image-details {
    z-index: 20;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    font-size: 13px;
    min-width: 100%;
    max-width: 100%;
    padding: 2em 1em;
    text-align: center;
    color: rgba(0, 0, 0, 0.9);
    line-height: 150%;

    .image-size {
      margin-bottom: 1em;
      font-size: 16px;
    }

    .image-name:not(:hover) {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;

      span {

        border: 1px solid transparent;
      }
    }

    .image-size span, .image-name span {
      background-color: rgba(255, 255, 255, 0.4);
      padding: 0 0.4em;
      border-radius: 3px;
      white-space: nowrap;
    }
  }
}
</style>
