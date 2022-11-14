import { createRouter, createWebHistory } from 'vue-router';

import EmployeesDashboard from '@/components/employee/Dashboard.vue'
import ProfileView from '@/components/employee/profileView.vue'

export default [
    {
		path:'/emp/dashboard',
		name:'emp_dashboard',
		component:EmployeesDashboard,
		meta: {
	    	requiresAuth: true,
	    	title: 'Employee Dashboard',
	    	role: 3
	    }
		
	},
	{
		path:'/emp/profile',
		name:'emp_profile',
		component:ProfileView,
		meta: {
	    	requiresAuth: true,
	    	title: 'Employee Profile',
	    	role: 3
	    }
		
	},
]