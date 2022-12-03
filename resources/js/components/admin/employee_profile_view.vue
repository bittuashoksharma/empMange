<template><section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>View Details
          </h1>
        </div>

      </div>
    </div>
  </section>

  <!-- just for demo-->
  

  <section class="content">
    <div class="container-fluid">
      <div class="row editDetailForm">
        <div class="col-md-4">
          <div class="card custom-user-card card-widget widget-user">

            <div class="widget-user-header bg-primary">
              <h5 class="widget-user-desc"></h5>
            </div>
            <div class="widget-user-image">
              <div class="avatar-upload">
                <div class="avatar-edit">
                  <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" onchange="previewFile()" />
                  <label for="imageUpload"><i class="fas fa-pencil-alt"></i></label>
                </div>
                <div class="avatar-preview">
                  <img id="imagePreview" :src="profile_pic_src">

                </div>
              </div>
            </div>
            <div class="card-footer px-1 small">
              <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fas fa-phone-alt"></i></h5>
                    <span class="description-text">{{ emp_phone }}</span>
                  </div>

                </div>

                <div class="col-sm-6">
                  <div class="description-block">
                    <h5 class="description-header"><i class="far fa-envelope"></i></h5>
                    <span class="description-text text-lowercase">{{ emp_email }}</span>
                  </div>

                </div>



              </div>

            </div>
          </div>
          <div class="card p-0 d-block overflow-hidden">
            <ul class="nav nav-pills nav-fill flex-column small mb-0" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link rounded-0 active" id="personal-details-tab" data-toggle="tab"
                  data-target="#personal-details" href="#" role="tab" aria-controls="personal-details"
                  aria-selected="true">Personal Details</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link rounded-0" id="company-details-tab" data-toggle="tab"
                  data-target="#company-details" href="#" role="tab" aria-controls="company-details"
                  aria-selected="false">Company Details </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link rounded-0" id="financial-details-tab" data-toggle="tab"
                  data-target="#financial-details" href="#" role="tab" aria-controls="financial-details"
                  aria-selected="false">Financial Details </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link rounded-0" id="doc-details-tab" data-toggle="tab" data-target="#doc-details"
                  href="#" role="tab" aria-controls="doc-details" aria-selected="false"> Documents </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-7">

          <div class="tab-content pl-md-4" id="myTabContent">
            <div class="tab-pane fade show active" id="personal-details" role="tabpanel"
              aria-labelledby="personal-details-tab">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Personel Details</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" @click="editEmployeeDetailForm('personal_info')">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                  </div>

                </div>
                <div class="card-body">
                  <div class="p-d-form ">


                    <form action="javascript:void(0)" class="form newtopic" id="personal_tab_form" @submit.prevent="submit">
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Name*
                        </label>
                        <div class="col-sm-8">
                          <input type="text" v-model="personalForm.name" class="form-control form-control-sm personal_info_class" id="name" placeholder="Enter Full Name"  disabled/>
                          <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div> 
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Father
                          Name*
                        </label>
                        <div class="col-sm-8">
                          <input type="text" v-model="personalForm.father_name" class="form-control form-control-sm personal_info_class" id="father_name" placeholder="Enter Father Name"  disabled/>
                          <div v-if="errors.father_name" class="text-danger">{{ errors.father_name[0] }}</div>
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Date of
                          Birth*
                        </label>
                        <div class="col-sm-8">
                          <input type="date" v-model="personalForm.dob" class="form-control form-control-sm personal_info_class" id="dob" placeholder="Enter Date of Birth"  disabled/>
                          <div v-if="errors.dob" class="text-danger">{{ errors.dob[0] }}</div>
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Gender*
                        </label>
                        <div class="col-sm-8">
                          <select class="form-control form-control-sm personal_info_class select2" style="width: 100%;" v-model="personalForm.gender" name="gender" id="gender" disabled>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                          </select>
                          <div v-if="errors.gender" class="text-danger">{{ errors.gender[0] }}</div>
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">PAN Number
                        </label>
                        <div class="col-sm-8">
                          <input type="text" v-model="personalForm.pan_number" name="pan_number" id="pan_number" class="form-control form-control-sm personal_info_class" placeholder="Enter PAN Number"  maxlength="10" disabled/>
                        <div v-if="errors.pan_number" class="text-danger">{{ errors.pan_number[0] }}</div>
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Adhaar Number
                        </label>
                        <div class="col-sm-8">
                          <input type="text" v-model="personalForm.adhaar_number" name="adhaar_number" id="adhaar_number" class="form-control form-control-sm personal_info_class" placeholder="Enter Adhaar Number"  maxlength="12"  disabled/>
                          <div v-if="errors.adhaar_number" class="text-danger">{{ errors.adhaar_number[0] }}</div>
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">ESI Number
                        </label>
                        <div class="col-sm-8">
                          <input type="text" v-model="personalForm.esi_number" name="esi_number" id="esi_number" class="form-control form-control-sm personal_info_class" placeholder="Enter ESI Number"  maxlength="12" disabled />
                          <div v-if="errors.esi_number" class="text-danger">{{ errors.esi_number[0] }}</div>
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">PF Account
                        </label>
                        <div class="col-sm-8">
                          <div class="custom-control custom-radio d-inline-flex">
                              <div class="p-3">
                                <input class="custom-control-input" type="radio" id="pf_yes" name="pf_account" checked="checked" v-model="personalForm.pf_account" value="yes">
                                <label for="pf_yes" class="custom-control-label">Yes</label>
                                </div>
                                <div class="p-3">
                                <input class="custom-control-input" type="radio" id="pf_no" name="pf_account" v-model="personalForm.pf_account" value="no">
                                <label for="pf_no" class="custom-control-label">No</label>
                              </div>
                        </div>
                        <div v-if="errors.pf_account" class="text-danger">{{ errors.pf_account[0] }}</div>
                        </div>
                      </div>
                      
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Nationality
                        </label>
                        <div class="col-sm-8">
                          <select class="form-control form-control-sm personal_info_class select2" v-model="personalForm.nationality" name="nationality" id="nationality" style="width: 100%;" disabled>
                              <option value="">Select Nationality</option>
                              <option value="indian">Indian</option>
                          </select>
                          <div v-if="errors.nationality" class="text-danger">{{ errors.nationality[0] }}</div>
                        </div>
                      </div>

                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Maritial Status
                        </label>
                        <div class="col-sm-8">
                          <select class="form-control form-control-sm personal_info_class select2" v-model="personalForm.maritial_status" name="maritial_status" id="maritial_status" style="width: 100%;" disabled>
                            <option value="">Select Maritial Status</option>
                            <option value="married">Married</option>
                            <option value="single">Single</option>
                          </select>
                          <div v-if="errors.nationality" class="text-danger">{{ errors.nationality[0] }}</div>
                        </div>
                      </div>

                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Contact
                          Number 1

                        </label>
                        <div class="col-sm-8">
                          <input type="text" v-model="personalForm.contact_number_1" name="contact_number_1" id="contact_number_1" class="form-control form-control-sm personal_info_class" placeholder="Enter Contact Number 1"  maxlength="10" disabled/>
                          <div v-if="errors.contact_number_1" class="text-danger">{{ errors.contact_number_1[0] }}</div>
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Contact
                          Number 2

                        </label>
                        <div class="col-sm-8">
                          <input type="text" v-model="personalForm.contact_number_2" name="contact_number_2" id="contact_number_2" class="form-control form-control-sm personal_info_class" placeholder="Enter Contact Number 2"  maxlength="10"  disabled/>
                          <div v-if="errors.contact_number_2" class="text-danger">{{ errors.contact_number_2[0] }}</div>
                  
                        </div>
                      </div>

                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Current
                          Address

                        </label>
                        <div class="col-sm-8">
                          <textarea class="form-control form-control-sm personal_info_class" v-model="personalForm.current_address" name="current_address" id="current_address" placeholder="Enter Current Address"  disabled></textarea>
                          <div v-if="errors.current_address" class="text-danger">{{ errors.current_address[0] }}</div>
                        </div>
                      </div>

                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Permanent
                          Address

                        </label>
                        <div class="col-sm-8">
                          <textarea class="form-control form-control-sm personal_info_class" v-model="personalForm.permanent_address" name="permanent_address" id="permanent_address" placeholder="Enter Permanent Address"  disabled></textarea>
                          <div v-if="errors.permanent_address" class="text-danger">{{ errors.permanent_address[0] }}</div>
                        </div>
                      </div>
                      
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Email </label>
                        <div class="col-sm-8">
                          <input type="email" v-model="personalForm.email" name="email" id="email" class="form-control form-control-sm personal_info_class"  placeholder="Enter Email"  disabled/>
                          <div v-if="errors.email" class="text-danger">{{ errors.email[0] }}</div>
                        </div>
                      </div>
                      

                      <div class="row mt-0">
                        <div class="col-md-12 d-flex align-items-center  justify-content-center personal_info_btn hide_update_btn">
                          <button type="submit" @click="addEmployeePersonalDetail" class="btn btn-sm btn-primary px-5">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="company-details" role="tabpanel" aria-labelledby="company-details-tab">

                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Company Detail</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" @click="editEmployeeDetailForm('company_info')">
                          <i class="fas fa-pencil-alt"></i>
                        </button>
                      </div>
                
                    </div>
                    <div class="card-body">
                <div class="p-d-form">

                  <form action="javascript:void(0)" class="form newtopic" id="company_tab_form" @submit.prevent="submit">
                   
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Employee
                        ID*
                      </label>
                      <div class="col-sm-8">
                        <input type="text" v-model="companyForm.employee_id" class="form-control form-control-sm company_info_class" id="employee_id" placeholder="Enter Employee ID"  disabled/>
                        <div v-if="errors.employee_id" class="text-danger">{{ errors.employee_id[0] }}</div>
                      </div>
                    </div>

                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Department*
                      </label>
                      <div class="col-sm-8">
                        <select class="form-control form-control-sm select2 company_info_class" style="width: 100%;" v-model="companyForm.department" name="department" id="department"  disabled>
                          <option value="">Select Department</option>
                          <option value="1">Accounts</option>
                          <option value="2">Exam Dept</option>
                        </select>
                        <div v-if="errors.department" class="text-danger">{{ errors.department[0] }}</div>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Designation*
                      </label>
                      <div class="col-sm-8">
                        <select class="form-control form-control-sm select2 company_info_class" style="width: 100%;" v-model="companyForm.designation" name="designation" id="designation" disabled>
                          <option value="">Select Designation</option>
                          <option value="1">Manager</option>
                          <option value="2">Supervisor</option>
                        </select>
                        <div v-if="errors.designation" class="text-danger">{{ errors.designation[0] }}</div>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Date of
                        Joining*
                      </label>
                      <div class="col-sm-8">
                        <input type="date" v-model="companyForm.doj" class="form-control form-control-sm" id="doj" placeholder="Enter Date of Joining"  disabled/>
                        <div v-if="errors.doj" class="text-danger">{{ errors.doj[0] }}</div>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Date of
                        Leaving*
                      </label>
                      <div class="col-sm-8">
                        <input type="date" v-model="companyForm.dol" class="form-control form-control-sm" id="dol" placeholder="Enter Date of Leaving"  disabled/>
                        <div v-if="errors.dol" class="text-danger">{{ errors.dol[0] }}</div>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Status
                      </label>
                      <div class="col-sm-8">
                        <select class="form-control form-control-sm select2" style="width: 100%;" v-model="companyForm.status" name="status" id="status" disabled>
                          <option value="">Select Status</option>
                          <option value="enable">Active</option>
                          <option value="disable">Inactive</option>
                        </select>
                        <div v-if="errors.status" class="text-danger">{{ errors.status[0] }}</div>
                      </div>
                    </div>

                    <div class="row mt-0">
                      <div class="col-md-12 d-flex align-items-center  justify-content-center company_info_btn hide_update_btn">
                        <button type="submit" @click="addEmployeeCompanyDetail" class="btn btn-sm btn-primary px-5">Update</button>
                      </div>
                    </div>


              </form>
                </div>
              </div>
              </div>
            </div>
            <div class="tab-pane fade" id="financial-details" role="tabpanel"
              aria-labelledby="financial-details-tab">
              <form action="javascript:void(0)" class="form newtopic" id="finance_bank_tab_form" @submit.prevent="submit">
                 
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Financial Details</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" @click="editEmployeeDetailForm('finance_bank_info')">
                          <i class="fas fa-pencil-alt"></i>
                        </button>
                      </div>
                
                    </div>
                    <div class="card-body">
                <div class="p-d-form">

                  
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Basic Salary
                      </label>
                      <div class="col-sm-8">
                        <input type="number" v-model="financeBankForm.basic_salary" class="form-control form-control-sm" id="basic_salary" placeholder="Enter Basic Salary"  disabled/>
                       <div v-if="errors.basic_salary" class="text-danger">{{ errors.basic_salary[0] }}</div>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Monthly Salary
                      </label>
                      <div class="col-sm-8">
                        <input type="number" v-model="financeBankForm.monthly_salary" class="form-control form-control-sm" id="monthly_salary" placeholder="Enter Monthly Salary" disabled />
                        <div v-if="errors.monthly_salary" class="text-danger">{{ errors.monthly_salary[0] }}</div>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Yearly  Salary
                      </label>
                      <div class="col-sm-8">
                        <input type="number" v-model="financeBankForm.yearly_salary" class="form-control form-control-sm" id="yearly_salary" placeholder="Enter Yearly Salary"  disabled/>
                        <div v-if="errors.yearly_salary" class="text-danger">{{ errors.yearly_salary[0] }}</div>
                      </div>
                    </div>

                </div>
              </div>
              </div>

                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Bank Account Details</h3>
                    </div>
                    <div class="card-body">
                <div class="p-d-form">


                  
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Account
                        Holder Name
                      </label>
                      <div class="col-sm-8">
                        <input type="text" v-model="financeBankForm.account_holder_name" class="form-control form-control-sm finance_bank_info_class" id="account_holder_name" placeholder="Enter Account Holder Name" disabled/>
                        <div v-if="errors.account_holder_name" class="text-danger">{{ errors.account_holder_name[0] }}</div>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Account
                        Number
                      </label>
                      <div class="col-sm-8">
                        <input type="text" v-model="financeBankForm.account_number" class="form-control form-control-sm finance_bank_info_class" id="account_number" placeholder="Enter Account Number"  disabled/>
                        <div v-if="errors.account_number" class="text-danger">{{ errors.account_number[0] }}</div>
                      </div>
                    </div>

                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Bank Name
                      </label>
                      <div class="col-sm-8">
                        <input type="text" v-model="financeBankForm.bank_name" class="form-control form-control-sm finance_bank_info_class" id="bank_name" placeholder="Enter Bank Name" disabled/>
                        <div v-if="errors.bank_name" class="text-danger">{{ errors.bank_name[0] }}</div>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Branch
                      </label>
                      <div class="col-sm-8">
                        <input type="text" v-model="financeBankForm.branch" class="form-control form-control-sm finance_bank_info_class" id="branch" placeholder="Enter Branch"  disabled/>
                        <div v-if="errors.branch" class="text-danger">{{ errors.branch[0] }}</div>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-4 col-form-label-sm">IFSC Code
                      </label>
                      <div class="col-sm-8">
                        <input type="text" v-model="financeBankForm.ifsc_code" class="form-control form-control-sm finance_bank_info_class" id="ifsc_code" placeholder="Enter Bank Name"  disabled/>
                        <div v-if="errors.ifsc_code" class="text-danger">{{ errors.ifsc_code[0] }}</div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-12 d-flex align-items-center  justify-content-center finance_bank_info_btn hide_update_btn">
                        <button type="submit" @click="addEmployeeFinancialDetail" class="btn btn-sm btn-primary px-5">Update</button>
                      </div>
                    </div>

                  
                </div>
                
              </div>
              
            </div>
          </form>
            </div>
            <div class="tab-pane fade" id="doc-details" role="tabpanel" aria-labelledby="doc-details-tab">

             
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Documents</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool">
                          <i class="fas fa-pencil-alt"></i>
                        </button>
                      </div>
                
                    </div>
                    <div class="card-body">
                <dl class="row customDList1 mb-0">
                  <label class="col-sm-4 col-form-label-sm">Offer Letter</label>
                  <div class="col-sm-8"> <button type="button"
                      class="btn btn-secondary btn-sm py-0 mb-1">View</button>
                    <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Download</button>
                    <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Delete</button>

                  </div>
                  <label class="col-sm-4 col-form-label-sm">Joining Letter</label>
                  <div class="col-sm-8"> <button type="button"
                      class="btn btn-secondary btn-sm py-0 mb-1">View</button>
                    <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Download</button>
                    <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Delete</button>
                  </div>
                  <label class="col-sm-4 col-form-label-sm">Agreement</label>
                  <div class="col-sm-8"> <button type="button"
                      class="btn btn-secondary btn-sm py-0 mb-1">View</button>
                    <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Download</button>
                    <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Delete</button>
                  </div>
                  <label class="col-sm-4 col-form-label-sm">Google Drive</label>
                  <div class="col-sm-8"><button type="button"
                      class="btn btn-secondary btn-sm py-0 mb-1">View</button>
                    <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Download</button>
                    <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Delete</button>
                  </div>

                </dl>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--container-fluid-->
  </section>
  <!--content-->
