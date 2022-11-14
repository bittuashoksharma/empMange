<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0">Bank Account Details</h1> -->
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
                <progressbar-component ref="progressbarRef" :setup="4" :step_completed="step_completed"></progressbar-component>
            </div>
            <div class="col-md-6">
        		<div class="form-container">
              <div class="card-header">
                <h2 class="card-title title_decoration">Bank Account Details</h2>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="account_holder_name" class="col-sm-4 col-form-label col-form-label-sm">Account Holder Name*</label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.account_holder_name" class="form-control form-control-sm" id="account_holder_name" placeholder="Enter Account Holder Name" />
                    <div v-if="errors.account_holder_name" class="text-danger">{{ errors.account_holder_name[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="account_number" class="col-sm-4 col-form-label col-form-label-sm">Account Number*</label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.account_number" class="form-control form-control-sm" id="account_number" placeholder="Enter Account Number"  />
                    <div v-if="errors.account_number" class="text-danger">{{ errors.account_number[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bank_name" class="col-sm-4 col-form-label col-form-label-sm">Bank Name*</label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.bank_name" class="form-control form-control-sm" id="bank_name" placeholder="Enter Bank Name"  />
                    <div v-if="errors.bank_name" class="text-danger">{{ errors.bank_name[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="branch" class="col-sm-4 col-form-label col-form-label-sm">Branch*</label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.branch" class="form-control form-control-sm" id="branch" placeholder="Enter Branch"  />
                    <div v-if="errors.branch" class="text-danger">{{ errors.branch[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="ifsc_code" class="col-sm-4 col-form-label col-form-label-sm">IFSC Code*</label>
                  <div class="col-sm-8">
                    <input type="text" v-model="form.ifsc_code" class="form-control form-control-sm" id="ifsc_code" placeholder="Enter Bank Name"  />
                    <div v-if="errors.ifsc_code" class="text-danger">{{ errors.ifsc_code[0] }}</div>
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
              <button type="submit" @click="addEmployeeBankAccountDetail" class="btn btn-primary float-sm-right mr-10">Submit & Continue</button>
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
	import { useToastr } from '../../toastr.js';
	const errors = ref('');
	const toastr = useToastr();
  const step_completed = ref('');
	const form = reactive({
				user_id: localStorage.getItem('emp_id'),
				account_holder_name: '',
        account_number: '',
        bank_name: '',
        branch: '',
        ifsc_code: '',
        search_by_email: '',
        search_by_name: '',
	});
  const goPreviousStepForm = () => {
       window.location = '/employee/financial-detail';
  }
  const getFilledFormSetup = () => {
      let userId = localStorage.getItem('emp_id');
      if((userId != '') && (userId != null)){
          axios.post('/api/get-filled-form-setup',{ 'userId':userId}).then((response) => {
              if(response.data.code == 'success'){
                 step_completed.value = response.data.step_completed;
              }
          }).catch((e) => {
                console.log(e);
                // Swal.fire('Failed!','Something went wrong.', 'warning');
          });
      }
  }
	const addEmployeeBankAccountDetail = () => {
    errors.value = '';
		axios.post('/api/add-employee-bank-account-detail',form).then((response) => {
          if(response.data.code == 'success'){
            Swal.fire({
                  title: 'Data Saved!',
                  text: "Employee Bank Account Detail has been saved!",
                  icon: 'success',
                  allowOutsideClick: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ok'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location = '/employee/documents-detail';
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

	onMounted (() => {
      getFilledFormSetup();
			toastr.info('Success');
	});

</script>
