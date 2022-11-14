<template>
	<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Employees</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <router-link to="/dashboard">Dashboard</router-link>
            </li>
            <li class="breadcrumb-item active">Employees</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
     <div class="container-fluid">
        <div class="row">
           <div class="col-12">
              <div class="card">
                 <div class="card-header py-1 small d-flex align-items-center d-flex justify-content-between align-items-center">
                    <div class="tableShowData d-flex justify-content-between align-items-center">
                       <span>Show</span> 
                       <select class="form-control form-control-sm mx-2" name="" id="select_show_page" @change="showRecord($event)" style="width:70px">
                          <option value="10">10</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="40">40</option>
                       </select>
                       <span>Employees</span>
                    </div>
                    <div class="card-tools ml-auto mr-0">
                       <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="table_search" class="form-control form-control-sm float-right" placeholder="Search">
                          <div class="input-group-append">
                             <button type="submit" class="btn btn-default">
                             <i class="fas fa-search"></i>
                             </button>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="card-body table-responsive p-0" >
                    <table class="table table-sm table-striped small">
                       <thead>
                          <tr class="bg-primary">
                             <th>#</th>
                             <th>Name</th>
                             <th>Age</th>
                             <th>Email ID</th>
                             <th>Department</th>
                             <th>Designation</th>
                             <th>Status</th>
                             <th style="width:220px">Action</th>
                          </tr>
                       </thead>
                       <tbody>
                        <!-- {{ employeesDataArr }} -->
                          <tr v-for="(employeesData,index) in employeesDataArr">
                             <td>{{ ((current_page - 1)*10) + (index + 1) }}</td>
                             <td>{{ employeesData.name }}</td>
                             <td><span v-if="employeesData.employee_personal_info != null">{{ employeesData.employee_personal_info.age }}</span> </td>
                             <td>{{ employeesData.email }}</td>
                             <td>
                              <span v-if="(employeesData.employee_company_info != null)">
                                 <span v-if="(employeesData.employee_company_info.emp_department_info != null)">
                                    {{ employeesData.employee_company_info.emp_department_info.name }}
                                 </span>
                                 <span v-else>-</span> 
                              </span>
                              <span v-else>-</span> 
                              
                             </td>
                             <td> 
                              <span v-if="(employeesData.employee_company_info != null)">
                                 <span v-if="(employeesData.employee_company_info.emp_designation_info != null)">
                                 {{ employeesData.employee_company_info.emp_designation_info.name }}
                                 </span>
                                 <span v-else>-</span>
                              </span>
                              <span v-else>-</span>                            
                              
                            </td>
                             <td><span class="badge bg-success">Approved</span></td>
                             <td>
                                <div class="btnGroup">
                                 <router-link :to="{ name: 'profile-view', params: { id: employeesData.encrypt_id }}" class="btn btn-sm btn-warning py-0 px-1">
                                    <i class="far fa-eye"></i></router-link>
                                   <!-- <a href="/employee/profile-view/" class="btn btn-sm btn-warning py-0 px-1"><i class="far fa-eye"></i> </a> -->
                                   <a href="javascript:void(0)" v-on:click = "editEmployee(employeesData.id)" class="btn btn-sm btn-primary py-0 px-1"><i class="fas fa-pencil-alt"></i> </a>
                                   <a href="#" class="btn btn-sm btn-danger py-0 px-1"><i class="fas fa-trash-alt"></i> </a>
                                   <div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
                                      <label class="btn btn-success py-0 px-1 active">
                                      <input type="radio" name="options" id="option1" checked> Active
                                      </label>
                                      <label class="btn btn-success py-0 px-1">
                                      <input type="radio" name="options" id="option2"> Deactive
                                      </label>
                                   </div>
                                </div>
                              </td>  
                          </tr>
                       </tbody>
                    </table>
                 </div>
                 <hr class="my-0">
                 <div class="card-footer py-1 clearfix d-flex justify-content-between align-items-center">
                    <div class="tableShowList small">
                       Showing <span>{{ employeesDataArr.length }}</span> of <span>{{totalRecord}}</span> Entries
                    </div>
                     <div class="float-right">
                     <span>
                       <pagination :pagination="pagination_data" :current_page="current_page" :last_page="last_page" @pageURL="pageURL"></pagination>
                     </span>
                   </div>

                 </div>
              </div>
           </div>
        </div>
     </div>
     <!--container-fluid-->
  </section>
</template>
<script setup>

  import { ref, onMounted , reactive} from 'vue';
  import Swal from 'sweetalert2'
  import { useRoute, useRouter } from 'vue-router'
  const route = useRoute()
  const router = useRouter()
  const employeesDataArr = ref({});
  const pagination_data = ref({});
  const totalRecord = ref(0);
  const current_page = ref(1);
  const show_records = ref(10);
  const last_page = ref('');
  
  
  const getEmployees = () => {
        pageURL('/api/get-employees/');
  }
  const showRecord = (event) => {
        show_records.value = event.target.value;
        getEmployees();
  }

  const pageURL = (url) => {
        let params = { "current_page": current_page.value, "show_records": show_records.value};
        axios.post(url,{ params : params}).then((response) => {
            if(response.data.code == 'success'){
               employeesDataArr.value   = response.data.employees.data; 
               last_page.value    = response.data.employees.last_page;
               pagination_data.value   = response.data.employees; 
               totalRecord.value  = response.data.employees.total;
               current_page.value = response.data.employees.current_page;
            }
        
        }).catch((e) => {
            console.log(e);
            // Swal.fire('Failed!','Something went wrong.', 'warning');
        });
  }
  const editEmployee = (id) => {
   console.log(id);
   router.push({ name: 'personal-detail', params: { id: btoa(id) } })
  }
  onMounted (() => {
      getEmployees();
     
  });

</script>