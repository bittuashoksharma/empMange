<template>
   <div class="d-flex flex-column flex-root">
      <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
          <router-link to="/" class="mb-4">
          <img alt="Logo" src="/images/logo.png" />
          </router-link>
          <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <form @submit.prevent="forgetPasswordFormSubmit">
              <div class="text-center mb-10">
                <h1 class="text-dark mb-3">Forget Password</h1>
               
              </div>
              <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                <input type="email" class="form-control" placeholder="Email" v-model="forgetPasswordForm.email">
                <div class="text-danger">{{errors}}</div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                  <span class="indicator-label">Send Password Reset Link</span>
                </button>
                </div>
                <div class="d-flex flex-stack mb-2">
                  <router-link to="/login" class="link-primary fs-6 fw-bolder">Login</router-link>
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
      let forgetPasswordForm = reactive({
         email: ''
      });
      const errors = ref('');
      const forgetPasswordFormSubmit = async() =>{
         await axios.post('/api/forget-password', forgetPasswordForm).then(res=>{
            console.log(res)
            if(res.data.success){
              // store.dispatch('setToken', res.data.data.token)
              // router.push({name: 'dashboard'})
            }
         }) .catch(error => {
               errors.value = error.response.data.message;
              console.log(error)

            })
      }

      return {
         forgetPasswordForm,forgetPasswordFormSubmit,errors
      }
   }
  }
   
</script>