<script>
import Student from '@/Layouts/Student.vue';
import { Head, useForm } from '@inertiajs/vue3';

import Text from '@/Components/Form/Text.vue';
import Select from '@/Components/Form/Select.vue';
import Date from '@/Components/Form/Date.vue';
import Image from '@/Components/Form/Image.vue';
import Radio from '@/Components/Form/Radio.vue';

import Razorpay from '@/Components/Razorpay.vue';


export default {

    components: { Head, Student, Text, Select, Date, Image, Radio, Razorpay },

    props: {
        isAdmission: String,
        branches: Object,
        msg: String,
        fee: Object,
    },

    data: function () {
        return {
            allBranches: [],
            allAcademicYears: [],
            allGrades: [],

            boards: [
                {key: 'SSC', val: 'SSC'},
                {key: 'CBSE', val: 'CBSE'},
                {key: 'ICSE', val: 'ICSE'},
                {key: 'IGCSE', val: 'IGCSE'},
                {key: 'IB', val: 'IB'},
                {key: 'NIOS', val: 'NIOS'},
            ],

            genders: [
                {key: 'Male', val: 'Male'},
                {key: 'Female', val: 'Female'},
                {key: 'Other', val: 'Other'},
            ],

            blood_groups: [
                {key: 'O +ve', val: 'O +ve'},
                {key: 'O -ve', val: 'O -ve'},
                {key: 'A +ve', val: 'A +ve'},
                {key: 'A -ve', val: 'A -ve'},
                {key: 'B +ve', val: 'B +ve'},
                {key: 'B -ve', val: 'B -ve'},
                {key: 'AB +ve', val: 'AB +ve'},
                {key: 'AB -ve', val: 'AB -ve'},
                {key: 'HH', val: 'HH'},
                {key: 'Other', val: 'Other'},
            ],

            religions: [
                {key: 'Hindu', val: 'Hindu'},
                {key: 'Muslim', val: 'Muslim'},
                {key: 'Christian', val: 'Christian'},
                {key: 'Sikh', val: 'Sikh'},
                {key: 'Buddhist', val: 'Buddhist'},
                {key: 'Jain', val: 'Jain'},
                {key: 'Atheist', val: 'Atheist'},
                {key: 'Other', val: 'Other'},
            ],

            cast_categories: [
                {key: 'General Category', val: 'General Category'},
                {key: 'Scheduled Castes - SC', val: 'Scheduled Castes - SC'},
                {key: 'Scheduled Tribes - ST', val: 'Scheduled Tribes - ST'},
                {key: 'Other Backward Classes - OBC', val: 'Other Backward Classes - OBC'},
            ],

            qualifications: [
                {key: 'Primary School', val: 'Primary School'},
                {key: 'Secondary School', val: 'Secondary School'},
                {key: 'High School', val: 'High School'},
                {key: 'Undergraduate', val: 'Undergraduate'},
                {key: 'Graduate', val: 'Graduate'},
                {key: 'Diploma', val: 'Diploma'},
                {key: 'Masters', val: 'Masters'},
                {key: 'Doctorate', val: 'Doctorate'},
                {key: 'Other', val: 'Other'},
            ],

            annual_incomes: [
                {key: 'below 1 Lac', val: 'below 1 Lac'},
                {key: '1 Lac to 5 Lac', val: '1 Lac to 5 Lac'},
                {key: '5 Lac to 10 Lac', val: '5 Lac to 10 Lac'},
                {key: '10 Lac and above', val: '10 Lac and above'},
            ],

            yn: [
                {key: 'Yes', val: 'Yes'},
                {key: 'No', val: 'No'},
            ],

            ynn: [
                {key: 'Yes', val: 'Yes'},
                {key: 'No', val: 'No'},
                {key: 'Not Sure', val: 'Not Sure'},
            ],

            mf: [
                {key: 'Mother', val: 'Mother'},
                {key: 'Father', val: 'Father'},
            ],

            formData: {
                admissions: {
                    previous_school: '',
                    board: '',
                    first_language_id: '',
                    second_language_id: '',
                    third_language_id: '',
                    academic_year_id: '',
                    branch_id: '',
                    grade_id: '',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    email: this.$page.props.auth.user.email,
                    phone: '',
                    dob: '',
                    birth_place: '',
                    gender: '',
                    blood_group: '',
                    religion: '',
                    cast: '',
                    subcast: '',
                    cast_category: '',
                    mothertongue: '',
                    nationality: '',
                    aadhar: '',

                    is_alumnus: 'No',
                    special_need: 'No',
                    speaking_hearing: 'No',
                    is_single_parent: '',
                    single_what: null,
                },
                addresses: {
                    address: '',
                    city: '',
                    pincode: '',
                    state: '',
                    country: '',
                },
                father: {
                    relation: 'Father',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    dob: '',
                    pan: '',
                    aadhar: '',
                    qualification: '',
                    degree: '',
                    occupation: '',
                    annual_income: '',
                    company_name: '',
                    company_address: '',
                },
                mother: {
                    relation: 'Mother',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    dob: '',
                    pan: '',
                    aadhar: '',
                    qualification: '',
                    degree: '',
                    occupation: '',
                    annual_income: '',
                    company_name: '',
                    company_address: '',
                },
                guardian: {
                    isGuardian: true,
                    relation: 'Other',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    dob: '',
                    pan: '',
                    aadhar: '',
                    qualification: '',
                    degree: '',
                    occupation: '',
                    annual_income: '',
                    company_name: '',
                    company_address: '',
                },
                siblings: [],
                photo: null,
                aadhar: null,
                birth_certificate: null,
                razorpay: {
                    user_id: this.$page.props.auth.user.id,
                    razorpay_payment_id: '',
                    razorpay_order_id: '',
                    razorpay_signature: '',
                    verified: '',
                },
            },

            sibling: {
                gr_number: '',
            },

            steps: {
                current: 1, /* 1 to 6 */
            },
        };
    },

    computed: {

        admissionFee(){
            let fee = 0;
            this.fee.forEach(f => {
                if(f.branch_id == this.formData.admissions.branch_id && f.academic_year_id == this.formData.admissions.academic_year_id && f.grade_id == this.formData.admissions.grade_id){
                    fee = f.application_fee;
                }
            });
            return fee;
        },

        isSingleParent(){
            return this.formData.admissions.is_single_parent == 'Yes' ? true : false;
        },

        stepOne(){
            let is = false;
            let a = this.formData.admissions;
            if(a.academic_year_id != '' && a.branch_id != '' && a.grade_id != '' && a.first_language_id != '' && a.second_language_id != '' && a.third_language_id != '' && a.is_alumnus != '' && a.special_need != '' && a.speaking_hearing != ''){
                is = true;
            }
            return is;
        },

        stepTwo(){
            let is = true;
            for(let key in this.formData.admissions){
                if(key != 'email' && key != 'phone' && key != 'previous_school' && key != 'board' && key != 'is_single_parent' && key != 'single_what'){
                    if(this.formData.admissions[key] == null || this.formData.admissions[key] == ''){
                        is = false;
                    }
                }
            }
            return is;
        },

        stepThree(){
            let is = true;
            for(let key in this.formData.admissions){
                if(key == 'email' || key == 'phone'){
                    if(this.formData.admissions[key] == null || this.formData.admissions[key] == ''){
                        is = false;
                    }
                }
            }
            
            for(let key in this.formData.addresses){
                if(this.formData.addresses[key] == null || this.formData.addresses[key] == ''){
                    is = false;
                }
            }

            return is;
        },

        stepFour(){
            /* Father Step */
            let is = true;

            if((this.formData.admissions.is_single_parent == 'No') || (this.formData.admissions.is_single_parent == 'Yes' && this.formData.admissions.single_what == 'Father')){
                for(let key in this.formData.father){
                    if(this.formData.father[key] == null || this.formData.father[key] == ''){
                        is = false;
                    }
                }
            } else if((this.formData.admissions.is_single_parent == '' || this.formData.admissions.is_single_parent == null) || (this.formData.admissions.single_what == '' || this.formData.admissions.single_what == null)){
                is = false;
            }

            return is;
        },

        stepFive(){
            /* Mother Step */
            let is = true;

            if((this.formData.admissions.is_single_parent == 'No') || (this.formData.admissions.is_single_parent == 'Yes' && this.formData.admissions.single_what == 'Mother')){
                for(let key in this.formData.mother){
                    if(this.formData.mother[key] == null || this.formData.mother[key] == ''){
                        is = false;
                    }
                }
            }

            return is;
        },

        stepSix(){
            let is = true;
            if(this.formData.guardian.isGuardian){
                for(let key in this.formData.guardian){
                    if(this.formData.guardian[key] == null || this.formData.guardian[key] == ''){
                        is = false;
                    }
                }
            }
            return is;
        },

        stepSeven(){
            let is = true;
            if(this.formData.photo == null){
                is = false;
            }
            return is;
        },

        first_languages(){
            let first_languages = [];
            let branch_id = this.formData.admissions.branch_id;
            this.branches.forEach(branch => {
                if(branch.id == branch_id){
                    
                    branch.first_languages.forEach(lan => {
                        let opt = {
                            key: lan.language,
                            val: lan.id
                        };
                        first_languages.push(opt);
                    });
                    
                }
            });
            return first_languages;
        },

        second_languages(){
            let second_languages = [];
            let branch_id = this.formData.admissions.branch_id;
            this.branches.forEach(branch => {
                if(branch.id == branch_id){
                    
                    branch.second_languages.forEach(lan => {
                        let opt = {
                            key: lan.language,
                            val: lan.id
                        };
                        second_languages.push(opt);
                    });
                    
                }
            });
            return second_languages;
        },

        second_language(){
            let sl = '';
            this.branches.forEach(br => {
                if(this.formData.admissions.branch_id == br.id){
                    br.second_languages.forEach(lan => {
                        if(lan.id == this.formData.admissions.second_language_id){
                            sl = lan.language;
                        }
                    });
                }
            });
            return sl;
        },
        
        third_languages(){
            let third_languages = [];
            let branch_id = this.formData.admissions.branch_id;
            this.branches.forEach(branch => {
                if(branch.id == branch_id){
                    if(this.second_language != ''){
                        branch.third_languages.forEach(lan => {
                            if(this.second_language != lan.language){
                                let opt = {
                                    key: lan.language,
                                    val: lan.id
                                };
                                third_languages.push(opt);
                            }
                        });
                    }
                }
            });
            return third_languages;
        },

        academic_years(){
            this.allAcademicYears = [];
            if(this.formData.admissions.branch_id != ''){
                this.branches.forEach(branch => {
                    if(this.formData.admissions.branch_id == branch.id){
                        this.allAcademicYears = branch.open_academic_years;
                    }
                });
            }
            let academic_years = [];
            this.allAcademicYears.forEach(ay => {
                let obj = {
                    key: ay.name,
                    val: ay.id
                };
                academic_years.push(obj);
            });
            return academic_years;
        },

        grades (){
            this.allGrades = [];
            if(this.formData.admissions.academic_year_id != ''){
                this.allAcademicYears.forEach(academic_year => {
                    if(academic_year.id == this.formData.admissions.academic_year_id){
                        this.allGrades = academic_year.academic_year_intakes;
                    }
                });
            }
            let grades = [];
            this.allGrades.forEach(gr => {
                let obj = {
                    key: gr.grade.name,
                    val: gr.grade.id
                };
                grades.push(obj);
            });
            return grades;
        },

        photo_url (){
            let url = null;
            if(this.formData.photo != null){
                url = URL.createObjectURL(this.formData.photo);
            }
            return url;
        },

        birth_certificate_url (){
            let url = null;
            if(this.formData.birth_certificate != null){
                url = URL.createObjectURL(this.formData.birth_certificate);
            }
            return url;
        },

        aadhar_url (){
            let url = null;
            if(this.formData.aadhar != null){
                url = URL.createObjectURL(this.formData.aadhar);
            }
            return url;
        },

    },

    methods: {

        submitApplication(){
            let frm = useForm(this.formData);
            frm.post('/admission/save_application', {
                onFinish: data => {},
                onSuccess: res => {
                    this.resetForm();
                }
            });
        },

        resetForm(){
            this.steps.current = 1;
        },

        addGRN(){
            if(this.sibling.gr_number != '' && this.sibling.gr_number != null){
                let sib = {
                    gr_number : this.sibling.gr_number
                };
                this.formData.siblings.push(sib)
                this.sibling.gr_number = '';
            }
        },

        demoData(){
            this.formData.admissions.branch_id = 1;
            this.formData.admissions.academic_year_id = 2;
            this.formData.admissions.grade_id = 2;
            this.formData.admissions.first_language_id = 1;
            this.formData.admissions.second_language_id = 2;
            this.formData.admissions.third_language_id = 5;
            this.formData.admissions.previous_school = 'Carmel School';
            this.formData.admissions.board = 'SSC';

            this.formData.admissions.first_name = 'Royce';
            this.formData.admissions.middle_name = 'Sandeep';
            this.formData.admissions.last_name = 'Rathod';
            this.formData.admissions.dob = '2017-04-07';
            this.formData.admissions.birth_place = 'Ambernath';
            this.formData.admissions.gender = 'Male';
            this.formData.admissions.blood_group = 'O +ve';
            this.formData.admissions.cast_category = 'General Category';
            this.formData.admissions.religion = 'Christian';
            this.formData.admissions.cast = 'NA';
            this.formData.admissions.subcast = 'NA';
            this.formData.admissions.mothertongue = 'English';
            this.formData.admissions.nationality = 'Indian';
            this.formData.admissions.aadhar = '1234567';
            this.formData.admissions.phone = '9664588677';

            this.formData.addresses.address = 'Plot No 65, Shree Satyam CHS B101, Sai Section';
            this.formData.addresses.city = 'Ambernath';
            this.formData.addresses.pincode = '421501';
            this.formData.addresses.state = 'Maharashtra';
            this.formData.addresses.country = 'India';

            this.formData.father.first_name = 'Sandeep';
            this.formData.father.middle_name = 'Vilas';
            this.formData.father.last_name = 'Rathod';
            this.formData.father.email = 'sandeep198558@yahoo.com';
            this.formData.father.phone = '9664588677';
            this.formData.father.dob = '1985-10-27';
            this.formData.father.pan = 'AKTPR2313Q';
            this.formData.father.aadhar = '123412341234';
            this.formData.father.qualification = 'Graduate';
            this.formData.father.degree = 'BCom';
            this.formData.father.occupation = 'Developer';
            this.formData.father.annual_income = '10 Lac and above';
            this.formData.father.company_name = 'Leena IT Solutions';

            this.formData.mother.first_name = 'Leena';
            this.formData.mother.middle_name = 'Sandeep';
            this.formData.mother.last_name = 'Rathod';
            this.formData.mother.email = 'leenaadam28@gmail.com';
            this.formData.mother.phone = '9769409405';
            this.formData.mother.dob = '1990-03-28';
            this.formData.mother.pan = 'AKTPR2313Q';
            this.formData.mother.aadhar = '123412341234';
            this.formData.mother.qualification = 'Graduate';
            this.formData.mother.degree = 'BSc';
            this.formData.mother.occupation = 'Developer';
            this.formData.mother.annual_income = '10 Lac and above';
            this.formData.mother.company_name = 'Leena IT Solutions';

            /* this.steps.current = 4; */
        },

        payment(e){

            this.formData.razorpay.user_id = this.$page.props.auth.user.id;
            this.formData.razorpay.razorpay_payment_id = e.razorpay_payment_id;
            this.formData.razorpay.razorpay_order_id = e.razorpay_order_id;
            this.formData.razorpay.razorpay_signature = e.razorpay_signature;
            this.formData.razorpay.verified = e.verified;

            this.submitApplication();
        },

        deleteSibline(ind){
            this.formData.siblings.splice(ind, 1);
        },

        init(){
            let branches = [];
            this.branches.forEach(branch => {
                let br = {
                    key : branch.name,
                    val: branch.id,
                }
                branches.push(br);
            });
            this.allBranches = branches;
            this.demoData();
        },
    },

    created: function() {
        this.init();
    },

    mounted: function() {
    },

}

