<template>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Financial Details</h1> -->
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
                  <div class="col-md-10">
                  <div class="form-container">
                <div class="card-header">
                  <h2 class="card-title title_decoration">Offer Letter Setting</h2>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label col-form-label-sm">Title<span class="text-danger font-weight-bold">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" v-model="form.title" class="form-control form-control-sm" id="title" placeholder="Enter Title"  />
                      <div v-if="errors.title" class="text-danger">{{ errors.title[0] }}</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="allowed_vars" class="col-sm-3 col-form-label col-form-label-sm">Allowed Vars</label>
                    <div class="col-sm-9">
                      <input type="text" v-model="form.allowed_vars" class="form-control form-control-sm" id="allowed_vars" placeholder="Enter Allowed Vars"  />
                      <div v-if="errors.allowed_vars" class="text-danger">{{ errors.allowed_vars[0] }}</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label col-form-label-sm">Description<span class="text-danger font-weight-bold">*</span></label>
                    <div class="col-sm-9">
                        <textarea id="editor_description" name="editor_description" ></textarea>
                        <div v-if="errors.description" class="text-danger">{{ errors.description[0] }}</div>
                    </div>
                  </div>
                  
                  </div>
                </div> 
              </div>
              <div class="card-footer col-md-12 ">
                <button type="submit" @click="addOfferLetterSettingDetail" class="btn btn-primary float-sm-right mr-10">Submit</button>
                
              </div>
            </div>
          
        </div>
      </div>
    </div>
  </template>

  <script setup>
      import { ref, onMounted , reactive} from 'vue';
      import Swal from 'sweetalert2'
      import { useToastr } from '../../toastr.js';
      import jQuery from "jquery";
      const $ = jQuery;
      let ckeditor;
      const errors = ref('');
      const toastr = useToastr();
      const step_completed = ref('');
      const form = reactive({
                  title: '',
                  alias: '',
                  allowed_vars: '',
                  description: '',
      });
    
      const addOfferLetterSettingDetail = () => {
          errors.value = '';
          showLoader();
          axios.post('/api/setting-offer-letter',form).then((response) => {
            if(response.data.code == 'success'){
              Swal.fire({
                    title: 'Data Saved!',
                    text: "Offer Letter Format has been saved!",
                    icon: 'success',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ok'
                  }).then((result) => {
                    
                  })
                
            }else if(response.data.code == 'error_validate'){
                  errors.value = response.data.errors;
            }else{
               console.log(response.data.message);
               Swal.fire('Failed!', response.data.message, 'warning');
            }
            removeLoader();
            
          }).catch((e) => {
           console.log(e);
      });
      }
      const getOfferLetterFormatDetail = () => {
              showLoader();
              axios.post('/api/get-offer-letter-format').then((response) => {
              if(response.data.code == 'success'){
                
                Object.assign(form, response.data.data);
                form.description = response.data.data.description;
                ckeditor.setData(response.data.data.description);

              }else{
                //console.log(response.data.message);
                Swal.fire('Failed!', response.data.message, 'warning');
              }
              removeLoader();
              }).catch((e) => {
                  console.log(e);
                  // Swal.fire('Failed!','Something went wrong.', 'warning');
              });
        
      }
      const setEditorData = () => {
          if (localStorage.getItem('reloaded')) {
            // The page was just reloaded. Clear the value from local storage
            // so that it will reload the next time this page is visited.
            localStorage.removeItem('reloaded');
            
          } else {
            // Set a flag so that we know not to reload the page twice.
            localStorage.setItem('reloaded', '1');
            location.reload();
          }
      }
      const showLoader = () => {
                var loading_icon = '<div class="dataprocessing"><div class="loading-icon"><i class="fa fa-spinner fa-spin"></i></div></div>';
                $("body").append(loading_icon);
      }
      const removeLoader = () => {
              $("div.dataprocessing").remove();
      }
    
      onMounted (() => {
        ckeditor = window.CKEDITOR.replace("editor_description");
        //on event change
        ckeditor.on('change',()=>{
          form.description = ckeditor.getData();
          console.log(form.description);
        });
        
        getOfferLetterFormatDetail();
        setEditorData();
       
      });
  
  </script>
  