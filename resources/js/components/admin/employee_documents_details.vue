<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Document Details</h1>
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
                <progressbar-component ref="progressbarRef" :setup="4" :step_completed="step_completed" :empID = "passEmpID"></progressbar-component>
            </div>
        		<div class="col-md-10">
            	<div class="form-container">
              <div class="card-header">
                <h2 class="card-title title_decoration">Document Details</h2>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  
                  <label for="resume" class="col-sm-2 col-form-label col-form-label-sm">Resume<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-6">
                    
                      <div class="custom-file">
                        <input type="file" class="form-control file-upload-input" v-on:change="onChangeResumeFile"  id="resume" />
                        <label class="custom-file-label" id="resume_label" for="resume">Choose File</label>
                        <div v-if="errors.resume_file" class="text-danger">{{ errors.resume_file[0] }}</div> 
                      </div>
                      
                   
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="offer_letter" class="col-sm-2 col-form-label col-form-label-sm">Offer Letter<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-6">
                      <div class="custom-file">

                        <input type="file" class="form-control file-upload-input" name="offer_letter" id="offer_letter"  v-on:change="onChangeOfferLetterFile"   />
                        <label class="custom-file-label" id="offer_letter_label" for="offer_letter">Choose File</label>
                        <div v-if="errors.offer_letter" class="text-danger">{{ errors.offer_letter[0] }}</div> 

                      </div>
                   
                  </div>
                  <div class="col-sm-4">
                      <button type="button" class="btn btn-primary float-sm-right mr-10" @click="createPdfForOfferLetter()">Download Letter</button>
                      <button type="button" class="btn btn-primary float-sm-right mr-10" @click="showPopupForEditLetter()">Edit Letter</button>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="joining_letter" class="col-sm-2 col-form-label col-form-label-sm">Joining Letter<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-6">
                   
                      <div class="custom-file">

                        <input type="file" class="form-control file-upload-input" name="joining_letter" id="joining_letter"  v-on:change="onChangeJoiningLetterFile" />
                        <label class="custom-file-label" id ="joining_letter_label" for="joining_letter">Choose File</label>
                        <div v-if="errors.joining_letter" class="text-danger">{{ errors.joining_letter[0] }}</div> 

                      </div>
                      
                  </div>
                </div>
                <div class="form-group row">
                  <label for="agreement" class="col-sm-2 col-form-label col-form-label-sm">Agreement<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-6">
                   
                      <div class="custom-file">

                        <input type="file" class="form-control file-upload-input" name="agreement" id="agreement"   v-on:change="onChangeAgreementFile"/>
                       <label class="custom-file-label" id="agreement_label" for="agreement">Choose File</label>
                       <div v-if="errors.agreement" class="text-danger">{{ errors.agreement[0] }}</div> 
                      </div>
                      
                  </div>
                </div>
                <div class="form-group row">

                  <label for="name" class="col-sm-2 col-form-label">Dropbox URL<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="dropbox_url" placeholder="Enter Dropbox URL" v-model="documentFieldsData.dropbox_url" />
                    <div v-if="errors.dropbox_url" class="text-danger">{{ errors.dropbox_url[0] }}</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Google Drive<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="google_drive" placeholder="Enter Google Drive" v-model="documentFieldsData.google_drive" />
                    <div v-if="errors.google_drive" class="text-danger">{{ errors.google_drive[0] }}</div>
                  </div>
                </div>
                
                <!-- <div class="form-group row" v-for="(input,k) in inputs" :key="k"> 
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="k" placeholder="Doc file Label" v-model="input.label" />
                  </div>
                  <label for="agreement" class="col-sm-4 col-form-label col-form-label-sm">Agreement<span class="text-danger font-weight-bold">*</span></label>
                  <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="form-control file-upload-input" name="input.doc"  />
                       <label class="custom-file-label" id="agreement_label" for="agreement">Choose File</label>
                      </div>
                  </div>
                  <div class="col-sm-2">
                    <i class="fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)"></i>
                    <i class="fas fa-plus-circle" @click="add(k)" v-show="k == inputs.length-1"></i>
                  </div>
                  
                </div> -->
                
                </div>
              </div>
            </div>

            <div class="col-md-6">
            	<div class="form-container">
              <div class="card-header">
                <h2 class="card-title title_decoration">Extra Document Details</h2>
              </div>
              <div class="card-body">
               
                
                <div class="form-group row" v-for="(input,k) in documentFieldsData.inputs" :key="k"> 
                  <div class="col-sm-4">
                    <input :name ="'extra_doc_label_'+k" :for="'extra_doc_label_'+k" type="text" class="form-control" :id="'extra_doc_label_'+k" placeholder="Document Label" v-model="input.label" />
                  </div>
                  <!-- <label for="agreement" class="col-sm-4 col-form-label col-form-label-sm">Agreement<span class="text-danger font-weight-bold">*</span></label> -->
                  <div class="col-sm-6">
                      <div class="custom-file">
                        <input :name ="'extra_doc_'+k" type="file" class="form-control file-upload-input" :id="'extra_doc_' + k" v-on:change="onChangeExtraFile($event, k)"/>
                       <label class="custom-file-label" :id="'extra_doc_img' + k" :for="'extra_doc_' + k">Choose File</label>
                      </div>
                  </div>
                  <div class="col-sm-2">

                    <button type="button" class="btn btn-danger" @click="remove(k)" v-show="k || ( !k && documentFieldsData.inputs.length > 1)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-minus" viewBox="0 0 16 16">
  <path d="M5.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
  <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg>
                    </button>
                    <button type="button" class="btn btn-primary" @click="add(k)" v-show="k == documentFieldsData.inputs.length-1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">
  <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
