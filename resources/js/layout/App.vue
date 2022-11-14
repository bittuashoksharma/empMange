<template>
  <div v-if="$store.getters.getToken">
      <header-component></header-component>
      <aside class="main-sidebar sidebar-dark-primary shadow-sm ">
        <router-link to="/" class="brand-link bg-white py-2">
          <img src="/images/new_logo.png" alt="ECRM Logo" class=" img-fluid " width="104" style="opacity: .8;min-width:104px">
        </router-link>
        <div class="sidebar">
              <sidebar-component></sidebar-component>
        </div> 
      </aside>
      <div class="content-wrapper">
        <router-view></router-view>
      </div>
      <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">  </div>
        <strong>Copyright &copy; 2022 <a href="#">ECRM</a>. </strong> All rights reserved.
      </footer>
  </div>
  <div v-else>
    <router-view></router-view>
  </div> 
</template>