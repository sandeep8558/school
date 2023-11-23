<script>
import Student from '@/Layouts/Student.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Razorpay from '@/Components/Razorpay.vue';

export default {
    
    props: {
        my_applications: Object,
        fee: Object,
        emis: Object,
    },

    data: function () {
        return {
            admissionFee: 1,
        };
    },

    methods: {

        payment(e, app){
            e['rdata'] = this.getFeeBreakup(app.branch_id, app.academic_year_id, app.grade_id);
            e.admission_id = app.id;
            e.user_id = this.$page.props.auth.user.id;

            let frm = useForm(e);
            frm.post('/admission/save_admission_payment', {
                onFinish: data => {},
                onSuccess: res => {
                }
            });
            
        },

        dobs(dt){
            let dte = '';
            dte = dt.split('-');
            return dte[2] + '-' + dte[1] + '-' + dte[0];
        },

        isPaid(id){
            this.my_applications.forEach(app => {
                if(id == app.id){
                }
            });
        },

        getFeeBreakup(branch_id, academic_year_id, grade_id){
            let fee = [];
            this.fee.forEach(f => {
                if(f.branch_id == branch_id && f.academic_year_id == academic_year_id && f.grade_id == grade_id){
                    let a = {
                        key: 'Admission Fee',
                        val: f.admission_fee
                    };
                    let b = {
                        key: 'Deposit',
                        val: f.deposit
                    };
                    fee.push(a);
                    fee.push(b);
                }
            });
            this.emis.forEach(emi => {
                if(emi.branch_id == branch_id && emi.academic_year_id == academic_year_id && emi.grade_id == grade_id){
                    let c = {
                        key: emi.name,
                        val: emi.amount
                    };
                    fee.push(c);
                }
            });
            return fee;
        },

        getApplicationFee(branch_id, academic_year_id, grade_id){
            let fee = 0;
            this.fee.forEach(f => {
                if(f.branch_id == branch_id && f.academic_year_id == academic_year_id && f.grade_id == grade_id){
                    fee += (f.admission_fee + f.deposit);
                }
            });
            this.emis.forEach(emi => {
                if(emi.branch_id == branch_id && emi.academic_year_id == academic_year_id && emi.grade_id == grade_id){
                    fee += emi.amount;
                }
            });
            return fee;
        },
    },

    mounted: function() {
    },

    components: { Student, Head, Link, Razorpay }
}
</script>

<template>
    <Head title="Dashboard" />

    <Student>

        <div class="box">
            My Application
        </div>

        <div v-for="app in my_applications" :key="app.id" class="box">

            <div class="w-40">
                <img class="w-full" :src="app.admission_photos[0].media">
            </div>

            <div class="w-full">
                
                <p>Application ID: {{ app.id }} <span class="inline-block float-right">Rating: {{ app.total_rating }}</span></p>
                <p>{{ app.first_name }} {{ app.middle_name }} {{ app.last_name }} - {{ app.gender }}</p>
                <p>Grade - {{ app.grade.name }} | Date of Birth - {{ dobs(app.dob) }}</p>
                <p>{{ app.phone }} - {{ app.email }}</p>
                <p v-if="app.status !='Accepted'" class="text-indigo-500">Application is under process.</p>


                <table v-if="app.status =='Accepted'" class="w-full my-4">
                    <tr v-for="item in getFeeBreakup(app.branch_id, app.academic_year_id, app.grade_id)" :key="item.id">
                        <td class="border border-gray-400 p-1">{{ item.key }}</td>
                        <td class="border border-gray-400 p-1 text-right">Rs. {{ item.val }}/-</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-1">Total</td>
                        <td class="border border-gray-400 p-1 text-right">Rs. {{getApplicationFee(app.branch_id, app.academic_year_id, app.grade_id)}}/-</td>
                    </tr>
                </table>

                <p v-if="app.status =='Accepted' && app.payment_at == null" class="">
                    <Razorpay @payment="payment($event, app)" :amount="getApplicationFee(app.branch_id, app.academic_year_id, app.grade_id) * 100" description="" reason="" :class="'btn-orange'">Pay Rs. {{getApplicationFee(app.branch_id, app.academic_year_id, app.grade_id)}}/-</Razorpay>
                </p>

                <p v-if="app.payment_at != null" class="">
                    Payment Successful
                </p>

            </div>

            <!-- {{ app }} -->
            
        </div>

    </Student>
</template>