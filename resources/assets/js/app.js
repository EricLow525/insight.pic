
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * We will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
import VueRouter  from 'vue-router'
import router     from './router'
import Vue        from 'vue'
import Home from './components/Home.vue'
import Room from './components/Room.vue'
import Login from './components/Login.vue'
import About from './components/About.vue'
import Dashboard from './components/Dashboard.vue'
Vue.use(VueRouter)
// lazy load components
//const Room = (resolve) => require(['./components/Room.vue'], resolve)
//const Home = (resolve) => require(['./components/Home.vue'], resolve)
// Create and mount root instance.
// Make sure to inject the router.
// Route components will be rendered inside <router-view>.
new Vue({

  router,

  components : {
    Home,
    Login,
    About,
    Room,
    Dashboard
  },

  data : {

  }

}).$mount('#app')
