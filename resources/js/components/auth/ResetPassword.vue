<template>
   <div class="d-flex flex-column flex-root">
      <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
          <router-link to="/" class="mb-4">
          <img alt="Logo" src="/images/logo.png" />
          </router-link>
          <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <form @submit.prevent="resetPasswordFormSubmit">
              <div class="text-center mb-10">
                <h1 class="text-dark mb-3">Reset Password</h1>
               
              </div>
              <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                <input type="email" class="form-control" placeholder="Email" v-model="resetPasswordForm.email">
                <div v-if="errors.email" class="text-danger">{{ errors.email[0] }}</div>
              </div>
              <div class="fv-row mb-10">
                <div class="d-flex flex-stack mb-2">
                  <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                </div>
                <input type="password" class="form-control" placeholder="Password" v-model="resetPasswordForm.password">
                <div v-if="errors.password" class="text-danger">{{ errors.password[0] }}</div>
              </div>
              <div class="fv-row mb-10">
                <div class="d-flex flex-stack mb-2">
                  <label class="form-label fw-bolder text-dark fs-6 mb-0">Confirm Password</label>
                </div>
                <input type="password" class="form-control" placeholder="Confirm Password" v-model="resetPasswordForm.password_confirmation">
                <div v-if="errors.password" class="text-danger">{{ errors.password_confirmation[0] }}</div>
              </div>
              <div class="text-danger">{{errors}}</div>
              <div class="row">
                <div class="col-lg-12">
                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                  <span class="indicator-label">Reset Password</span>
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
import { useRoute, useRouter } from 'vue-router'
import Swal from 'sweetalert2'
  export default{
   setup(){
      const route = useRoute()
      const router = useRouter()
      console.log(route);
      let resetPasswordForm = reactive({
         email: '',
         password: '',
         password_confirmation: '',
         token: route.params.token
      });
      const errors = ref('');
      const resetPasswordFormSubmit = async() =>{
         await axios.post('/api/reset-password', resetPasswordForm).then(res=>{
            console.log(res)
            if(res.data.success){
              Swal.fire({
                  title: 'Password Reset!',
                  text: res.data.message,
                  icon: 'success',
                  allowOutsideClick: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ok'
                }).then((result) => {
                  if (result.isConfirmed) {
                    router.push({name: 'login'})
                  }
                })
            }
         }) .catch(error => {
               errors.value = error.response.data.message;
              console.log(error)

            })
      }

      return {
         resetPasswordForm,resetPasswordFormSubmit,errors
      }
   }
  }
   
</script>