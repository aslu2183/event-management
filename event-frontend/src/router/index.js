import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import DashBoard from '../views/DashBoardView.vue'
import AddEvent from '../views/AddEventView.vue'
import ListEvents from '../views/ListEventView.vue'
import AddBooking from '../views/AddBookingView.vue'
import ListBooking from '../views/ListBookingView.vue'
import ReportView from '../views/EventReportView.vue'
import TicketView from '../views/TicketReportView.vue'

const routes = [
  {
    path: '/',
    name: 'login',
    component: LoginView,
    meta : { requiresAuth : false}
  },
  {
    path : '/login',
    redirect : '/',
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component:DashBoard,
    meta : { requiresAuth : true}
  },
  {
    path      : '/events/add',
    name      : "add-event",
    component : AddEvent,
    meta      : { requiresAuth : true} 
  },
  {
    path      : '/events/list',
    name      : 'list-events',
    component : ListEvents,
    meta      : { requiresAuth : true}

  },
  {
    path      : '/booking/add',
    name      : 'new-booking',
    component : AddBooking,
    meta      : { requiresAuth : true}

  },
  {
    path      : '/booking/lists',
    name      : 'list-booking',
    component : ListBooking,
    meta      : { requiresAuth : true}

  },
  {
    path      : '/report/events',
    name      : 'sales-report',
    component : ReportView,
    meta      : { requiresAuth : true }
  },
  {
    path      : '/report/tickets',
    name      : 'sales-ticket-report',
    component : TicketView,
    meta      : { requiresAuth : true }
  }        

    
 
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

function isLoggedIn(){
  return localStorage.getItem("token")
}

//For redirecting routes by checking user logged in or not
router.beforeEach((to, from ,next) => {
  if (to.meta.requiresAuth) {
    if(!isLoggedIn()){
      next({
        path : '/',
        query: { redirect : to.fullPath}
      })
    }
    else{
      next();
    }  
  }
  else if(!to.meta.requiresAuth){
    if(isLoggedIn()){
      next({
        path : '/dashboard',
        query: { redirect : to.fullPath}
      });
    }
    else{
      next();
    }  
  }
  else{
    next();
  }
})

export default router