</svg>
                    </button>
                   
                  </div>
                  
                </div>
                
                </div>
              </div>
            </div>

            <div class="card-footer col-md-12 ">
              <button type="submit" @click="addEmployeeDocumentDetail" class="btn btn-primary float-sm-right mr-10">Submit</button>
              <button type="button" @click="employeeProfilePreview" class="btn btn-primary mr-20 float-right mr-10">Preview</button>
            </div>
            
          </div>
      </div>
      <offer-letter-format-component ref="offerLetterFormatRef" @callOfferLetterContent="getEmployeeOfferLetterCont" :employeeOfferLetterCon="employeeOfferLetterContent"></offer-letter-format-component>
    </div>
    
  </div>

  <!-- Modal -->
<div class="modal fade" id="preDetailsModal" tabindex="-1" role="dialog"
   aria-labelledby="preDetailsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header py-2">
              <h5 class="modal-title text-primary font-weight-bold" id="preDetailsModalTitle">Preview Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="row" v-if="employee_preview_data != null">
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Personel Details</h6>
                    <div class="card p-3 d-block">
                      <dl class="row customDList mb-0">
                          <dt class="col-sm-4">Photo</dt>
                          <dd class="col-sm-8"><img src="https://dummyimage.com/100/000/fff" alt="photo"
                            class="img-fluid" width="50"></dd>
                          <dt class="col-sm-4">Name</dt>
                          <dd class="col-sm-8">{{employee_preview_data.name}}</dd>
                          <dt class="col-sm-4">Email</dt>
                          <dd class="col-sm-8">{{employee_preview_data.email}}</dd>
                          <dt class="col-sm-4">Father Name</dt>
                          <dd class="col-sm-8">{{employee_preview_data.name}}</dd>
                          <dt class="col-sm-4">Gender</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_personal_info">{{employee_preview_data.employee_personal_info.gender}}</span></dd>
                          <dt class="col-sm-4">Contact Number 1</dt>
                          <dd class="col-sm-8">{{employee_preview_data.phone_number}}</dd>
                          <dt class="col-sm-4">Contact Number 2</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_personal_info">{{employee_preview_data.employee_personal_info.phone_number_2}}</span></dd>
                          <dt class="col-sm-4">Current Address</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_personal_info">{{employee_preview_data.employee_personal_info.current_address}}</span></dd>
                          <dt class="col-sm-4">Permanent Address</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_personal_info">{{employee_preview_data.employee_personal_info.permanent_address}}</span></dd>
                          <dt class="col-sm-4">Nationality</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_personal_info">{{employee_preview_data.employee_personal_info.nationality}}</span></dd>
                          <dt class="col-sm-4">Maritial Status</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_personal_info">{{employee_preview_data.employee_personal_info.maritial_status}}</span></dd>
                      </dl>
                    </div>
                    <h6 class="font-weight-bold">Company Details</h6>
                    <div class="card p-3 d-block">
                      <dl class="row customDList mb-0">
                          <dt class="col-sm-4">Employee ID</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_company_info">{{employee_preview_data.employee_company_info.employee_id}}</span></dd>
                          <dt class="col-sm-4">Department</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_company_info">{{employee_preview_data.employee_company_info.department_id}}</span></dd>
                          <dt class="col-sm-4">Designation</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_company_info">{{employee_preview_data.employee_company_info.designation_id}}</span></dd>
                          <dt class="col-sm-4">Date of Joining</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_company_info">{{employee_preview_data.employee_company_info.doj}}</span></dd>
                          <dt class="col-sm-4">Date of Leaving</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_company_info">{{employee_preview_data.employee_company_info.dol}}</span></dd>
                          <dt class="col-sm-4">Status</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_company_info">{{employee_preview_data.employee_company_info.status}}</span></dd>
                      </dl>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Financial Details</h6>
                    <div class="card p-3 d-block">
                      <dl class="row customDList mb-0">
                          <dt class="col-sm-4">Basic Salary</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_financial_info">{{employee_preview_data.employee_financial_info.basic_salary}}</span></dd>
                          <dt class="col-sm-4">Allowances</dt>
                          <dd class="col-sm-8">N/A</dd>
                          <dt class="col-sm-4">Deduction</dt>
                          <dd class="col-sm-8">N/A</dd>
                          <dt class="col-sm-4">Monthly Salary</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_financial_info">{{employee_preview_data.employee_financial_info.monthly_salary}}</span></dd>
                          <dt class="col-sm-4">Yearly  Salary</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_financial_info">{{employee_preview_data.employee_financial_info.yearly_salary}}</span></dd>
                      </dl>
                      <hr/>
                      <dl class="row customDList mb-0">
                          <dt class="col-sm-4">Account Holder Name</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_bank_info">{{employee_preview_data.employee_bank_info.account_holder_name}}</span></dd>
                          <dt class="col-sm-4">Account Number</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_bank_info">{{employee_preview_data.employee_bank_info.account_number}}</span></dd>
                          <dt class="col-sm-4">Bank Name</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_bank_info">{{employee_preview_data.employee_bank_info.bank_name}}</span></dd>
                          <dt class="col-sm-4">Branch</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_bank_info">{{employee_preview_data.employee_bank_info.branch}}</span></dd>
                          <dt class="col-sm-4">IFSC Code</dt>
                          <dd class="col-sm-8"><span v-if="employee_preview_data.employee_bank_info">{{employee_preview_data.employee_bank_info.ifsc_code}}</span></dd>
                      </dl>
                    </div>
                    <h6 class="font-weight-bold">Documents
                    </h6>
                    <div class="card p-3 d-block">
                      <dl class="row customDList mb-0">
                          <dt class="col-sm-4">Offer Letter</dt>
                          <dd class="col-sm-8"> <button type="button"
                            class="btn btn-secondary btn-sm py-0 mb-1">View</button>
                            <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Download</button>
                          </dd>
                          <dt class="col-sm-4">Joining Letter</dt>
                          <dd class="col-sm-8"> <button type="button"
                            class="btn btn-secondary btn-sm py-0 mb-1">View</button>
                            <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Download</button>
                          </dd>
                          <dt class="col-sm-4">Agreement</dt>
                          <dd class="col-sm-8"> <button type="button"
                            class="btn btn-secondary btn-sm py-0 mb-1">View</button>
                            <button type="button" class="btn btn-secondary btn-sm py-0 mb-1">Download</button>
                          </dd>
                          <dt class="col-sm-4">Google Drive</dt>
                          <dd class="col-sm-8">N/A</dd>
                          <dt class="col-sm-4">Dropbox URL</dt>
                          <dd class="col-sm-8">N/A</dd>
                      </dl>
                    </div>
                </div>
              </div>
          </div>
          <div class="modal-footer py-0">
              <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Edit</button>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Ok</button>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
  import { ref, onMounted , reactive} from 'vue';
  import { useRoute, useRouter } from 'vue-router'
  import Swal from 'sweetalert2'
  import { useToastr } from '../../toastr.js';
  import jQuery from "jquery";
  const $ = jQuery;
  // const route = useRoute()
  // const router = useRouter()
  // const toastr = useToastr();
  
  
  


