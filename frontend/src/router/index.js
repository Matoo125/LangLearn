import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import Learn from '@/components/Learn'
import List from '@/components/List'
import Add from '@/components/Add'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Index
    },
    {
      path: '/learn',
      name: 'Learn',
      component: Learn
    },
    {
      path: '/list',
      name: 'List',
      component: List
    },
    {
      path: '/add',
      name: 'Add',
      component: Add
    }
  ]
})
