<template>
    <ul id="progressbar">

        <router-link :to="'/employee/personal-detail/' + empID" v-if="(step_completed >= 1)"><li class="personal_detail  " :class="[(setup == 1 ?'onProgress':''),(step_completed >= 1 ?'active':'')]"><strong>Personal Detail</strong></li></router-link>
        <li class="personal_detail" v-else :class="[(setup == 1 ?'onProgress':''),(step_completed >= 1 ?'active':'')]"><strong>Personal Detail</strong></li>


        <router-link :to="'/employee/company-detail/' + empID" v-if="(step_completed >= 2)"><li class="company_detail" :class="[(setup == 2 ?'onProgress':''),(step_completed >= 2 ?'active':'')]"><strong>Company Detail</strong></li></router-link>
        <li class="company_detail"  v-else :class="[(setup == 2 ?'onProgress':''),(step_completed >= 2 ?'active':'')]"><strong>Company Detail</strong></li>


        <router-link :to="'/employee/financial-detail/' + empID" v-if="(step_completed >= 3)"><li class="financial_detail" :class="[(setup == 3 ?'onProgress':''),(step_completed >= 3 ?'active':'')]"><strong>Financial Detail</strong></li></router-link>
        <li class="financial_detail" v-else :class="[(setup == 3 ?'onProgress':''),(step_completed >= 3 ?'active':'')]"><strong>Financial Detail</strong></li>

        <router-link :to="'/employee/documents-detail/' + empID" v-if="(step_completed >= 4)"><li class="document_detail " :class="[(setup == 4 ?'onProgress':''),(step_completed >= 4 ?'active':'')]"><strong>Document Detail</strong></li></router-link>
        <li class="document_detail " v-else :class="[(setup == 4 ?'onProgress':''),(step_completed >= 4 ?'active':'')]"><strong>Document Detail</strong></li>

    </ul>
    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</template>
<script>
export default {
  name: 'ProgressbarComponent',
  props: ['setup','step_completed', 'empID'],
};
</script>