<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    props: {
        errors: Object,
        houses: Object,
    },

    data: function () {
        return {
            isForm: false,
            form: useForm({
                branch_id: this.$page.props.gbranch ? this.$page.props.gbranch.id : null,
                id: null,
                name: null,
            }),
        };
    },

    methods: {

        save(){
            this.form.post('/branch_bootstrap/save_house', {
                onSuccess: data => {
                    if(this.form.id != null){
                        this.isForm = false;
                    }
                    this.form.reset();
                }
            });
        },

        editRow(house){
            this.form.id = house.id;
            this.form.name = house.name;
            this.isForm = true;
        },

        deleteRow(house){

            this.$swal.fire({
                title: "Warning",
                text: "Do you want to delete this house?",
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((e) => {
                if(e.isConfirmed){

                    this.form.id = house.id;
                    this.form.name = house.name;

                    this.form.post('/branch_bootstrap/delete_house', {
                        onSuccess: data => {
                            this.form.reset();
                        }
                    });

                }
            });

        },

    },

    mounted: function() {
    },

    components: { Administrator, Head, Link }
}
</script>

<template>

    <Head title="Home Manager" />

    <Administrator>

        <div class="box">

            <div class="w-full">

                <div class="mb-6 flex items-center">
                    <h2 class="text-2xl font-bold w-full">House Manager</h2>
                    <div class="w-80">
                        <button class="btn float-right" :class="isForm ? 'btn-red' : 'btn-orange'" @click="isForm = !isForm;">
                            <span class="inline-block mr-3"> {{ isForm ? 'X' : '+' }} </span>
                            <span>{{ isForm ? 'Close Form' : 'Add House' }}</span>
                        </button>
                    </div>
                </div>

                <div v-if="isForm" class="form-box bg-white" id="branchForm">

                    <div class="w-full mb-5">
                        <h2 class="text-2xl font-bold uppercase py-6 text-left">Add House Here!</h2>
                    </div>

                    <div class="w-full mb-5">
                        <div class="relative">
                            <select id="floating_outlined" class="peer floating-inp" v-model="form.branch_id" placeholder="" :readonly="true">
                                <template v-if="$page.props.gbranch != null">
                                    <option :value="$page.props.gbranch.id">{{ $page.props.gbranch.name }}</option>
                                </template>
                            </select>
                            <label for="floating_outlined" class="floating-lbl">Branch</label>
                        </div>
                        <span v-if="errors" class="text-sm text-red-500">{{ errors.branch_id }}</span>
                    </div>
                    

                    <div class="w-full mb-5">
                        <div class="relative">
                            <input type="text" id="floating_outlined" class="peer floating-inp" v-model="form.name" placeholder="" />
                            <label for="floating_outlined" class="floating-lbl">House Name</label>
                        </div>
                        <span v-if="errors" class="text-sm text-red-500">{{ errors.name }}</span>
                    </div>

                    <div class="w-full">
                        <button :disabled="form.processing" @click="save()" class="btn btn-purple disabled:btn-red">
                            {{ form.id == null ? 'Add House' : 'Update House' }}
                        </button>
                    </div>

                </div>

                <hr class="">

                <div v-for="house in houses" :key="house.id" class="w-full p-6 odd:bg-gray-200 border rounded-md shadow-sm">

                    <div  class="flex space-x-10 items-center">
                        <div class="w-full">
                            <h1 class="text-xl font-bold">{{house.name}}</h1>
                        </div>
                        <div class="w-80 text-right">

                            <button @click="editRow(house)" class="btn btn-orange px-2 mr-1">
                                <svg class="w-4 h-4 stroke-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279"/>
                                </svg>
                            </button>

                            <button @click="deleteRow(house)" class="btn btn-red px-2">
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
