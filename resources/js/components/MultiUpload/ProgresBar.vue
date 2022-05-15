<template>
  <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" :style="{width:getProgress}">
      {{ progress < 100 ? getProgress : 'Upload Complete!' }}
    </div>
  </div>
</template>

<script>
export default {
  name: "ProgresBar",
  props: {
    progress: {
      type: Number,
      default: 0,
    }
  },
  computed: {
    getProgress() {
      return Math.round(this.progress) + '%'
    }
  }
}
</script>

<style scoped>

</style>