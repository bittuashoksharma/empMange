<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0">Company Details</h1> -->
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
      <div class="card card-primary">
        	<div class="row">
            <div class="progress-panel col-md-12">
                <progressbar-component ref="progressbarRef" :setup="2" :step_completed="step_completed" :empID = "passEmpID"></progressbar-component>
            </div>
        		<div class="col-md-6">
            	<div class="form-container">
              <div class="card-header">
                <h2 class="card-title title_decoration">Company Details</h2>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="employee_id" class="col-sm-4 col-form-label col-form-label-sm">Employee ID<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.employee_id" class="form-control form-control-sm" id="employee_id" placeholder="Enter Employee ID"  />
                    <div v-if="errors.employee_id" class="text-danger">{{ errors.employee_id[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="department" class="col-sm-4 col-form-label col-form-label-sm">Department</label>
                  <div class="col-sm-8">
                    <select class="form-control form-control-sm select2" style="width: 100%;" v-model="form.department" name="department" id="department" >
                      <option value="">Select Department</option>
                      <option value="1">Accounts</option>
                      <option value="2">Exam Dept</option>
                    </select>
                    <div v-if="errors.department" class="text-danger">{{ errors.department[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="designation" class="col-sm-4 col-form-label col-form-label-sm">Designation</label>
                  <div class="col-sm-8">
                    <select class="form-control form-control-sm select2" style="width: 100%;" v-model="form.designation" name="designation" id="designation" >
                      <option value="">Select Designation</option>
                      <option value="1">Manager</option>
                      <option value="2">Supervisor</option>
                    </select>
                    <div v-if="errors.designation" class="text-danger">{{ errors.designation[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="doj" class="col-sm-4 col-form-label col-form-label-sm">Date of Joining<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-8">
                    <input type="date" v-model="form.doj" class="form-control form-control-sm" id="doj" placeholder="Enter Date of Joining"  />
                    <div v-if="errors.doj" class="text-danger">{{ errors.doj[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="dol" class="col-sm-4 col-form-label col-form-label-sm">Date of Leaving</label>
                  <div class="col-sm-8">
                    <input type="date" v-model="form.dol" class="form-control form-control-sm" id="dol" placeholder="Enter Date of Leaving"  />
                    <div v-if="errors.dol" class="text-danger">{{ errors.dol[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="status" class="col-sm-4 col-form-label col-form-label-sm">Status</label>
                  <div class="col-sm-8">
                    <select class="form-control form-control-sm select2" style="width: 100%;" v-model="form.status" name="status" id="status" >
                      <option value="">Select Status</option>
                      <option value="enable">Active</option>
                      <option value="disable">Inactive</option>
                    </select>
                    <div v-if="errors.status" class="text-danger">{{ errors.status[0] }}</div>
                  </div>
                </div>
               </div>
            </div>
            </div> 
            <div class="col-md-6">
              <div class="form-container">
              <div class="card-header">
                <h2 class="card-title title_decoration">Assign Manager</h2>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="search_by_email" class="col-sm-4 col-form-label col-form-label-sm">Search by Email</label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.search_by_email" name="search_by_email" id="search_by_email" class="form-control form-control-sm"  placeholder="Enter Search Email"  />
                    <div v-if="errors.search_by_email" class="text-danger">{{ errors.search_by_email[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="search_by_email" class="col-sm-4 col-form-label col-form-label-sm">Search by Name</label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.search_by_name" name="search_by_name" id="search_by_name" class="form-control form-control-sm"  placeholder="Enter Search Name"  />
                    <div v-if="errors.search_by_name" class="text-danger">{{ errors.search_by_name[0] }}</div>
                  </div>
                </div>
              </div>
            </div>
             </div>
            <div class="card-footer col-md-12 ">
              <button type="submit" @click="addEmployeeCompanyDetail" class="btn btn-primary float-sm-right mr-10">Submit & Continue</button>
              <button type="button" @click="goPreviousStepForm" class="btn btn-primary mr-20 float-right mr-10">Previous</button>
            </div> 
          </div>
        
      </div>
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
	const route = useRoute()
  const router = useRouter()
  const toastr = useToastr();
  const errors = ref('');
  const employeeID = atob(route.params.id);
  const step_completed = ref('');
  const passEmpID = ref('');
  passEmpID.value  = btoa(employeeID);
	const form = reactive({
        user_id: employeeID,
        assigned_manager: '',
        employee_id: 'EMP000'+ employeeID,
        department: '',
        designation: '',
        doj: '',
        dol: '',
        status: '',
        search_by_email: '',
        search_by_name: '',
	});
  const goPreviousStepForm = () => {
    router.push({ name: 'personal-detail', params: { id: route.params.id } })
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
	const addEmployeeCompanyDetail = () => {
    errors.value = '';
		axios.post('/api/add-employee-company-detail',form).then((response) => {
          if(response.data.code == 'success'){
            Swal.fire({
                  title: 'Data Saved!',
                  text: "Employee Company Detail has been saved!",
                  icon: 'success',
                  allowOutsideClick: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ok'
                }).then((result) => {
                  if (result.isConfirmed) {
                    router.push({ name: 'financial-detail', params: { id: route.params.id } })
                  }
                })
              
          }else if(response.data.code == 'error_validate'){
                errors.value = response.data.errors;
          }else{
             console.log(response.data.message);
             Swal.fire('Failed!', response.data.message, 'warning');
          }
    		  
		}).catch((e) => {
          console.log(e);
    });
	}

  const getEmployeeCompanyDetail = () => {
      if((employeeID != '') && (employeeID != null)){
          axios.post('/api/get-employee-company-detail',{ 'userId':employeeID}).then((response) => {
          if(response.data.code == 'success'){
             Object.assign(form, response.data.data);
             form.department = response.data.data.department_id;
             form.designation = response.data.data.designation_id;
             
             
          }else{
             Swal.fire('Failed!', response.data.message, 'warning');
          }
          
          }).catch((e) => {
              console.log(e);
              // Swal.fire('Failed!','Something went wrong.', 'warning');
          });
      }
      
  }

	onMounted (() => {
      getFilledFormSetup();
      getEmployeeCompanyDetail();
			toastr.info('Success');
	});

</script>
