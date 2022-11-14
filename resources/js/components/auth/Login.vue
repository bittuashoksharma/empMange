<template>
   <div class="d-flex flex-column flex-root">
      <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
          <router-link to="/" class="mb-4">
          <img alt="Logo" src="images/logo.png" />
          </router-link>
          <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <form @submit.prevent="loginFormSubmit">
              <div class="text-center mb-10">
                <h1 class="text-dark mb-3">Sign In to HR Saarthi</h1>
               
              </div>
              <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                <input type="email" class="form-control" placeholder="Email" v-model="loginForm.email">
                <div v-if="errors.email" class="text-danger">{{ errors.email[0] }}</div>
              </div>
              <div class="fv-row mb-10">
                <div class="d-flex flex-stack mb-2">
                  <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                </div>
                <input type="password" class="form-control" placeholder="Password" v-model="loginForm.password">
                <div v-if="errors.password" class="text-danger">{{ errors.password[0] }}</div>
              </div>
              <div class="fv-row mb-10">
                <div class="d-flex flex-stack mb-2">
                  <router-link to="/forget-password" class="link-primary fs-6 fw-bolder">Forgot Password ?</router-link>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                  <span class="indicator-label">Login</span>
                </button>
                </div>
              
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
import { ref, onMounted , reactive} from 'vue';
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'
  export default{
   setup(){
      const router = useRouter()
      const store = useStore()
      let loginForm = reactive({
         email: '',
         password: ''
      });
      const errors = ref('');
      const loginFormSubmit = async() =>{
         errors.value = '';
         await axios.post('/api/login', loginForm).then(res=>{
            console.log(res)
            console.log(res.data.data.user.role_id )
            if(res.data.success){
              store.dispatch('setToken', res.data.data.token)
              store.dispatch('setUserRole', res.data.data.user.role_id)
              if(res.data.data.user.role_id == 2){
                router.push({name: 'dashboard'})
              }else{
                 router.push({name: 'emp_dashboard'})
              }
            }
         }) .catch(error => {
               errors.value = (error.response) ? error.response.data.errors : '';
              console.log(error)

            })
      }

      return {
         loginForm,loginFormSubmit,errors
      }
   }
  }
   
</script>