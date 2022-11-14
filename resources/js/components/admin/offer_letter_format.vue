<template>
   <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="changeOfferLetterFormat" tabindex="-1" role="dialog" aria-labelledby="changeOfferLetterFormat" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">OFFER LETTER</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <textarea id="editor_description" name="editor_description" v-model="ckFieldsData.description"></textarea>
            <div v-if="errors.description" class="text-danger">{{ errors.description[0] }}</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="storeEmployeeOfferLatterDetails">Save changes</button>
        </div>
        </div>
    </div>
    </div>
    
</template>
<script>
import { ref, onMounted , reactive} from 'vue';
import Swal from 'sweetalert2'
import { useToastr } from '../../toastr.js';
import jQuery from "jquery";
const $ = jQuery;
let ckeditor;

export default {
    name: 'OfferLetterFormatComponent',
    props: ['employeeOfferLetterCon'],
    data() {
        return {
                
                ckFieldsData : {
                    'emp_id' : localStorage.getItem('emp_id'),
                    'title': 'offer_letter',
                    'description' : '',
                },
                errors:{},  
        } 
    },
    mounted() {
        ckeditor = window.CKEDITOR.replace("editor_description");
        //on event change  
        ckeditor.on('change',()=>{
            this.ckFieldsData.description = ckeditor.getData();
            //console.log(this.ckFieldsData.description);
        });
    },
    methods: {
        
        showOfferLetterModel(){
            $('#changeOfferLetterFormat').modal('show');
            ckeditor.setData(this.employeeOfferLetterCon);
            this.ckFieldsData.description =  this.employeeOfferLetterCon; 
        },
        storeEmployeeOfferLatterDetails(){  
            let userId = localStorage.getItem('emp_id');
            if((userId != '') && (userId != null)){ 
                axios.post('/api/store-employee-letter-datails',{ 'ckFieldsData':this.ckFieldsData }).then((response) => {
                    if(response.data.code == 'success'){
                        Swal.fire('Success!', 'Employee Offer Letter has been updated.', 'success');
                        $('#changeOfferLetterFormat').modal('hide');
                        this.$emit('callOfferLetterContent')
                    }else if(response.data.code == 'error_validate'){
                        this.errors = response.data.errors;
                    }
            
                }).catch((e) => {
                        console.log(e);
                        Swal.fire('Failed!','Something went wrong.', 'warning');
                });
            }
        },
    },
    
};
</script>