</script>

<template>
    <Head title="Dashboard" />

    <Student>

        <!-- When admissions are closed this block get displayed -->
        <div v-if="isAdmission == 'No'" class="box">
            Admissions are closed!
        </div>

        <div v-if="msg" class="box bg-green-200">
            {{ msg }}
        </div>

        <div class="p-6 text-center flex space-x-6 justify-center">
            
            <div class="text-center">
                <button class="w-10 h-10 rounded-full" :class="steps.current == 1 ? 'bg-orange-500 text-white' : steps.current > 1 ? 'bg-black text-white' : 'bg-gray-400 text-white'">1</button>
                <p class="text-sm text-gray-400 py-2">Basic</p>
            </div>

            <div class="text-center">
                <button class="w-10 h-10 rounded-full" :class="steps.current == 2 ? 'bg-orange-500 text-white' : steps.current > 2 ? 'bg-black text-white' : 'bg-gray-400 text-white'">2</button>
                <p class="text-sm text-gray-400 py-2">Personal</p>
            </div>

            <div class="text-center">
                <button class="w-10 h-10 rounded-full" :class="steps.current == 3 ? 'bg-orange-500 text-white' : steps.current > 3 ? 'bg-black text-white' : 'bg-gray-400 text-white'">3</button>
                <p class="text-sm text-gray-400 py-2">Contact</p>
            </div>

            <div class="text-center">
                <button class="w-10 h-10 rounded-full" :class="steps.current == 4 ? 'bg-orange-500 text-white' : steps.current > 4 ? 'bg-black text-white' : 'bg-gray-400 text-white'">4</button>
                <p class="text-sm text-gray-400 py-2">Father</p>
            </div>

            <div class="text-center">
                <button class="w-10 h-10 rounded-full" :class="steps.current == 5 ? 'bg-orange-500 text-white' : steps.current > 5 ? 'bg-black text-white' : 'bg-gray-400 text-white'">5</button>
                <p class="text-sm text-gray-400 py-2">Mother</p>
            </div>

            <div class="text-center">
                <button class="w-10 h-10 rounded-full" :class="steps.current == 6 ? 'bg-orange-500 text-white' : steps.current > 6 ? 'bg-black text-white' : 'bg-gray-400 text-white'">6</button>
                <p class="text-sm text-gray-400 py-2">Guardian</p>
            </div>

            <div class="text-center">
                <button class="w-10 h-10 rounded-full" :class="steps.current == 7 ? 'bg-orange-500 text-white' : steps.current > 7 ? 'bg-black text-white' : 'bg-gray-400 text-white'">7</button>
                <p class="text-sm text-gray-400 py-2">Documents</p>
            </div>

            <div class="text-center">
                <button class="w-10 h-10 rounded-full" :class="steps.current == 8 ? 'bg-orange-500 text-white' : steps.current > 8 ? 'bg-black text-white' : 'bg-gray-400 text-white'">8</button>
                <p class="text-sm text-gray-400 py-2">Review</p>
            </div>
            
        </div>

        <!-- When admissions are open -->
        <div v-if="isAdmission == 'Yes'" class="box">
            
            
            <div class="w-full">

                <!-- Basic Step -->
                <div v-if="steps.current == 1">

                    <h2 class="text-2xl mt-4 mb-10">Basic Information</h2>

                    <div class="flex flex-wrap">
                        
                        <Select v-model="formData.admissions.branch_id" label="Branch" error="" width="w-full lg:w-1/3" :options="allBranches"></Select>

                        <Select v-model="formData.admissions.academic_year_id" label="Academic Year" error="" width="w-full lg:w-1/3" :options="academic_years"></Select>

                        <Select v-model="formData.admissions.grade_id" label="Grade" error="" width="w-full lg:w-1/3" :options="grades"></Select>

                        <Select v-model="formData.admissions.first_language_id" label="First Language" error="" width="w-full lg:w-1/3" :options="first_languages"></Select>

                        <Select v-model="formData.admissions.second_language_id" label="Second Language" error="" width="w-full lg:w-1/3" :options="second_languages"></Select>

                        <Select v-model="formData.admissions.third_language_id" label="Third Language" error="" width="w-full lg:w-1/3" :options="third_languages"></Select>

                        <Text v-model="formData.admissions.previous_school" label="Previous School" error="" width="w-full lg:w-2/3"></Text>

                        <Select v-model="formData.admissions.board" label="Previous School Board" error="" width="w-full lg:w-1/3" :options="boards"></Select>

                        <Select v-model="formData.admissions.is_alumnus" label="Is alumnus" error="" width="w-full lg:w-1/3" :options="yn"></Select>

                        <Select v-model="formData.admissions.speaking_hearing" label="Any speaking hearing problem" error="" width="w-full lg:w-1/3" :options="yn"></Select>

                        <Select v-model="formData.admissions.special_need" label="Any special care needed?" error="" width="w-full lg:w-1/3" :options="ynn"></Select>

                        <div class="w-full mb-6">
                            <span v-if="formData.siblings.length <= 0">Siblings GR Numbers are not added</span> <span v-for="(sib,ind) in formData.siblings" :key="sib" class="inline-block btn bg-black text-gray-200 mx-1 relative group">
                                {{ sib.gr_number }} 
                                <button @click="deleteSibline(ind)" class="btn btn-red absolute z-10 -top-4 py-1 px-3 hidden group-hover:inline-block">X</button>
                            </span>
                        </div>

                        <Text v-model="sibling.gr_number" label="Sibling GR Number" error="" width="w-full lg:w-1/3"></Text>
                        <div class="w-full lg:w-2/3 p-1">
                            <button @click="addGRN()" class="inline-block btn btn-orange mx-1">Add GR Number</button>
                        </div>

                    </div>

                    <button @click="steps.current = 2" :disabled="!stepOne" class="btn" :class="stepOne ? 'btn-purple' : 'btn-disabled'">Proceed</button>

                </div>

                <!-- Personnal Step -->
                <div v-if="steps.current == 2">

                    <h2 class="text-2xl mt-4 mb-10">Students Personal Information</h2>

                    <div class="flex flex-wrap">

                        <Text v-model="formData.admissions.first_name" label="First Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.admissions.middle_name" label="Middle Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.admissions.last_name" label="Last Name" error="" width="w-full lg:w-1/3"></Text>

                        <Date v-model="formData.admissions.dob" label="Date of Birth" error="" width="w-full lg:w-1/2"></Date>

                        <Text v-model="formData.admissions.birth_place" label="Birth Place" error="" width="w-full lg:w-1/2"></Text>

                        <Select v-model="formData.admissions.gender" label="Gender" error="" width="w-full lg:w-1/2" :options="genders"></Select>

                        <Select v-model="formData.admissions.blood_group" label="Blood Group" error="" width="w-full lg:w-1/2" :options="blood_groups"></Select>

                        <Select v-model="formData.admissions.cast_category" label="Cast Category" error="" width="w-full lg:w-1/2" :options="cast_categories"></Select>

                        <Select v-model="formData.admissions.religion" label="Religion" error="" width="w-full lg:w-1/2" :options="religions"></Select>

                        <Text v-model="formData.admissions.cast" label="Cast" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.admissions.subcast" label="Sub-cast" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.admissions.mothertongue" label="Mother Tongue" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.admissions.nationality" label="Nationality" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.admissions.aadhar" label="Aadhar" error="" width="w-full lg:w-1/3"></Text>

                    </div>

                    <button @click="steps.current = 1" :disabled="!stepOne" class="btn mr-4" :class="stepOne ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button @click="steps.current = 3" :disabled="!stepTwo" class="btn mr-4" :class="stepTwo ? 'btn-purple' : 'btn-disabled'">Next</button>

                </div>


                <!-- Contact Step -->
                <div v-if="steps.current == 3">

                    <h2 class="text-2xl mt-4 mb-10">Contact Information</h2>

                    <div class="flex flex-wrap">

                        <Text v-model="formData.admissions.email" label="Email Address" readonly="true" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.admissions.phone" label="Mobile number" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.addresses.address" label="Address" error="" width=""></Text>

                        <Text v-model="formData.addresses.city" label="City" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.addresses.pincode" label="Pincode" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.addresses.state" label="State" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.addresses.country" label="Country" error="" width="w-full lg:w-1/2"></Text>


                    </div>

                    <button @click="steps.current = 2" :disabled="!stepTwo" class="btn mr-4" :class="stepTwo ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button @click="steps.current = 4" :disabled="!stepThree" class="btn mr-4" :class="stepThree ? 'btn-purple' : 'btn-disabled'">Next</button>

                </div>


                <!-- Father Step -->
                <div v-if="steps.current == 4">

                    <div class="flex flex-wrap">

                        <Radio @change="formData.admissions.single_what = ''" v-model="formData.admissions.is_single_parent" label="Are you a single parent?" error="" width="w-full" :options="yn"></Radio>

                        <Radio v-if="isSingleParent" v-model="formData.admissions.single_what" label="I am a single" error="" width="w-full" :options="mf"></Radio>

                    </div>


                    <h2 v-if="formData.admissions.is_single_parent == 'No' || formData.admissions.single_what == 'Father'" class="text-2xl mt-4 mb-10">Father Details</h2>

                    

                    <div v-if="formData.admissions.is_single_parent == 'No' || formData.admissions.single_what == 'Father'" class="flex flex-wrap">

                        <Text v-model="formData.father.first_name" label="First Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.father.middle_name" label="Middle Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.father.last_name" label="Last Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.father.email" label="Email Address" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.father.phone" label="Mobile number" error="" width="w-full lg:w-1/2"></Text>

                        <Date v-model="formData.father.dob" label="Date of Birth" error="" width="w-full lg:w-1/3"></Date>

                        <Text v-model="formData.father.pan" label="PAN" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.father.aadhar" label="Aadhar" error="" width="w-full lg:w-1/3"></Text>

                        <Select v-model="formData.father.qualification" label="Qualification" error="" width="w-full lg:w-1/2" :options="qualifications"></Select>

                        <Text v-model="formData.father.degree" label="Degree" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.father.occupation" label="Occupation" error="" width="w-full lg:w-1/2"></Text>

                        <Select v-model="formData.father.annual_income" label="Annual Income" error="" width="w-full lg:w-1/2" :options="annual_incomes"></Select>

                        <Text v-model="formData.father.company_name" label="Company Name" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.father.company_address" label="Companyy Address" error="" width="w-full lg:w-1/2"></Text>

                    </div>

                    <button @click="steps.current = 3" :disabled="!stepThree" class="btn mr-4" :class="stepThree ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button v-if="formData.admissions.is_single_parent == 'No' || (formData.admissions.is_single_parent == 'Yes' && formData.admissions.single_what == 'Mother')" @click="steps.current = 5" :disabled="!stepFour" class="btn mr-4" :class="stepFour ? 'btn-purple' : 'btn-disabled'">Next</button>
                    <button v-if="formData.admissions.is_single_parent == 'Yes' && formData.admissions.single_what == 'Father'" @click="steps.current = 6" :disabled="!stepFour" class="btn mr-4" :class="stepFour ? 'btn-purple' : 'btn-disabled'">Next</button>

                </div>


                <!-- Mother Step -->
                <div v-if="steps.current == 5">

                    <h2 class="text-2xl mt-4 mb-10">Mother Details</h2>

                    <div class="flex flex-wrap">

                        <Text v-model="formData.mother.first_name" label="First Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.mother.middle_name" label="Middle Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.mother.last_name" label="Last Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.mother.email" label="Email Address" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.mother.phone" label="Mobile number" error="" width="w-full lg:w-1/2"></Text>

                        <Date v-model="formData.mother.dob" label="Date of Birth" error="" width="w-full lg:w-1/3"></Date>

                        <Text v-model="formData.mother.pan" label="PAN" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.mother.aadhar" label="Aadhar" error="" width="w-full lg:w-1/3"></Text>

                        <Select v-model="formData.mother.qualification" label="Qualification" error="" width="w-full lg:w-1/2" :options="qualifications"></Select>

                        <Text v-model="formData.mother.degree" label="Degree" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.mother.occupation" label="Occupation" error="" width="w-full lg:w-1/2"></Text>

                        <Select v-model="formData.mother.annual_income" label="Annual Income" error="" width="w-full lg:w-1/2" :options="annual_incomes"></Select>

                        <Text v-model="formData.mother.company_name" label="Company Name" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.mother.company_address" label="Companyy Address" error="" width="w-full lg:w-1/2"></Text>

                    </div>

                    <button @click="steps.current = 4" :disabled="!stepFour" class="btn mr-4" :class="stepFour ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button @click="steps.current = 6" :disabled="!stepFive" class="btn mr-4" :class="stepFive ? 'btn-purple' : 'btn-disabled'">Next</button>

                </div>


                <!-- Guardian Step -->
                <div v-if="steps.current == 6">

                    <h2 class="text-2xl mt-4 mb-10">Guardian Details</h2>

                    <div class="mb-7 w-full">
                        <input type="checkbox" name="isGuardian" id="isGuardian" class="mr-3" v-model="formData.guardian.isGuardian">
                        <label for="isGuardian" class="cursor-pointer">Guardian {{ formData.guardian.isGuardian ? "is" : "isn't" }} required</label>
                    </div>

                    <div v-if="formData.guardian.isGuardian" class="flex flex-wrap">

                        <Text v-model="formData.guardian.first_name" label="First Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.guardian.middle_name" label="Middle Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.guardian.last_name" label="Last Name" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.guardian.email" label="Email Address" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.guardian.phone" label="Mobile number" error="" width="w-full lg:w-1/2"></Text>

                        <Date v-model="formData.guardian.dob" label="Date of Birth" error="" width="w-full lg:w-1/3"></Date>

                        <Text v-model="formData.guardian.pan" label="PAN" error="" width="w-full lg:w-1/3"></Text>

                        <Text v-model="formData.guardian.aadhar" label="Aadhar" error="" width="w-full lg:w-1/3"></Text>

                        <Select v-model="formData.guardian.qualification" label="Qualification" error="" width="w-full lg:w-1/2" :options="qualifications"></Select>

                        <Text v-model="formData.guardian.degree" label="Degree" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.guardian.occupation" label="Occupation" error="" width="w-full lg:w-1/2"></Text>

                        <Select v-model="formData.guardian.annual_income" label="Annual Income" error="" width="w-full lg:w-1/2" :options="annual_incomes"></Select>

                        <Text v-model="formData.guardian.company_name" label="Company Name" error="" width="w-full lg:w-1/2"></Text>

                        <Text v-model="formData.guardian.company_address" label="Companyy Address" error="" width="w-full lg:w-1/2"></Text>

                    </div>

                    <button v-if="formData.admissions.is_single_parent == 'Yes' && formData.admissions.single_what == 'Father'" @click="steps.current = 4" :disabled="!stepFive" class="btn mr-4" :class="stepFive ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button v-if="formData.admissions.is_single_parent == 'No' || (formData.admissions.is_single_parent == 'Yes' && formData.admissions.single_what == 'Mother')" @click="steps.current = 5" :disabled="!stepFive" class="btn mr-4" :class="stepFive ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button @click="steps.current = 7" :disabled="!stepSix" class="btn mr-4" :class="stepSix ? 'btn-purple' : 'btn-disabled'">Next</button>

                </div>


                <!-- Documents Step -->
                <div v-if="steps.current == 7">

                    <h2 class="text-2xl mt-4 mb-10">Documents</h2>

                    <div class="flex flex-wrap">

                        <Image v-model="formData.photo" label="Passport size photo" error="" width=""></Image>

                        <Image v-model="formData.birth_certificate" label="Birth Certificate" error="" width=""></Image>

                        <Image v-model="formData.aadhar" label="Aadhar" error="" width=""></Image>

                    </div>

                    <button @click="steps.current = 6" :disabled="!stepSix" class="btn mr-4" :class="stepSix ? 'btn-purple' : 'btn-disabled'">Back</button>
                    <button @click="steps.current = 8" :disabled="!stepSeven" class="btn mr-4" :class="stepSeven ? 'btn-purple' : 'btn-disabled'">Next</button>

                </div>


                <!-- Review Step -->
                <div v-if="steps.current == 8">

                    <h2 class="text-2xl mt-4 mb-5">Review</h2>

                    <div class="flex flex-wrap mb-5">

                        <div class="w-full">Name : {{ formData.admissions.first_name }} {{ formData.admissions.middle_name }} {{ formData.admissions.last_name }}</div>

                        <div class="w-full">Date of Birth : {{ formData.admissions.dob }}</div>

                        <div class="w-full">Birth Place : {{ formData.admissions.birth_place }}</div>

                        <div class="w-full">Gender : {{ formData.admissions.gender }}</div>

                        <div class="w-full">Blood Group : {{ formData.admissions.blood_group }}</div>

                        <div class="w-full">Religion : {{ formData.admissions.religion }}</div>

                        <div class="w-full">Cast : {{ formData.admissions.cast }}</div>

                        <div class="w-full">Sub-cast : {{ formData.admissions.subcast }}</div>

                        <div class="w-full">Cast Category : {{ formData.admissions.cast_category }}</div>

                        <div class="w-full">Mother Tongue : {{ formData.admissions.mothertongue }}</div>

                        <div class="w-full">Nationality : {{ formData.admissions.nationality }}</div>

                        <div class="w-full">Aadhar Number : {{ formData.admissions.aadhar }}</div>

                        <hr class="w-full my-5">

                        <div class="w-full">Email : {{ formData.admissions.email }}</div>

                        <div class="w-full">Mobile Number : {{ formData.admissions.phone }}</div>

                        <div class="w-full">Address : {{ formData.addresses.address }} {{ formData.addresses.city }} {{ formData.addresses.pincode }} {{ formData.addresses.state }} {{ formData.addresses.country }}</div>

                        <hr class="w-full my-5">

                        <div class="w-full">Father's Name : {{ formData.father.first_name }} {{ formData.father.middle_name }} {{ formData.father.last_name }}</div>

                        <div class="w-full">Email : {{ formData.father.email }}</div>

                        <div class="w-full">Mobile Number : {{ formData.father.phone }}</div>

                        <div class="w-full">Date of Birth : {{ formData.father.dob }}</div>

                        <div class="w-full">Aadhar Number : {{ formData.father.aadhar }}</div>

                        <div class="w-full">PAN : {{ formData.father.pan }}</div>

                        <div class="w-full">Qualification : {{ formData.father.qualification }}</div>

                        <div class="w-full">Degree : {{ formData.father.degree }}</div>

                        <div class="w-full">Occupation : {{ formData.father.occupation }}</div>

                        <div class="w-full">Annual Income : {{ formData.father.annual_income }}</div>

                        <div class="w-full">Company Name : {{ formData.father.company_name }}</div>

                        <div class="w-full">Company Address : {{ formData.father.company_address }}</div>

                        <hr class="w-full my-5">

                        <div class="w-full">Mother's Name : {{ formData.mother.first_name }} {{ formData.mother.middle_name }} {{ formData.mother.last_name }}</div>

                        <div class="w-full">Email : {{ formData.mother.email }}</div>

                        <div class="w-full">Mobile Number : {{ formData.mother.phone }}</div>

                        <div class="w-full">Date of Birth : {{ formData.mother.dob }}</div>

                        <div class="w-full">Aadhar Number : {{ formData.mother.aadhar }}</div>

                        <div class="w-full">PAN : {{ formData.mother.pan }}</div>

                        <div class="w-full">Qualification : {{ formData.mother.qualification }}</div>

                        <div class="w-full">Degree : {{ formData.mother.degree }}</div>

                        <div class="w-full">Occupation : {{ formData.mother.occupation }}</div>

                        <div class="w-full">Annual Income : {{ formData.mother.annual_income }}</div>

                        <div class="w-full">Company Name : {{ formData.mother.company_name }}</div>

                        <div class="w-full">Company Address : {{ formData.mother.company_address }}</div>

                        <hr class="w-full my-5">

                        <div class="w-full" v-if="formData.guardian.isGuardian">

                            <div class="w-full">Guardian's Name : {{ formData.guardian.first_name }} {{ formData.guardian.middle_name }} {{ formData.guardian.last_name }}</div>

                            <div class="w-full">Email : {{ formData.guardian.email }}</div>

                            <div class="w-full">Mobile Number : {{ formData.guardian.phone }}</div>

                            <div class="w-full">Date of Birth : {{ formData.guardian.dob }}</div>

                            <div class="w-full">Aadhar Number : {{ formData.guardian.aadhar }}</div>

                            <div class="w-full">PAN : {{ formData.guardian.pan }}</div>

                            <div class="w-full">Qualification : {{ formData.guardian.qualification }}</div>

                            <div class="w-full">Degree : {{ formData.guardian.degree }}</div>

                            <div class="w-full">Occupation : {{ formData.guardian.occupation }}</div>

                            <div class="w-full">Annual Income : {{ formData.guardian.annual_income }}</div>

                            <div class="w-full">Company Name : {{ formData.guardian.company_name }}</div>

                            <div class="w-full">Company Address : {{ formData.guardian.company_address }}</div>

                            <hr class="w-full my-5">

                        </div>

                        <div class="w-full flex space-x-5">

                            <div class="w-1/3 text-center">
                                <p class="py-3">Photo</p>
                                <img v-if="formData.photo" class="w-full" :src="photo_url">
                            </div>

                            <div class="w-1/3 text-center">
                                <p class="py-3">Birth Certificate</p>
                                <img v-if="formData.birth_certificate" class="w-full" :src="birth_certificate_url">
                            </div>

                            <div class="w-1/3 text-center">
                                <p class="py-3">Aadhar Card</p>
                                <img v-if="formData.aadhar" class="w-full" :src="aadhar_url">
                            </div>

                        </div>

                        




                    </div>

                    <button @click="steps.current = 7" :disabled="!stepSix" class="btn mr-4" :class="stepSix ? 'btn-purple' : 'btn-disabled'">Back</button>

                    <!-- <button @click="submitApplication()" class="btn mr-4" :class="stepSeven ? 'btn-purple' : 'btn-disabled'">Submit Application</button> -->

                    <Razorpay @payment="payment($event)" :amount="admissionFee * 100" description="" reason="" :class="stepSeven ? 'btn-orange' : 'btn-disabled'">Pay & Proceed</Razorpay>

                </div>

                
            </div>
            
        </div>

        

    </Student>
</template>