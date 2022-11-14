<template>
   <div class="content-header bg-white shadow-sm py-2 mb-4">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-6">
               <h5 class="m-0 font-weight-bold">Dashboard</h5>
            </div>
            <!--div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                 <li class="breadcrumb-item active">Dashboard</li>
               </ol>
               </div-->
         </div>
      </div>
   </div>
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
               <div class="info-box">
                  <span class="info-box-icon bg-primary"><i class="fas fa-users"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text">Total Employees : {{ totalEmployeeCount }}</span>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
               <div class="info-box">
                  <span class="info-box-icon bg-primary"><i class="fas fa-code-branch"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text">Total Deptt : 0</span>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
               <div class="info-box">
                  <span class="info-box-icon bg-primary"><i class="fas fa-hand-paper"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text">Present Today : 0</span>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
               <div class="info-box">
                  <span class="info-box-icon bg-primary"><i class="fas fa-bed"></i></span>
                  <div class="info-box-content">
                     <span class="info-box-text">On Leave Today : 0</span>
                  </div>
               </div>
            </div>
            <div class="col-md-8 col-sm-8 col-8">
               <div class="card card-primary card-outline">
                  <div class="card-header">
                     <h5 class="card-title m-0">Daily Quotes</h5>
                  </div>
                  <div class="card-body">
                     <!-- <h6 class="card-title">Special title treatment</h6> -->
                     <p class="card-text">Your time is limited, so don't waste it living someone else's life. Don't be trapped by dogma – which is living with the results of other people's thinking. -Steve Jobs</p>
                     <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-4 col-4">
               <div class="card card-primary card-outline">
                  <div class="card-header">
                     <h5 class="card-title m-0">Activity Log</h5>
                  </div>
                  <div class="card-body">
                     <!-- <h6 class="card-title">Special title treatment</h6> -->
                     <!--  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                     <a href="#" class="btn btn-primary">View Activity Logs</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>
<script setup>
   import { ref, onMounted , reactive} from 'vue';
   import Swal from 'sweetalert2'
   
   
   
   const totalEmployeeCount = ref(0);
   
   
   const getTotalEmployee = () => {
         axios.post('/api/get-total-employee-count').then((response) => {
             if(response.data.code == 'success'){
   
                totalEmployeeCount.value = response.data.totalEmployeeCount;
             }
         
         }).catch((e) => {
             console.log(e);
             // Swal.fire('Failed!','Something went wrong.', 'warning');
         });
   }
   
   
   onMounted (() => {
       getTotalEmployee();
      
   });
   
</script>