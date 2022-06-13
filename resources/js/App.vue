<template>
  <header class="bg-white dark:bg-black">
    <ul class="flex flex-row gap-2 justify-center">
      <li>
        <router-link to="/rulet">Rulet</router-link>
      </li>
      <li>
        <router-link to="/">Home</router-link>
      </li>
      <li>
        <router-link to="/categoies">Categori</router-link>
      </li>
      <li>
        <router-link to="/post">Post</router-link>
      </li>
      <li>
        <router-link to="/contact">Contactm</router-link>
      </li>
      <li>
        <router-link to="/contactform">Contact Form</router-link>
      </li>
      <dark-mode/>
    </ul>
  </header>
  <div class="flex flex-row justify-center items-center mx-auto w-full">
    <router-view/>
    <!--<router-view v-slot="{ Component, route }">
      <transition name="route" mode="out-in">
        <component :is="Component" :key="route.path"/>
      </transition>
    </router-view>-->
  </div>
  <footer class="flex flex-row justify-center">
    <div class="widget">
      <div class="widget-title">
        <h1>KURUMSAL</h1>
      </div>
      <ul>
        <li>
          <a href="">Vission</a>
        </li>
        <li>
          <a href="">Mission</a>
        </li>
      </ul>

    </div>
  </footer>
</template>

<script>
import DarkMode from "./components/DarkMode";

export default {
  name: "App",
  components: {DarkMode}
}
</script>

<style lang="scss">
.route-enter-from,
.route-leave-to {
  opacity: 0;
  transform: translateY(-30px);
}

.route-enter-active,
.route-leave-active {
  transition: all 0.3s ease;
}

.route-enter-to,
.route-leave-from {
  transform: translateY(0);
}

.widget {
  .widget-title {
    h1 {
      position: relative;
      padding-left: 10px;

      &:before {
        position: absolute;
        content: '';
        background: #ffd60b;
        width: 3px;
        height: 100%;
        left: 0;
        top: 2px;
      }

      &:after {
        position: absolute;
        content: '';
        background: #151515;
        width: 3px;
        height: 3px;
        left: 0;
        top: 0;
        right: 0;
        -webkit-animation: translate-one 10s infinite cubic-bezier(0, 0, .46, .26);
        animation: translate-one 10s infinite cubic-bezier(0, 0, .46, .26);
      }
    }
  }

  ul {
    li {
      position: relative;
      -webkit-transition: .5s;
      transition: .5s;

      &:hover {
        padding-left: 15px;

        &:before {
          width: 10px;
        }
      }

      &:before {
        position: absolute;
        content: '';
        width: 0;
        height: 2px;
        top: 12px;
        left: 0;
        background: #ffd60b;
        -webkit-transition: .5s;
        transition: .5s;
      }
    }
  }
}

@-webkit-keyframes translate-one {
  0% {
    -webkit-transform: translateY(0);
    transform: translateY(0)
  }

  50% {
    -webkit-transform: translateY(35px);
    transform: translateY(35px)
  }

  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0)
  }
}

@keyframes translate-one {
  0% {
    -webkit-transform: translateY(0);
    transform: translateY(0)
  }

  50% {
    -webkit-transform: translateY(35px);
    transform: translateY(35px)
  }

  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0)
  }
}

</style>