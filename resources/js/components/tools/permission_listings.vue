<template>
	<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Permission</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <router-link to="/dashboard">Dashboard</router-link>
            </li>
            <li class="breadcrumb-item active">Permission</li>
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
                          <input type="text" name="table_search" v-model="search_field" class="form-control form-control-sm float-right" placeholder="Search" @keyup="searchRecord()">
                          <div class="input-group-append">
                             <button type="button" class="btn btn-default" @click="searchRecord()">
                             <i class="fas fa-search"></i>
                             </button>
                          </div>
                       </div>
                    </div>
                    <button style="float: right; margin-left: 5px;" type="button" class="btn btn-primary pull-right btn-gradient" v-on:click="addPermissionModel()" >
                        <i class="fas fa-plus"></i> Add Permission
                    </button>
                 </div>
                 <div class="card-body table-responsive p-0" >
                    <table class="table table-sm table-striped small">
                       <thead>
                          <tr class="bg-primary">
                             <th>#</th>
                             <th>Name</th>
                             <th>Created At</th>
                             <th style="width:220px">Action</th>
                          </tr>
                       </thead>
                       <tbody>
                        <!-- {{ permissionDataArr }} -->
                          <tr v-for="(permissionData,index) in permissionDataArr">
                             <td>{{ ((current_page - 1)*10) + (index + 1) }}</td>
                             <td>{{ permissionData.name }}</td>
                             <td>{{ permissionData.created_at }}</td>
                             <td>
                                <div class="btnGroup" v-on:click="editPermissionModel(permissionData)">
                                    <a href="#" class="btn btn-sm btn-primary py-0 px-1"><i class="fas fa-pencil-alt"></i> </a>
                                </div>
                                
                              </td>  
                          </tr>
                       </tbody>
                    </table>
                 </div>
                 <hr class="my-0">
                 <div class="card-footer py-1 clearfix d-flex justify-content-between align-items-center">
                    <div class="tableShowList small">
                       Showing <span>{{ permissionDataArr.length }}</span> of <span>{{totalRecord}}</span> Entries
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
            <!-- Modal -->
            <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="moduleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="moduleModalLabel" v-if="editMode">Edit Permission</h5>
                            <h5 class="modal-title" id="moduleModalLabel" v-else >Add Permission</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form @submit.prevent="createPermissionModule()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input v-model="form.name" type="text" name="name" id="name" class="form-control" placeholder="Name">
                                    <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" v-if="editMode" >Update</button>
                                <button type="submit" class="btn btn-primary" v-else>Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End /-->
           
     </div>
     <!--container-fluid-->
  </section>
</template>
<script>
    import jQuery from "jquery";
    const $ = jQuery;
</script>
<script setup>

  import { ref, onMounted , reactive} from 'vue';
  import Swal from 'sweetalert2'
  
  const permissionDataArr = ref({});
  const pagination_data = ref({});
  const totalRecord = ref(0);
  const current_page = ref(1);
  const show_records = ref(10);
  const last_page = ref('');
  const editMode = ref(false);
  const errors = ref('');
  const search = ref('');
  const search_field = ref('');
  
  const form = reactive({
        id:'',
        name: '',
  });
  const addPermissionModel = () => {
        form.id = "";
        form.name = "";
        $("#permissionModal").modal('show');
        editMode.value = false;
  }
  const editPermissionModel = (data) => {
        form.id = data.id;
        form.name = data.name;
        $("#permissionModal").modal('show');
        editMode.value = true;
  }
  const createPermissionModule = () => {
        //$("#permissionModal").modal('show');
        errors.value = '';
		axios.post('/api/permissions',form).then((response) => {
          if(response.data.code == 'success'){
            Swal.fire({
                  title: 'Data Saved!',
                  text: "Permission has been saved!",
                  icon: 'success',
                  allowOutsideClick: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ok'
                }).then((result) => {
                    form.id = "";
                    form.name = "";
                    getPermission();
                    $("#permissionModal").modal('hide');

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

  const getPermission = () => {
        pageURL('/api/get-permission/');
  }
  const showRecord = (event) => {
        show_records.value = event.target.value;
        getPermission();
  }
  const searchRecord = () => {
        console.log(search_field.value);
        search.value = search_field.value;
        getPermission();
  }
  const pageURL = (url) => {
        let params = { "current_page": current_page.value, "show_records": show_records.value, "search": search.value};
        axios.post(url,{ params : params}).then((response) => {
            if(response.data.code == 'success'){
               permissionDataArr.value   = response.data.permission.data; 
               last_page.value    = response.data.permission.last_page;
               pagination_data.value   = response.data.permission; 
               totalRecord.value  = response.data.permission.total;
               current_page.value = response.data.permission.current_page;
            }
        
        }).catch((e) => {
            console.log(e);
            // Swal.fire('Failed!','Something went wrong.', 'warning');
        });
  }
  
  onMounted (() => {
    getPermission();
     
  });

</script>