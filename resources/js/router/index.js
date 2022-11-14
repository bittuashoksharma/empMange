import { createRouter, createWebHistory } from 'vue-router';

import dashboard from '@/components/Dashboard.vue';
import ManageEmployees from '@/components/admin/manage_employees.vue';
import PersonalDetail from '@/components/admin/employee_personal_details.vue';
import CompanyDetail from '@/components/admin/employee_company_details.vue';
import FinancialDetail from '@/components/admin/employee_financial_details.vue';
import BankAccountDetail from '@/components/admin/employee_bank_account_details.vue';
import DocumentsDetail from '@/components/admin/employee_documents_details.vue';
import EmployeeProfileView from '@/components/admin/employee_profile_view.vue';
import Login from '@/components/auth/Login.vue';
import ForgetPassword from '@/components/auth/ForgetPassword.vue';
import ResetPassword  from '@/components/auth/ResetPassword.vue'

import OfferLetterDetail from '@/components/setting/offer_latter.vue';
import PermissionListing from '@/components/tools/permission_listings.vue';
import RoleListing from '@/components/tools/role_listings.vue';
import NotFound from '@/components/NotFound.vue';
import store from '../store';
import EmployeeRoutes from './employeeRoutes';


const routes = [
	{
		path:'/dashboard',
		name:'dashboard',
		component:dashboard,
		meta: {
	    	requiresAuth: true,
	    	title: 'dashboard',
	    	role: 2
	    }
		
	},
	
	{
		path:'/employees',
		name:'manage-employees',
		component:ManageEmployees,
		meta: {
	    	requiresAuth: true,
	    	title: 'manage-employees',
	    	role: 2
	    },
	},
	{
		path:'/employee/personal-detail/:id?',
		name:'personal-detail',
		component:PersonalDetail,
		meta: {
	    	requiresAuth: true,
	    	title: 'personal-detail',
	    	role: 2
	    },
	},
	{
		path:'/employee/company-detail/:id',
		name:'company-detail',
		component:CompanyDetail,
		meta: {
	    	requiresAuth: true,
	    	title: 'company-detail',
	    	role: 2
	    },
	},
	{
		path:'/employee/financial-detail/:id',
		name:'financial-detail',
		component:FinancialDetail,
		meta: {
	    	requiresAuth: true,
	    	title: 'financial-detail',
	    	role: 2
	    },
	},
	{
		path:'/employee/bank-account-detail/:id',
		name:'bank-account-detail',
		component:BankAccountDetail,
		meta: {
	    	requiresAuth: true,
	    	title: 'bank-account-detail',
	    	role: 2
	    },
	},
	{
		path:'/employee/documents-detail/:id',
		name:'documents-detail',
		component:DocumentsDetail,
		meta: {
	    	requiresAuth: true,
	    	title: 'documents-detail',
	    	role: 2
	    },
	},
	{
		path:'/permission-listing',
		name:'permission-listing',
		component:PermissionListing,
		meta: {
	    	requiresAuth: true,
	    	title: 'permission-listing',
	    	role: 2
	    },
	},
	{
		path:'/role-listing',
		name:'role-listing',
		component:RoleListing,
		meta: {
	    	requiresAuth: true,
	    	title: 'role-listing',
	    	role: 2
	    },
	},
	{
		path:'/setting/offer-letter',
		name:'setting-offer-letter',
		component:OfferLetterDetail,
		meta: {
	    	requiresAuth: true,
	    	title: 'setting-offer-letter',
	    	role: 2
	    },
	},
	

	{
		path:'/employee/profile-view/:id',
		name:'profile-view',
		component:EmployeeProfileView,
		meta: {
	    	requiresAuth: true,
	    	title: 'profile-view',
	    	role: 2
	    },
	},
	{
		path:'/login',
		name:'login',
		component:Login,
		meta: {
	    	requiresAuth: false,
	    	title: 'login',
	    	role: -1
	    },
	},
	{
		path:'/',
		name:'base',
		component:Login,
		meta: {
	    	requiresAuth: false,
	    	title: 'login',
	    	role: -1
	    },
	},
	
	{
		path:'/forget-password',
		name:'forgetPassword',
		component:ForgetPassword,
		meta: {
	    	requiresAuth: false,
	    	title: 'Forget Password',
	    	role: -1
	    },
	},
	{
		path:'/reset-password/:token',
		name:'resetPassword',
		component:ResetPassword,
		meta: {
	    	requiresAuth: false,
	    	title: 'Reset Password',
	    	role: -1
	    },
	},

	{
	  path: '/:pathMatch(.*)*',
	  name: 'not_found',
	  component: NotFound,
	},
	...EmployeeRoutes
]
const router = createRouter({
	history: createWebHistory(),
	routes,

}); 

router.beforeEach((to, from) => {
	// if(store.getters.getToken && store.getters.getUrid && to.meta.role !== store.getters.getUrid){
	// 	return { name : 'not_found'}
	// }
	if(to.meta.requiresAuth && store.getters.getToken == 0){
		return {name: 'login'}
	}
	if(to.meta.requiresAuth == false && store.getters.getToken !=0){
		if (store.getters.getUrid == 2) {
			return { name : 'dashboard'}
		}else{
           return { name : 'emp_dashboard'}
		}
	}
})
export default router;