</template>
<script>
  import { ref, onMounted , reactive} from 'vue';
  import { useRoute } from 'vue-router'
  import Swal from 'sweetalert2'
  import { useToastr } from '../../toastr.js';
  import jQuery from "jquery";
  const toastr = useToastr();
  const $ = jQuery;
  export default {
    setup(){
      let empoyeeProfile = {};
      const route = useRoute();
      console.log(route);
      const profile_pic_src = ref('');
      const emp_email = ref('');
      const emp_phone = ref('');
      const errors = ref('');
      const personalForm = reactive({
            user_id: route.params.id,
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
            is_details_update:1,
      });
      
      const companyForm = reactive({
            user_id: route.params.id,
            assigned_manager: '',
            employee_id: '',
            department: '',
            designation: '',
            doj: '',
            dol: '',
            status: '',
            search_by_email: '',
            search_by_name: '',
            is_details_update:1,
      });

      const financeBankForm = reactive({
            user_id: route.params.id,
            basic_salary: '',
            // allowances: '',
            // allowances_amount: '',
            // deductions: '',
            // deductions_amount: '',
            monthly_salary: '',
            yearly_salary: '',
            account_holder_name: '',
            account_number: '',
            bank_name: '',
            branch: '',
            ifsc_code: '',
            is_details_update:1,
            
      });

      const editEmployeeDetailForm = (name) => {
        if(name != ''){
          $('.'+name+'_class').removeAttr("disabled");
          $('.'+name+'_btn').removeClass("hide_update_btn");
        }
      }
      const editDisableEmployeeDetailForm = (name) => {
        console.log('name=='+name);
        if(name != ''){
          $('.'+name+'_class').attr("disabled",true);
          $('.'+name+'_btn').addClass("hide_update_btn");
        }
      }
      const addEmployeePersonalDetail = () => {
          let formData = new FormData();
          formData.append('user_id', personalForm.user_id);
          formData.append('name', personalForm.name);
          formData.append('father_name', personalForm.father_name);
          formData.append('dob', personalForm.dob);
          formData.append('gender', personalForm.gender);
          formData.append('contact_number_1', personalForm.contact_number_1);
          formData.append('contact_number_2', personalForm.contact_number_2);
          formData.append('current_address', personalForm.current_address);
          formData.append('permanent_address', personalForm.permanent_address);
          formData.append('nationality', personalForm.nationality);
          formData.append('maritial_status', personalForm.maritial_status);
          formData.append('email', personalForm.email);
          formData.append('pan_number', personalForm.pan_number);
          formData.append('adhaar_number', personalForm.adhaar_number);
          formData.append('esi_number', personalForm.esi_number);
          formData.append('pf_account', personalForm.pf_account);
          formData.append('is_details_update', personalForm.is_details_update);
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

                        editDisableEmployeeDetailForm('personal_info');
                        //router.push({ name: 'company-detail', params: { id: btoa(response.data.data.id) } })
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

      const addEmployeeCompanyDetail = () => {
        errors.value = '';
        axios.post('/api/add-employee-company-detail',companyForm).then((response) => {
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
                         editDisableEmployeeDetailForm('company_info');
                        //router.push({ name: 'financial-detail', params: { id: route.params.id } })
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

      const addEmployeeFinancialDetail = () => {
        errors.value = '';
        axios.post('/api/add-employee-financial-detail',financeBankForm).then((response) => {
              if(response.data.code == 'success'){
                Swal.fire({
                      title: 'Data Saved!',
                      text: "Employee Financial Detail has been saved!",
                      icon: 'success',
                      allowOutsideClick: false,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'ok'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        editDisableEmployeeDetailForm('finance_bank_info');
                        //router.push({ name: 'documents-detail', params: { id: route.params.id } })                  
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
      const employeeProfilePreview = () => {
        axios.get('/api/admin/get-employee-profile-data/'+route.params.id).then((response) => {
          if(response.data){
            empoyeeProfile = response.data.data;
            console.log(empoyeeProfile.employee); 

            //Personal Details Data
            Object.assign(personalForm, empoyeeProfile.employee);
            Object.assign(personalForm, empoyeeProfile.employee.employee_personal_info);
            personalForm.contact_number_2 = empoyeeProfile.employee.employee_personal_info.phone_number_2;
            personalForm.contact_number_1 = empoyeeProfile.employee.phone_number;
            personalForm.pf_account = empoyeeProfile.employee.employee_personal_info.pf_account;
            emp_email.value = empoyeeProfile.employee.email;
            emp_phone.value = empoyeeProfile.employee.phone_number;

            //Compnay Details Data
            Object.assign(companyForm, empoyeeProfile.employee.employee_company_info);
            companyForm.department = empoyeeProfile.employee.employee_company_info.department_id;
            companyForm.designation = empoyeeProfile.employee.employee_company_info.designation_id;
            

            
            //Finance and bank Details Data
            Object.assign(financeBankForm, empoyeeProfile.employee.employee_financial_info);
            Object.assign(financeBankForm, empoyeeProfile.employee.employee_bank_info);
            
            //profile_pic_src.value = empoyeeProfile.employee.employee_personal_info.photo;
          }
          }).catch((e) => {
               console.log(e);
          });
      }
      onMounted(() => {
        const empId = route.params.id
        employeeProfilePreview()
        console.log(empId)
      })

      return {
        personalForm,errors,profile_pic_src,emp_email,emp_phone,editEmployeeDetailForm,addEmployeePersonalDetail,editDisableEmployeeDetailForm,addEmployeeCompanyDetail,companyForm,financeBankForm,addEmployeeFinancialDetail
      }
    }

  };

</script>