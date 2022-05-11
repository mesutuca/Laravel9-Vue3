<template>
  <div class="mt-10">
    <form @submit.prevent=""
          enctype="multipart/form-data"
          class="relative h-full flex flex-col justify-center space-y-8 sm:space-y-5 lg:space-y-8 xl:space-y-5 xl:px-5">
      <div
          class="flex justify-between items-center sm:bg-white sm:rounded-lg sm:ring-1 sm:ring-slate-700/5 sm:shadow sm:p-3 lg:bg-transparent lg:rounded-none lg:ring-0 lg:shadow-none lg:p-0 xl:bg-white xl:rounded-lg xl:ring-1 xl:ring-slate-700/5 xl:shadow xl:p-3">
        <label for="" class="w-1/5">Upload</label>
        <input @change="handleImageSelected" type="file" accept="image/*" class="w-4/5 border rounded" multiple>
      </div>
      <button class="border rounded bg-amber-500 p-2" type="submit">Upload</button>

      <section class="relative py-16 bg-blueGray-50">
        <div class="w-full mb-12 px-4">
          <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-pink-900 text-white">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
              <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1 ">
                  <h3 class="font-semibold text-lg text-white">İmage Upload</h3>
                </div>
              </div>
            </div>
            <div class="block w-full overflow-x-auto ">
              <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                <tr>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">#</th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">İmage</th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Budget</th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Completion</th>
                </tr>
                </thead>

                <tbody>
                <TransitionGroup tag="ul" name="fade" class="container">
                  <tr v-for="(image,index) in imageFiles" :key="index">
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ index }}</td>
                    <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                      <img :src="image.data" class="h-12 w-12 bg-white rounded-full border" :alt="image.name">
                      <span class="ml-3 font-bold text-white">{{ image.name }}</span>
                    </th>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ image.size }}</td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                      <div class="flex items-center">
                        <span class="mr-2">60%</span>
                        <div class="relative w-full">
                          <div class="overflow-hidden h-2 text-xs flex rounded bg-red-200">
                            <div style="width: 100%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </TransitionGroup>
                </tbody>

              </table>
            </div>
          </div>
        </div>
      </section>
    </form>
  </div>
</template>
<script>
export default {
  name: "MultiFileUploadTable",
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

/* 1. declare transition */
.fade-move,
.fade-enter-active,
.fade-leave-active {
  transition: all 0.5s cubic-bezier(0.55, 0, 0.1, 1);
}

/* 2. declare enter from and leave to state */
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: scaleY(0.01) translate(30px, 0);
}

/* 3. ensure leaving items are taken out of layout flow so that moving
      animations can be calculated correctly. */
.fade-leave-active {
  position: absolute;
}
</style>
