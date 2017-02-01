import VueRouter    from 'vue-router'
import Home from './components/Home.vue'
import Room from './components/Room.vue'
import Login from './components/Login.vue'
import About from './components/About.vue'
import Dashboard from './components/Dashboard.vue'
//Define route components
//const Home = { template: `<div>Home</div>` }
//const About = { template: `<div>About</div>` }

// lazy load components
// const Room = (resolve) => require(['./components/Room.vue'], resolve)

export default new VueRouter({
    mode: 'history',
    base: __dirname,
      routes: [
        { path: '/', component: Home },
        { path: '/login', component: Login },
        { path: '/abouts', component: About },
        { path: '/dashboard', component: Dashboard },
        { path: '/rooms', component: Room } // example of route with a seperate component
      ]
});
