<template>
  <div class="flex flex-row slug-widget items-center">
    <div class="icon-wrapper">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
           fill="currentColor">
        <path fill-rule="evenodd"
              d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
              clip-rule="evenodd"/>
      </svg>
    </div>
    <div class="url-wrapper">
      <span class="rout-url">{{ domainUrl }}</span>
      <span class="subdirectoy-url" v-if="subdirectory">{{ subdirectory }}/</span>
      <span class="slug" v-show="slug && !isEditing">{{ slug }}</span>
      <input class="border" type="text" v-show="isEditing" v-model="customSlug"/>
    </div>
    <div class="button ml-2">
      <button class="border px-2" v-show="!isEditing" @click.prevent="editSlug" :disabled="disabled">Edit</button>
      <button class="border px-2" v-show="isEditing" @click.prevent="saveSlug">Save</button>
      <button class="border px-2" v-show="isEditing" @click.prevent="resetEditing">Reset</button>
    </div>
  </div>
</template>

<script>
import Slug from "slug";

Slug.defaults.mode = 'rfc3986'
export default {
  name: "slugWidget",
  props: {
    subdirectory: {
      type: String,
      required: false
    },
    title: {
      type: String,
      required: false
    },
    disabled: {
      type: Boolean
    }
  },
  data: function () {
    return {
      domainUrl: process.env.MIX_APP_URL,
      slug: this.convertTitle(),
      isEditing: false,
      customSlug: '',
      wasEdited: false
    }
  },
  methods: {
    convertTitle: function () {
      return Slug(this.title)
    },
    editSlug: function () {
      this.customSlug = this.slug;
      this.$emit('edit', this.slug);
      this.isEditing = true;
    },
    saveSlug: function () {
      if (this.customSlug !== this.slug) this.wasEdited = true;
      this.slug = Slug(this.customSlug);
      this.$emit('save', this.slug);
      this.isEditing = false;
    },
    resetEditing: function () {
      this.slug = this.convertTitle();
      this.$emit('reset', this.slug);
      this.wasEdited = false;
      this.isEditing = false;
    },
  },
  watch: {
    title: function () {
      if (this.wasEdited === false) this.slug = this.convertTitle()
    },
    slug: function () {
      this.$emit('slug-changed', this.slug)
    }
  }
}
</script>

<style scoped>

</style>
