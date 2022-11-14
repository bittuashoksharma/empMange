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
                  <img id="imagePreview" src="https://dummyimage.com/100/000/fff">

                </div>
              </div>
            </div>
            <div class="card-footer px-1 small">
              <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><i class="fas fa-phone-alt"></i></h5>
                    <span class="description-text">+9134423423</span>
                  </div>

                </div>

                <div class="col-sm-6">
                  <div class="description-block">
                    <h5 class="description-header"><i class="far fa-envelope"></i></h5>
                    <span class="description-text text-lowercase">email@test.com</span>
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
                <a class="nav-link rounded-0" id="bank-details-tab" data-toggle="tab" data-target="#bank-details"
                  href="#" role="tab" aria-controls="bank-details" aria-selected="false">Bank
                  Account Details </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link rounded-0" id="doc-details-tab" data-toggle="tab" data-target="#doc-details"
                  href="#" role="tab" aria-controls="doc-details" aria-selected="false"> Documents </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">

          <div class="tab-content pl-md-4" id="myTabContent">
            <div class="tab-pane fade show active" id="personal-details" role="tabpanel"
              aria-labelledby="personal-details-tab">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Personel Details</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                  </div>

                </div>
                <div class="card-body">
                  <div class="p-d-form ">


                    <form>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Name*
                        </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control form-control-sm" id="inputName" disabled="">
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Father
                          Name*
                        </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control form-control-sm" id="inputFName">
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Date of
                          Birth*
                        </label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control form-control-sm" id="inputDOB" disabled="">
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Gender*
                        </label>
                        <div class="col-sm-8">
                          <select class="form-control form-control-sm" aria-label="Male" disabled="">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Contact
                          Number 1

                        </label>
                        <div class="col-sm-8">
                          <input type="tel" class="form-control form-control-sm" id="inputCont1">
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Contact
                          Number 2

                        </label>
                        <div class="col-sm-8">
                          <input type="tel" class="form-control form-control-sm" id="inputCont2">
                        </div>
                      </div>

                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Current
                          Address

                        </label>
                        <div class="col-sm-8">
                          <textarea rows="1" name="Current Address" class="form-control form-control-sm" id="inputCurrAdd"></textarea>
                        </div>
                      </div>

                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Permanent
                          Address

                        </label>
                        <div class="col-sm-8">
                          <textarea rows="1" name="Permanent Address" class="form-control form-control-sm" id="inputPerAdd"></textarea>
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Nationality*
                        </label>
                        <div class="col-sm-8">
                          <select class="form-control form-control-sm" aria-label="Nationality">
                            <option value="1">Indian</option>
                            <option value="2">American</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mb-1">
                        <label class="col-sm-4 col-form-label-sm">Maritial
                          Status*
                        </label>
                        <div class="col-sm-8">
                          <select class="form-control form-control-sm" aria-label="Maritial Status">
                            <option value="1">Married</option>
                            <option value="2">Single</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mt-0">
                        <div class="col-md-12 d-flex align-items-center  justify-content-center">
                          <button type="submit" class="btn btn-sm btn-primary px-5">Update</button>
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
                        <button type="button" class="btn btn-tool">
                          <i class="fas fa-pencil-alt"></i>
                        </button>
                      </div>
                
                    </div>
                    <div class="card-body">
                <div class="p-d-form">

                  <form>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Employee
                        ID*
                      </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="inputEmpId">
                      </div>
                    </div>

                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Department*
                      </label>
                      <div class="col-sm-8">
                        <select class="form-control form-control-sm" aria-label="Department">
                          <option value="1">Indian</option>
                          <option value="2">American</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Designation*
                      </label>
                      <div class="col-sm-8">
                        <select class="form-control form-control-sm" aria-label="Designation">
                          <option value="1">Indian</option>
                          <option value="2">American</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Date of
                        Joining*
                      </label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control form-control-sm" id="inputDOJ">
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Date of
                        Leaving*
                      </label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control form-control-sm" id="inputDOL">
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Status
                      </label>
                      <div class="col-sm-8">
                        <select class="form-control form-control-sm" aria-label="Active">
                          <option value="1">Active</option>
                          <option value="2">Inactive</option>
                        </select>
                      </div>
                    </div>

                    <div class="row mt-0">
                      <div class="col-md-12 d-flex align-items-center  justify-content-center">
                        <button type="submit" class="btn btn-sm btn-primary px-5">Update</button>
                      </div>
                    </div>


</form>
                </div>
              </div>
              </div>
            </div>
            <div class="tab-pane fade" id="financial-details" role="tabpanel"
              aria-labelledby="financial-details-tab">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Financial Details</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool">
                          <i class="fas fa-pencil-alt"></i>
                        </button>
                      </div>
                
                    </div>
                    <div class="card-body">
                <div class="p-d-form">

                  <form>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Basic Salary
                      </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="basicSalary">
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">HRA
                      </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="HRA">
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">PF
                      </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="PF">
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-4 col-form-label-sm">Total
                      </label>
                      <div class="col-sm-8">
                        <div class="">1000</div>
                      </div>
                    </div>


                    <div class="row mt-0">
                      <div class="col-md-12 d-flex align-items-center  justify-content-center">
                        <button type="submit" class="btn btn-sm btn-primary px-5">Update</button>
                      </div>
                    </div>

</form>
                </div>
              </div>
              </div>
            </div>
            <div class="tab-pane fade" id="bank-details" role="tabpanel" aria-labelledby="bank-details-tab">

                 <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Bank Account Details</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool">
                          <i class="fas fa-pencil-alt"></i>
                        </button>
                      </div>
                
                    </div>
                    <div class="card-body">
                <div class="p-d-form">


                  <form>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Account
                        Holder Name
                      </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="inputAcholderName">
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Account
                        Number
                      </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="inputAccNumber">
                      </div>
                    </div>

                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Bank Name
                      </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="inputBankName">
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4 col-form-label-sm">Branch
                      </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="inputBranchName">
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-4 col-form-label-sm">IFSC Code
                      </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="inputIfscCode">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-12 d-flex align-items-center  justify-content-center">
                        <button type="submit" class="btn btn-sm btn-primary px-5">Update</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
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
      const route = useRoute()
      console.log(route)
      const employeeProfilePreview = () => {
        axios.get('/api/admin/get-employee-profile-data/'+route.params.id).then((response) => {
                      this.employee_profile = response.data;
                      console.log(this.employee_profile);                     
                }).catch((e) => {
                     console.log(e);
                });
      }
      onMounted(() => {
        const empId = route.params.id
        employeeProfilePreview()
        console.log(empId)
      })

    }

  };

</script>