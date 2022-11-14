<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0">Personal Details</h1> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <router-link to="/dashboard">Dashboard</router-link>
            </li>
            <li class="breadcrumb-item active">Employee</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <form action="javascript:void(0)" class="form newtopic" @submit.prevent="submit">
      <div class="card card-primary">
          <div class="row">
            <div class="progress-panel col-md-12">
                <progressbar-component ref="progressbarRef" :setup="1" :step_completed="step_completed" :empID = "passEmpID"></progressbar-component>
            </div>
          	<div class="col-md-6">
            	<div class="form-container">
              <div class="card-header">
                <h2 class="card-title title_decoration">Personal Details</h2>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="name" class="col-sm-4 col-form-label col-form-label-sm">Name<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.name" class="form-control form-control-sm" id="name" placeholder="Enter Full Name"  />
                    <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="father_name" class="col-sm-4 col-form-label col-form-label-sm">Father Name</label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.father_name" class="form-control form-control-sm" id="father_name" placeholder="Enter Father Name"  />
                    <div v-if="errors.father_name" class="text-danger">{{ errors.father_name[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="dob" class="col-sm-4 col-form-label col-form-label-sm">Date of Birth</label>
                  <div class="col-sm-8">
                    <input type="date" v-model="form.dob" class="form-control form-control-sm" id="dob" placeholder="Enter Date of Birth"  />
                    <div v-if="errors.dob" class="text-danger">{{ errors.dob[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="gender" class="col-sm-4 col-form-label col-form-label-sm">Gender<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-8">
                    <select class="form-control form-control-sm select2" style="width: 100%;" v-model="form.gender" name="gender" id="gender" >
                      <option value="">Select Gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                    <div v-if="errors.gender" class="text-danger">{{ errors.gender[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pan_number" class="col-sm-4 col-form-label col-form-label-sm">PAN Number </label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.pan_number" name="pan_number" id="pan_number" class="form-control form-control-sm" placeholder="Enter PAN Number"  maxlength="10"/>
                    <div v-if="errors.pan_number" class="text-danger">{{ errors.pan_number[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="adhaar_number"  class="col-sm-4 col-form-label col-form-label-sm">Adhaar Number </label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.adhaar_number" name="adhaar_number" id="adhaar_number" class="form-control form-control-sm" placeholder="Enter Adhaar Number"  maxlength="12" />
                    <div v-if="errors.adhaar_number" class="text-danger">{{ errors.adhaar_number[0] }}</div>
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="esi_number"  class="col-sm-4 col-form-label col-form-label-sm">ESI Number </label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.esi_number" name="esi_number" id="esi_number" class="form-control form-control-sm" placeholder="Enter ESI Number"  maxlength="12" />
                    <div v-if="errors.esi_number" class="text-danger">{{ errors.esi_number[0] }}</div>
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="esi_number"  class="col-sm-4 col-form-label col-form-label-sm">PF Account </label>
                  <div class="col-sm-8">
                        <div class="custom-control custom-radio d-inline-flex">
                          <div class="p-3">
                            <input class="custom-control-input" type="radio" id="pf_yes" name="pf_account" checked="checked" v-model="form.pf_account" value="yes">
                            <label for="pf_yes" class="custom-control-label">Yes</label>
                            </div>
                            <div class="p-3">
                            <input class="custom-control-input" type="radio" id="pf_no" name="pf_account" v-model="form.pf_account" value="no">
                            <label for="pf_no" class="custom-control-label">No</label>
                          </div>
                        </div>
                        <div v-if="errors.pf_account" class="text-danger">{{ errors.pf_account[0] }}</div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="nationality" class="col-sm-4 col-form-label col-form-label-sm">Nationality</label>
                  <div class="col-sm-8">
                    <select class="form-control form-control-sm select2" v-model="form.nationality" name="nationality" id="nationality" style="width: 100%;" >
                      <option value="">Select Nationality</option>
                      <option value="indian">Indian</option>
                    </select>
                    <div v-if="errors.nationality" class="text-danger">{{ errors.nationality[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="maritial_status" class="col-sm-4 col-form-label col-form-label-sm">Maritial Status</label>
                  <div class="col-sm-8">
                    <select class="form-control form-control-sm select2" v-model="form.maritial_status" name="maritial_status" id="maritial_status" style="width: 100%;" >
                      <option value="">Select Maritial Status</option>
                      <option value="married">Married</option>
                      <option value="single">Single</option>
                    </select>
                    <div v-if="errors.nationality" class="text-danger">{{ errors.nationality[0] }}</div>
                  </div>
                </div>
                 <div class="form-group row">
                  <label for="photo" class="col-sm-4 col-form-label col-form-label-sm">Photo</label>
                  <div class="col-sm-8">
                   
                      <div class="custom-file">

                        <input type="file" class="form-control file-upload-input" name="photo" id="photo" v-on:change="onChangeProfilePicFile"/>
                        <label class="custom-file-label" id="photo_label" for="photo">Choose Photo</label>

                      </div>
                      
                    <div v-if="errors.photo" class="text-danger">{{ errors.photo[0] }}</div>

                     <img :src="profile_pic_src" id="img_preview" v-if="profile_pic_src" alt="photo" class="img-fluid image-preview">
                  </div>
                  
                </div> 
              </div>
              </div>
            </div>
            <div class="col-md-6">
            	<div class="form-container">
              <div class="card-header">
                <h2 class="card-title title_decoration">Contact Details</h2>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="contact_number_1" class="col-sm-4 col-form-label col-form-label-sm">Contact Number 1<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.contact_number_1" name="contact_number_1" id="contact_number_1" class="form-control form-control-sm" placeholder="Enter Contact Number 1"  maxlength="10"/>
                    <div v-if="errors.contact_number_1" class="text-danger">{{ errors.contact_number_1[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="contact_number_2"  class="col-sm-4 col-form-label col-form-label-sm">Contact Number 2</label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.contact_number_2" name="contact_number_2" id="contact_number_2" class="form-control form-control-sm" placeholder="Enter Contact Number 2"  maxlength="10" />
                    <div v-if="errors.contact_number_2" class="text-danger">{{ errors.contact_number_2[0] }}</div>
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="current_address" class="col-sm-4 col-form-label col-form-label-sm">Current Address</label>
                  <div class="col-sm-8">
                    <textarea class="form-control form-control-sm" v-model="form.current_address" name="current_address" id="current_address" placeholder="Enter Current Address" ></textarea>
                     <div v-if="errors.current_address" class="text-danger">{{ errors.current_address[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="permanent_address" class="col-sm-4 col-form-label col-form-label-sm">Permanent Address</label>
                  <div class="col-sm-8">
                    <textarea class="form-control form-control-sm" v-model="form.permanent_address" name="permanent_address" id="permanent_address" placeholder="Enter Permanent Address" ></textarea>
                    <div v-if="errors.permanent_address" class="text-danger">{{ errors.permanent_address[0] }}</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-container">
              <div class="card-header">
                <h2 class="card-title title_decoration">Account Login</h2>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="email" class="col-sm-4 col-form-label col-form-label-sm">Email<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-8">
                    <input type="email" v-model="form.email" name="email" id="email" class="form-control form-control-sm"  placeholder="Enter Email"  />
                    <div v-if="errors.email" class="text-danger">{{ errors.email[0] }}</div>
                  </div>
                </div>
                <!-- <div class="form-group row">
                  <label for="password" class="col-sm-4 col-form-label col-form-label-sm">Password<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-8">
                    <input type="password" v-model="form.password" name="password" id="password" class="form-control form-control-sm"  placeholder="Enter Password"  />
                    <div v-if="errors.password" class="text-danger">{{ errors.password[0] }}</div>
                  </div>
                </div> -->
              </div>
            </div>
            </div>
            <div class="card-footer col-md-12">
              <button type="submit" @click="addEmployeePersonalDetail" class="btn btn-primary float-sm-right mr-20">Next</button>
            </div>
          </div>
        
      </div>
      </form>
    </div>
  </div>
</template>
<script>
  import ProgressbarComponent from "@/components/admin/form_progress_bar.vue"
  export default {
    components: {
      ProgressbarComponent
    }
  };
</script>
<script setup>

  import { ref, onMounted , reactive} from 'vue';
  import Swal from 'sweetalert2'
  import { useRoute, useRouter } from 'vue-router'
  import { useToastr } from '../../toastr.js';
  
  

  const profile_pic_src = ref('');
  const step_completed = ref('');
  const errors = ref('');
  const toastr = useToastr();
  const route = useRoute()
  const router = useRouter()
  const employeeID = (route.params.id) ? atob(route.params.id) : ''
  const passEmpID = ref('');
  passEmpID.value  = btoa(employeeID);
  const form = reactive({
        user_id: employeeID,
        name: '',
        father_name: '',
        dob: '',
        gender: '', 
        contact_number_1: '',
        contact_number_2: '',
        current_address: '',
        permanent_address: '',
        nationality: '',
        maritial_status: '',
        email: '',
        //password: '',
        photo:'',
        pan_number:'',
        adhaar_number:'',
        esi_number:'',
        pf_account:'',
        is_photo:0,
  });
  const onChangeProfilePicFile = (e)=>{
    if(e.target.files[0].name != ''){
      form.photo = e.target.files[0];
      document.getElementById("photo_label").innerHTML = e.target.files[0].name;
    }else{
       document.getElementById("photo_label").innerHTML = 'Choose Photo';
    }
     
  }
  const addEmployeePersonalDetail = () => {
      let formData = new FormData();
      formData.append('user_id', form.user_id);
      formData.append('name', form.name);
      formData.append('father_name', form.father_name);
      formData.append('dob', form.dob);
      formData.append('gender', form.gender);
      formData.append('contact_number_1', form.contact_number_1);
      formData.append('contact_number_2', form.contact_number_2);
      formData.append('current_address', form.current_address);
      formData.append('permanent_address', form.permanent_address);
      formData.append('nationality', form.nationality);
      formData.append('maritial_status', form.maritial_status);
      formData.append('email', form.email);
      formData.append('photo', form.photo);
      formData.append('pan_number', form.pan_number);
      formData.append('adhaar_number', form.adhaar_number);
      formData.append('esi_number', form.esi_number);
      formData.append('pf_account', form.pf_account);
      formData.append('is_photo', form.is_photo);
	  	errors.value = '';
	    axios.post('/api/add-employee-personal-detail',formData).then((response) => {
	    		if(response.data.code == 'success'){
	    				//localStorage.setItem("emp_id", JSON.stringify(response.data.data.id));
              
              Swal.fire({
                  title: 'Data Saved!',
                  text: "Employee Personal Detail has been saved!",
                  icon: 'success',
                  allowOutsideClick: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ok'
                }).then((result) => {
                  if (result.isConfirmed) {
                    router.push({ name: 'company-detail', params: { id: btoa(response.data.data.id) } })
                  }
                })
          }else if(response.data.code == 'error_validate'){
                errors.value = response.data.errors;
          }else{
             console.log(response.data.message);
          }
	    		
	    }).catch((e) => {
	    			console.log(e);
            // Swal.fire('Failed!','Something went wrong.', 'warning');
	    });
  }

  const getEmployeePersonalDetail = () => {
      if((employeeID != '') && (employeeID != null)){
          axios.post('/api/get-employee-personal-detail',{ 'userId':employeeID}).then((response) => {
          if(response.data.code == 'success'){
             //form.reset();
             //form.clear();
             Object.assign(form, response.data.data);
             Object.assign(form, response.data.data.employee_personal_info);
             form.contact_number_2 = response.data.data.employee_personal_info.phone_number_2;
             form.contact_number_1 = response.data.data.phone_number;
             form.photo = response.data.data.employee_personal_info.photo;
             profile_pic_src.value = response.data.data.profile_pic_src;
             document.getElementById("photo_label").innerHTML = response.data.data.employee_personal_info.photo;
            if(response.data.data.profile_pic_src != ''){
              form.is_photo = 1;
            }
             
          }else{
             //console.log(response.data.message);
             Swal.fire('Failed!', response.data.message, 'warning');
          }
          
          }).catch((e) => {
              console.log(e);
              // Swal.fire('Failed!','Something went wrong.', 'warning');
          });
      }
      
  }

  const getFilledFormSetup = () => {
      if((employeeID != '') && (employeeID != null)){
          axios.post('/api/get-filled-form-setup',{ 'userId':employeeID}).then((response) => {
              if(response.data.code == 'success'){
                 step_completed.value = response.data.step_completed;
              }
          }).catch((e) => {
                console.log(e);
                // Swal.fire('Failed!','Something went wrong.', 'warning');
          });
      }
      
  }
  onMounted (() => {
      //localStorage.removeItem("emp_id");
      //localStorage.setItem("emp_id", 2);
      getFilledFormSetup();
      getEmployeePersonalDetail();
      
      toastr.info('Success');
  });

</script>
