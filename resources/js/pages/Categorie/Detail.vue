<template>
  {{ id }}
</template>

<script>
import API from "../../services";

export default {
  name: "Detail",
  props: ['id'],
  async created() {
    await API.get('/categories/' + this.id)
        .then(res => {
          this.getData = res.data
        })
        .catch(err => this.$router.push({name: 'error'}))
  }
}
</script>

<style scoped>

</style>