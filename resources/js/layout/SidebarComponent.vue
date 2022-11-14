<template>
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="/images/profile_img.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="javascript:void(0)" class="d-block" v-if="$store.getters.getUrid == 2">Admin</a>
      <a href="javascript:void(0)" class="d-block" v-else="$store.getters.getUrid == 3">Employee</a>
    </div>
  </div>
   <nav class="mt-2" v-if="$store.getters.getUrid == 2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       <li class="nav-item">
         <router-link to="/dashboard" active-class="active" class="nav-link">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p> Dashboard</p>
         </router-link>
       </li>  
       <li class="nav-item">
         <router-link to="/employees" active-class="active" class="nav-link">
           <i class="nav-icon fas fa-users"></i>
           <p>Employee Management <i class="right fas fa-angle-left"></i>
           </p>
         </router-link>
         <ul class="nav nav-treeview">
          <li class="nav-item">
             <router-link to="/employees" active-class="active" class="nav-link">
               <i class="far fa-user nav-icon"></i>
               <p>Manage Employees</p>
             </router-link>
           </li>
           <li class="nav-item">
             <router-link to="/employee/personal-detail" active-class="active" class="nav-link" id="addEmp">
               <i class="far fa-user nav-icon"></i>
               <p>Add Employee</p>
             </router-link>
           </li>
         </ul>
       </li>
       <li class="nav-item">
         <router-link to="/setting/offer-letter" active-class="active" class="nav-link">
           <i class="nav-icon fas fa-gear"></i>
           <p>Setting <i class="right fas fa-angle-left"></i>
           </p>
         </router-link>
         <ul class="nav nav-treeview">
          <li class="nav-item">
             <router-link to="/setting/offer-letter" active-class="active" class="nav-link">
               <i class="far fa-user nav-icon"></i>
               <p>Offer Letter</p>
             </router-link>
           </li>
          </ul>
       </li>
       <li class="nav-item">
         <router-link to="/permission-listing" active-class="active" class="nav-link">
           <i class="fas fa-pen-alt nav-icon"></i>
           <p> Permission </p>
         </router-link>
       </li>
       <li class="nav-item">
         <router-link to="/role-listing" active-class="active" class="nav-link">
           <i class="fas fa-user-circle nav-icon"></i>
           <p> Roles </p>
         </router-link>
       </li>
       <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link" @click="logout">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul> 
   </nav>
   <nav class="mt-2" v-else="$store.getters.getUrid == 3">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       <li class="nav-item">
         <router-link to="/emp/dashboard" active-class="active" class="nav-link">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p> Dashboard</p>
         </router-link>
       </li>
       <li class="nav-item">
         <router-link :to="{ name: 'emp_profile'}" active-class="active" class="nav-link">
           <i class="fas fa-pen-alt nav-icon"></i>
           <p> Profile Detail </p>
         </router-link>
       </li>
       <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link" @click="logout">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul> 
   </nav>
</template>
<script>
  import { useRouter } from 'vue-router'
  import { useStore } from 'vuex'

   export default{
    setup(){
      const router = useRouter()
      const store = useStore()

      function logout(){
        store.dispatch('removeToken');
        router.push({name : 'login'})
      }
      return {
        logout
      }
    }
   }

</script>