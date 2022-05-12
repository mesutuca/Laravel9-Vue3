<template>
  <TransitionGroup tag="ul" name="fade" class="container">
    <li v-for="(item,index) in files" class="card" :key="item">
      <figure class="card-figure">
        <img :src="item.data" :alt="item.name" class="card-image w-10 h-10">
        <figcaption class="card-caption">{{ getFileSize(item.size) }}</figcaption>
      </figure>
      <div class="card-body">
        <h4 class="title">{{ item.name }}</h4>
        <div class="between:flex secondary:text">
          <div>Last modified: boş</div>
          <div>File type: {{ item.type }}</div>
        </div>
        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
          <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
               :style="{width:progressBar(index)}"> {{ progressBar(index) }}
          </div>
        </div>
      </div>
    </li>
  </TransitionGroup>
</template>
<script>
import {getFileSize} from '../../utilities/file'

export default {
  name: 'ImageList',
  props: ['items', 'progress'],
  setup() {
    return {
      getFileSize
    }
  },
  computed: {
    files() {
      return items.reverse()
    }
  }
}
</script>
<!--
<script setup>
import {getFileSize} from '../../utilities/file'

const props = defineProps({
  items: Object,
  progress: String
})

function progressBar(index) {
  return props.progress[index] + '%'
}
</script>
-->
<style scoped lang="scss">
.card {
  position: relative;
  display: flex;
  min-width: 0;
  overflow-wrap: break-word;
  background-color: rgba(255, 255, 255, var(--opacity, 1));
  background-clip: padding-box;
  box-shadow: rgba(0, 0, 0, 0.15) 0 2px 8px;
  backdrop-filter: var(--filter, blur(10px));
  -webkit-backdrop-filter: var(--filter, blur(10px));
  border: 1px solid var(--alga-border-color, rgba(0, 0, 0, .125));

  &-image {
    width: 100%;
  }

  &-figure {
    position: relative;
    width: 100%;
    margin: 0;
  }

  &-figure &-caption {
    position: absolute;
    right: 10px;
    bottom: 10px;
    z-index: 1001;
    border-radius: .25rem;
    padding: .5rem;
    background: #333;
    color: #fff;
  }

  &-content {
    display: flex;
    flex-direction: column;
  }

  &-header {
    padding: 0.5rem 1rem;
    margin-bottom: 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
  }

  &-body {
    flex: 1 1 auto;
    padding: 1rem 1rem;
  }

  &-footer {
    padding: 0.5rem 1rem;
    border-top: 1px solid rgba(0, 0, 0, 0.125);
  }

  &-title {
    margin-top: 0;
    margin-bottom: 0.5rem;
  }

  &-subtitle {
    margin-top: -0.25rem;
    margin-bottom: 0;
  }

  &-text {
    margin-bottom: 0;
  }

  & > *:first-child {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
  }

  & > *:last-child {
    border-bottom-right-radius: inherit;
    border-bottom-left-radius: inherit;
  }
}


.container {
  position: relative;
  padding: 0;
}

.item {
  width: 100%;
  height: 30px;
  background-color: #f3f3f3;
  border: 1px solid #666;
  box-sizing: border-box;
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