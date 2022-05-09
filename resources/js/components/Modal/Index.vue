<script>
export default {
  props: {
    show: Boolean
  }
}
</script>

<template>
  <Transition name="modal">
    <dialog v-if="show" class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">


          <div class="modal-header">
            <slot name="header">default headeraa</slot>
          </div>
          <div class="modal-body">
            <slot name="body">default body</slot>
          </div>
          <div class="modal-footer">
            <slot name="footer">
              default footer
              <button class="modal-default-button" @click="$emit('close')">OK
              </button>
            </slot>
          </div>


        </div>
      </div>
    </dialog>
  </Transition>
</template>

<style lang="scss">
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .32);
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  display: block;
  box-sizing: border-box;
  overflow: auto;
  outline: 0;
  min-height: inherit;
  max-height: inherit;
  width: 300px;
  margin: 0 auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 11px 15px -7px #0003, 0 24px 38px 3px #00000024, 0 9px 46px 8px #0000001f;;
  transition: all 0.3s ease;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter-from {
  opacity: 0;
}

.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>