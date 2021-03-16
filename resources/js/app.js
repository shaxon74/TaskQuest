/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// モンスター表示コンポーネント
Vue.component('example-component',      require('./components/ExampleComponent.vue').default);
Vue.component('original-component',     require('./components/OriginalComponent.vue').default);
Vue.component('main-component',         require('./components/user/MainComponent.vue').default);
Vue.component('taskmonsters-component', require('./components/user/TaskMonstersComponent.vue').default);
Vue.component('monster-component',      require('./components/user/MonsterComponent.vue').default);
Vue.component('mymenu-component',       require('./components/user/MyMenuComponent.vue').default);
Vue.component('monstermenu-component',  require('./components/user/MonsterMenuComponent.vue').default);

// タスク管理コンポーネント
Vue.component('tasks-component',     require('./components/user/TasksComponent.vue').default);
Vue.component('edittasks-component', require('./components/user/EditTasksComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const appField = new Vue({
    el: '#app',
});
