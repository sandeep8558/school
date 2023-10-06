<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    props: {
        data:Object,
        errors: Object,
        branches: Object,
    },

    data: function () {
        return {
            isBranchForm: false,
            form : useForm({
                id: null,
                name: '',
                address: '',
                city: '',
                pincode: '',
                state: '',
                country: '',
                lng: '',
                lat: '',
                email: '',
                phone: '',
                curriculum: '',
            }),
            deleteForm: useForm({
                id: null
            }),
            accreditationForm: useForm({
                branch_id: null,
                title: null,
                media: null,
            }),
        };
    },

    methods: {

        addBranch(){
            this.form.post('/school_bootstrap/store_branch', {
                onFinish: data => {
                },
                onSuccess: () => {
                    this.form.reset();
                    this.isBranchForm = false;
                }
            });
        },

        editBranch(branch){
            this.form.id = branch.id;
            this.form.name = branch.name;
            this.form.address = branch.address;
            this.form.city = branch.city;
            this.form.state = branch.state;
            this.form.pincode = branch.pincode;
            this.form.country = branch.country;
            this.form.lng = branch.lng;
            this.form.lat = branch.lat;
            this.form.email = branch.email;
            this.form.phone = branch.phone;
            this.form.curriculum = branch.curriculum;

            this.isBranchForm = true;
            location.href = "#branchForm";
        },

        deleteBranch(id){
            this.$swal.fire({
                title: "Warning",
                text: "Do you want to delete this branch?",
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((e) => {
                if(e.isConfirmed){

                    this.deleteForm.id = id;

                    this.deleteForm.post('/school_bootstrap/delete_branch', {
                        onFinish: data => {
                            //this.form.reset();
                        }
                    });

                }
            });
        },

        deleteAccreditation(id){
            this.$swal.fire({
                title: "Warning",
                text: "Do you want to delete this accreditation file?",
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((e) => {
                if(e.isConfirmed){

                    this.deleteForm.id = id;

                    this.deleteForm.post('/school_bootstrap/delete_accreditation', {
                        onFinish: data => {
                            //this.form.reset();
                        }
                    });

                }
            });
        },

        showAccreditation(img, title){

            this.$swal.fire({
                title: title,
                html: "<img src='"+img+"' class='w-full'>",
                customClass: 'w-full sm:w-full md:w-3/5 lg:w-4/7 xl:w-1/2',
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false,
                showDenyButton: false,
            }).then((e) => {
                //console.log(e);
            });

        },

        showAccrodationForm(branch){
            this.$swal.fire({
                title: branch.name,
                html:
                '<div class="py-5">'+
                '<div class="relative">'+
                
                '<div for="title" class="w-full text-left mb-1">Title</div>'+
                '<input type="text" id="title" placeholder="" class="inp mb-5" />'+

                '<div for="media" class="w-full text-left mb-1">Document</div>'+
                '<input type="file" id="media" placeholder="" class="inp inp-file" />'+

                '</div>'+
                '</div>',
                confirmButtonText: 'Save Accreditation',
                showCancelButton: true,
                preConfirm: () => {

                    let file = null;
                    let target = document.getElementById('media');
                    if (target && target.files) {
                        file = target.files[0];
                    }
                    this.accreditationForm.branch_id = branch.id;
                    this.accreditationForm.title = document.getElementById('title').value;
                    this.accreditationForm.media = file;

                    this.$swal.showLoading();

                    this.accreditationForm.post('/school_bootstrap/save_accreditation',{
                        onSuccess: data => {
                            this.$swal.close();
                        },
                        onError: err => {
                            this.$swal.hideLoading();
                            this.$swal.showValidationMessage('Validation Failed');
                            throw new Error("Validation Failed");
                        }
                    });

                    return false;

                }

            });
        },

        showAlert(){
            this.$swal.fire({
                text: "Hi",
                showCancelButton: true,
                showConfirmButton: true,
                showDenyButton: true,
            }).then((e) => {
                //console.log(e);
            });
        },

    },

    created: function() {
        
    },

    mounted: function() {
        
    },

    components: { Administrator, Head, Link }
}
</script>

<template>
<Head title="Dashboard" />

<Administrator>

    <div class="box">

        <div>
            <img :src="$page.props.settings.logo" alt="" class="w-60">
        </div>

        <div class="w-full">
            <h1 class="text-4xl font-bold">{{ $page.props.settings.schoolName }}</h1>
            <hr class="my-3">
            <p class="text-xl">{{ $page.props.settings.tagLine }}</p>
            <p class="text-sm">{{ data.address }} {{ data.city }} {{ data.pincode }} {{ data.state }} {{ data.country }}</p>
            <p>{{ data.email }} | {{ data.phone }}</p>
            <hr class="my-3">
            <Link :href="'/settings'" class="btn btn-purple">Edit School Profile</Link>
        </div>
        
    </div>


    <div class="box py-6">
        
        <div class="w-full">

            <div class="mb-6 flex items-center">
                <h2 class="text-2xl font-bold w-full">Branches ({{ branches.length }})</h2>
                <div class="w-80">
                    <button class="btn float-right" :class="isBranchForm ? 'btn-red' : 'btn-orange'" @click="isBranchForm = !isBranchForm; form.reset();">
                        <span class="inline-block mr-3"> {{ isBranchForm ? 'X' : '+' }} </span>
                        <span>{{ isBranchForm ? 'Close Form' : 'Add New Branch' }}</span>
                    </button>
                </div>
            </div>

            

            <div v-if="isBranchForm" class="form-box bg-white" id="branchForm">

                <div class="w-full mb-5">
                    <h2 class="text-2xl font-bold uppercase py-6 text-left">Add Branch Here!</h2>
                </div>

                <div class="w-full mb-5">
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="peer floating-inp" v-model="form.name" placeholder="" />
                        <label for="floating_outlined" class="floating-lbl">Branch name</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.name }}</span>
                </div>

                <div class="w-full mb-5">
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="peer floating-inp"  v-model="form.address" placeholder="" />
                        <label for="floating_outlined" class="floating-lbl">Address</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.address }}</span>
                </div>

                <div class="w-full lg:w-1/2 mb-5">
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="peer floating-inp"  v-model="form.city" placeholder="" />
                        <label for="floating_outlined" class="floating-lbl">City</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.city }}</span>
                </div>

                <div class="w-full lg:w-1/2 mb-5">
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="peer floating-inp"  v-model="form.pincode" placeholder="" />
                        <label for="floating_outlined" class="floating-lbl">Pincode</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.pincode }}</span>
                </div>

                <div class="w-full lg:w-1/2 mb-5">
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="peer floating-inp"  v-model="form.state" placeholder="" />
                        <label for="floating_outlined" class="floating-lbl">State</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.state }}</span>
                </div>

                <div class="w-full lg:w-1/2 mb-5">
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="peer floating-inp"  v-model="form.country" placeholder="" />
                        <label for="floating_outlined" class="floating-lbl">Country</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.country }}</span>
                </div>

                <div class="w-full lg:w-1/2 mb-5">
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="peer floating-inp"  v-model="form.lng" placeholder="" />
                        <label for="floating_outlined" class="floating-lbl">Longitude</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.lng }}</span>
                </div>

                <div class="w-full lg:w-1/2 mb-5">
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="peer floating-inp"  v-model="form.lat" placeholder="" />
                        <label for="floating_outlined" class="floating-lbl">Latitude</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.lat }}</span>
                </div>

                <div class="w-full lg:w-1/2 mb-5">
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="peer floating-inp"  v-model="form.email" placeholder="" />
                        <label for="floating_outlined" class="floating-lbl">Email Address</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.email }}</span>
                </div>

                <div class="w-full lg:w-1/2 mb-5">
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="peer floating-inp"  v-model="form.phone" placeholder="" />
                        <label for="floating_outlined" class="floating-lbl">Phone Number</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.phone }}</span>
                </div>

                <div class="w-full mb-5">
                    <div class="relative">
                        <select id="floating_outlined" class="peer floating-inp"  v-model="form.curriculum" placeholder="">
                            <option value="">Select School Curiculam</option>
                            <option value="SSC">SSC</option>
                            <option value="CBSE">CBSE</option>
                            <option value="ICSE">ICSE</option>
                            <option value="IGCSE">IGCSE</option>
                            <option value="IB">IB</option>
                            <option value="NIOS">NIOS</option>
                        </select>
                        <label for="floating_outlined" class="floating-lbl">Curiculam</label>
                    </div>
                    <span v-if="errors" class="text-sm text-red-500">{{ errors.curriculum }}</span>
                </div>

                <div class="w-full">
                    <button :disabled="form.processing" @click="addBranch()" class="btn btn-purple disabled:btn-red">
                        {{ form.id == null ? 'Add School Branch' : 'Update School Branch' }}
                    </button>
                </div>

            </div>

            <hr class="my-6">


            <div v-for="branch in branches" :key="branch.id" class="w-full mb-5 pb-5 border-b last:pb-0 last:border-b-0">

                <div  class="flex space-x-10 items-center">
                    <div class="w-full">
                        <h1 class="text-xl font-bold">{{branch.name}} - {{ branch.curriculum }}</h1>
                        <p class="text-sm">{{branch.address}} {{branch.city}} {{branch.pincode}} {{branch.state}} {{branch.country}}</p>
                        <p>{{ branch.email }} | {{ branch.phone }}</p>
                    </div>
                    <div class="w-80 text-right">
                        
                        <button @click="showAccrodationForm(branch)" class="btn btn-purple px-2 mr-1">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                <path fill="currentColor" d="M11.045 7.514a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm-4.572 3.072L3.857 15.92h7.949l-1.811-3.37-1.61 2.716-1.912-4.679Z"/>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 1v4a1 1 0 0 1-1 1H1m14 12a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v16ZM11.045 7.514a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM3.857 15.92l2.616-5.333 1.912 4.68 1.61-2.717 1.81 3.37H3.858Z"/>
                            </svg>
                        </button>

                        <button @click="editBranch(branch)" class="btn btn-orange px-2 mr-1">
                            <svg class="w-4 h-4 stroke-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279"/>
                            </svg>
                        </button>

                        <button @click="deleteBranch(branch.id)" class="btn btn-red px-2">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                            </svg>
                        </button>
                    </div>
                    
                </div>

                <div class="w-full flex space-x-3 mt-3">
                    <div v-for="acc in branch.accreditations" :key="branch.id + '_' + acc.id" class="group w-auto shadow-md border relative">
                        <img  :src="acc.media" class="h-28 cursor-pointer transition-all duration-200 hover:scale-110" @click="showAccreditation(acc.media, acc.title)">
                        <button @click="deleteAccreditation(acc.id)" class="group-hover:block hidden absolute right-0 top-0 btn btn-gray p-2 opacity-90">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                            </svg>
                        </button>
                        
                    </div>
                    
                </div>

            </div>
            

        </div>


    </div>


</Administrator>
</template>