import ProgressbarComponent from "@/components/admin/form_progress_bar.vue"
import OfferLetterFormatComponent from "@/components/admin/offer_letter_format.vue"
export default {
        data() {
            return {
              step_completed:'',
              errors:{},
              employeeOfferLetterContent:'',
              employee_preview_data: {},
              employeeID : '',
              passEmpID : '',
              documentFieldsData : {
                 'user_id' : this.employeeID,
                 'resume_file' : '',
                 'offer_letter' : '',
                 'joining_letter' : '',
                 'agreement' : '',
                 'dropbox_url' : '',
                 'google_drive' : '',
                 'inputs': [
                    {
                        label: '',
                        doc: ''
                    }
                ],
              },
              
            };
        }, 
        components: {
          ProgressbarComponent,
          OfferLetterFormatComponent
        },
        mounted() { 
          this.employeeID = atob(this.$route.params.id )
          this.passEmpID = this.$route.params.id
          this.getEmployeeOfferLetterContent();
          this.getFilledFormSetup();
        
        },
        methods: {
            getEmployeeOfferLetterCont(){
                this.getEmployeeOfferLetterContent();
            },
            showPopupForEditLetter(){
              this.$refs.offerLetterFormatRef.showOfferLetterModel();
              
            },
            createPdfForOfferLetter(){
              //let userId = localStorage.getItem('emp_id');
              if((this.employeeID != '') && (this.employeeID != null)){
                  axios.post('/api/create-offer-letter-pdf',{ 'userId':this.employeeID}).then((response) => {
                      if(response.data.code == 'success'){
                          window.open(response.data.pdf_path, '_blank');
                      }
                  }).catch((e) => {
                        console.log(e);
                        // Swal.fire('Failed!','Something went wrong.', 'warning');
                  });
              }
            },
            add(index) {
                this.documentFieldsData.inputs.push({ label: '', doc: ''  });
            },
            remove(index) {
                this.documentFieldsData.inputs.splice(index, 1);
            },

            goPreviousStepForm() {
              router.push({ name: 'bank-account-detail', params: { id: this.passEmpID } })
            },
            onChangeExtraFile(e, k){
              console.log(k)
              if(e.target.files[0].name != ''){
                 this.documentFieldsData.inputs[k]['doc'] = e.target.files[0];
                 document.getElementById("extra_doc_img"+k).innerHTML = e.target.files[0].name; 
              }else{
                 document.getElementById("extra_doc_img"+k).innerHTML = 'Choose File';
              }
            },
            onChangeResumeFile(e) {
              if(e.target.files[0].name != ''){
                 this.documentFieldsData.resume_file = e.target.files[0];
                 document.getElementById("resume_label").innerHTML = e.target.files[0].name; 
              }else{
                 document.getElementById("resume_label").innerHTML = 'Choose File';
              }
               
            },
            onChangeOfferLetterFile(e){
              if(e.target.files[0].name != ''){
                 this.documentFieldsData.offer_letter = e.target.files[0];
                 document.getElementById("offer_letter_label").innerHTML = e.target.files[0].name; 
              }else{
                 document.getElementById("offer_letter_label").innerHTML = 'Choose File';
              }
            },
            onChangeJoiningLetterFile(e){
              if(e.target.files[0].name != ''){
                 this.documentFieldsData.joining_letter = e.target.files[0];
                 document.getElementById("joining_letter_label").innerHTML = e.target.files[0].name; 
              }else{
                 document.getElementById("joining_letter_label").innerHTML = 'Choose File';
              }
            },
            onChangeAgreementFile(e){
              if(e.target.files[0].name != ''){
                 this.documentFieldsData.agreement = e.target.files[0];
                 document.getElementById("agreement_label").innerHTML = e.target.files[0].name; 
              }else{
                 document.getElementById("agreement_label").innerHTML = 'Choose File';
              }
            },
            getFilledFormSetup(){
                if((this.employeeID != '') && (this.employeeID != null)){
                    axios.post('/api/get-filled-form-setup',{ 'userId':this.employeeID}).then((response) => {
                        if(response.data.code == 'success'){
                            this.step_completed = response.data.step_completed;
                        }
                    }).catch((e) => {
                          console.log(e);
                          // Swal.fire('Failed!','Something went wrong.', 'warning');
                    });
                }
            },
            getEmployeeOfferLetterContent(){
                if((this.employeeID != '') && (this.employeeID != null)){
                    axios.post('/api/get-employee-offer-letter-content',{ 'userId':this.employeeID}).then((response) => {
                        if(response.data.code == 'success'){
                           this.employeeOfferLetterContent = response.data.letter_content;


                        }
                    }).catch((e) => {
                          console.log(e);
                          // Swal.fire('Failed!','Something went wrong.', 'warning');
                    });
                }
            },
            
            addEmployeeDocumentDetail(e) {
                e.preventDefault();
                let existingObj = this.documentFieldsData;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let formData = new FormData();
                formData.append('resume_file', this.documentFieldsData.resume_file);
                formData.append('offer_letter', this.documentFieldsData.offer_letter);
                formData.append('joining_letter', this.documentFieldsData.joining_letter);
                formData.append('agreement', this.documentFieldsData.agreement);
                formData.append('dropbox_url', this.documentFieldsData.dropbox_url);
                formData.append('google_drive', this.documentFieldsData.google_drive);
                formData.append('user_id', this.documentFieldsData.user_id);
                
                

                for (const [key, value] of Object.entries(this.documentFieldsData.inputs)) {
                    formData.append('otherDoc['+key+'][label]', value.label);
                    formData.append('otherDoc['+key+'][doc]', value.doc);
                }
                // var ins = document.getElementById('fileToUpload').files.length;
                // for (var x = 0; x < ins; x++) {
                //   formData.append("inputs[]", document.getElementById('fileToUpload').files[x]);
                // }
                //console.log(this.documentFieldsData); return false;
                this.errors = {};

                axios.post('/api/add-employee-document-detail',formData).then((response) => {
                      if(response.data.code == 'success'){
                        localStorage.removeItem("emp_id");
                        Swal.fire({
                              title: 'Data Saved!',
                              text: "New employee has been added!",
                              icon: 'success',
                              allowOutsideClick: false,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'ok'
                            }).then((result) => {
                              if (result.isConfirmed) {
                                window.location = '/dashboard';
                              }
                            })
                          
                      }else if(response.data.code == 'error_validate'){
                            this.errors = response.data.errors;
                      }else{
                         console.log(response.data.message);
                         Swal.fire('Failed!', response.data.message, 'warning');
                      }
                      
                }).catch((e) => {
                     console.log(e);
                });

            },
             employeeProfilePreview(){
               axios.post('/api/get-employee-preview-data/'+this.employeeID).then((response) => {
                      
                      this.employee_preview_data = response.data.employees;
                      console.log(this.employee_preview_data);
                      $('#preDetailsModal').modal('show'); 
                      
                }).catch((e) => {
                     console.log(e);
                });
            }
        }
    };
</script>