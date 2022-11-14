<template>
	<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Roles</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <router-link to="/dashboard">Dashboard</router-link>
            </li>
            <li class="breadcrumb-item active">Roles</li>
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
                    <button style="float: right; margin-left: 5px;" type="button" class="btn btn-primary pull-right btn-gradient" v-on:click="addRolePermissionModel()" >
                        <i class="fas fa-plus"></i> Add Role
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
                          <tr v-for="(roleData,index) in roleDataArr">
                             <td>{{ ((current_page - 1)*10) + (index + 1) }}</td>
                             <td>{{ roleData.label }}</td>
                             <td>{{ roleData.created_at }}</td>
                             <td>
                                <div class="btnGroup">
                                    <a href="#" class="btn btn-sm btn-primary py-0 px-1 mr-2" v-on:click="editRolePermissionModel(roleData)"><i class="fas fa-pencil-alt"></i> </a>
                                    <a href="#" class="btn btn-sm btn-danger py-0 px-1" v-on:click="deleteRolePermission(roleData.id)"><i class="fas fa-trash-alt"></i> </a>
                                </div>
                             </td>  
                          </tr>
                       </tbody>
                    </table>
                 </div>
                 <hr class="my-0">
                 <div class="card-footer py-1 clearfix d-flex justify-content-between align-items-center">
                    <div class="tableShowList small">
                       Showing <span>{{ roleDataArr.length }}</span> of <span>{{totalRecord}}</span> Entries
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
            <div class="modal fade" id="rolePermissionModal" tabindex="-1" role="dialog" aria-labelledby="moduleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="moduleModalLabel">{{ editMode ? 'Edit' : 'Add' }} Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form @submit.prevent="editMode ? updateRolePermissionModule() : createRolePermissionModule()" >
                            <div class="modal-body">
                                <!-- Alert -->
                                
                                <div class="form-group">
                                    <input v-model="form.label" type="text" name="label" id="label"
                                    class="form-control" placeholder="Label" @keyup="makeRoleName($event)">
                                    <div v-if="errors.label" class="text-danger">{{ errors.label[0] }}</div>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.name" type="text" name="name" id="name"
                                    class="form-control"  placeholder="alias">
                                    <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
                                </div>
                                <h5 class="p-1 pl-3 mb-2 bg-primary text-white row">Permission</h5>
                                    
                                <div v-if="permissionDataInfo">
                                    <div class="row">
                                        <div class="col-md-4" v-for="(option, perKey) in permissionDataInfo" >
                                            <div class="form-group">
                                                <input type="checkbox" @change="updatePermission(option.name, perKey)" :name="`permissions[]`" :value="option.name" :id="`permission-${option.name}`" :checked="getCheckedValue(option.name)">
                                                <label :for="`permission-${option.name}`" >{{ option.name }}</label>
                                            </div>
                                        </div>
                                        <div v-if="errors.permissions" class="text-danger">{{ errors.permissions[0] }}</div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-gradient" v-if="editMode" >Update</button>
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
  
  const roleDataArr = ref({});
  const permissionDataInfo = ref({});
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
        label:'',
        name: '',
        permissions:[],
  });

  
  const makeRoleName = (event) => {
        let roleLable = event.target.value;
        if (editMode.value == false){
            if (roleLable == '') {
                form.name = "";
            }
            if (roleLable != '' && /\S/.test(roleLable)) {
                form.name = roleLable.split(" ").join("-").toLowerCase();
            }
        }
  }

             
  const deleteRolePermission = (id) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                axios.post(`/api/delete-roles/{id}`).then(({data})=>{
                    console.log(data);
                    if(data.status == "success"){
                        getRoleListing();
                        Swal.fire('Deleted!', 'Role has been deleted.', 'success')
                    }else{
                        Swal.fire('Failed!', 'Something went wrong.', 'warning')
                    }
                    
                }).catch(({data})=>{
                    Swal.fire('Failed!', 'Something went wrong.', 'warning')
                    
                });
            }
        })
  }
  const getCheckedValue = (permission) => {
        return form.permissions.includes(permission);
  }
  const updatePermission = (permission, key) => {
        var index = form.permissions.indexOf(permission);
        if (index !== -1) {
            form.permissions.splice(index, 1);
        } else {
            form.permissions.push(permission);
        }
        console.log(form.permissions);
  }
  const addRolePermissionModel = () => {
        form.id = "";
        form.label = "";
        form.name = "";
        form.permissions = [];
        $("#rolePermissionModal").modal('show');
        editMode.value = false;
  }
  const editRolePermissionModel = (data) => {
        form.id = data.id;
        form.name = data.name;
        form.label = data.label;
        form.permissions = data.permissions.map((permission) => {
                return permission.name
        });
        $("#rolePermissionModal").modal('show');
        editMode.value = true;
  }
  const createRolePermissionModule = () => {
        //$("#permissionModal").modal('show');
        errors.value = '';
		axios.post('/api/roles',form).then((response) => {
          if(response.data.code == 'success'){
            Swal.fire({
                  title: 'Data Saved!',
                  text: "Role Permission has been saved!",
                  icon: 'success',
                  allowOutsideClick: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ok'
                }).then((result) => {
                    form.id = "";
                    form.label = "";
                    form.name = "";
                    form.permissions = [];
                    getRoleListing();
                    $("#rolePermissionModal").modal('hide');

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
  const updateRolePermissionModule = () => {
        //$("#permissionModal").modal('show');
        errors.value = '';
		axios.post('/api/roles-permission-update',form).then((response) => {
          if(response.data.code == 'success'){
            Swal.fire({
                  title: 'Data Saved!',
                  text: "Role Permission has been update successfully!",
                  icon: 'success',
                  allowOutsideClick: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ok'
                }).then((result) => {
                    form.id = "";
                    form.label = "";
                    form.name = "";
                    form.permissions = [];
                    getRoleListing();
                    $("#rolePermissionModal").modal('hide');

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
  const getRoleListing = () => {
        pageURL('/api/get-role-listing/');
  }
  const showRecord = (event) => {
        show_records.value = event.target.value;
        getRoleListing();
  }
  const searchRecord = () => {
        console.log(search_field.value);
        search.value = search_field.value;
        getRoleListing();
  }
  const pageURL = (url) => {
        let params = { "current_page": current_page.value, "show_records": show_records.value, "search": search.value};
        axios.post(url,{ params : params}).then((response) => {
            if(response.data.code == 'success'){
               roleDataArr.value   = response.data.roles.data; 
               last_page.value    = response.data.roles.last_page;
               pagination_data.value   = response.data.roles; 
               totalRecord.value  = response.data.roles.total;
               current_page.value = response.data.roles.current_page;
            }
        
        }).catch((e) => {
            console.log(e);
            // Swal.fire('Failed!','Something went wrong.', 'warning');
        });
  }
  
  const getPermissionList = () => {
        axios.post('/api/get-permission-list').then((response) => {
            if(response.data.code == 'success'){
               permissionDataInfo.value   = response.data.permission; 
            }
        
        }).catch((e) => {
            console.log(e);
            // Swal.fire('Failed!','Something went wrong.', 'warning');
        });
  }
  onMounted (() => {
    getRoleListing();
    getPermissionList();
    
     
  });

</script>