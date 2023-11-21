<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    
    props: {
        amount: Number,
        description: String,
        reason: String,
        cls: String,
    },

    data: function () {
        return {

            amt:0,
            desc:'',
            rsn: '',
            tkn: '',
            clss: '',

            options: {
                key:            "rzp_test_Hyd3yRA02IKycO",
                currency:       "INR",
                amount:         this.amt,
                name:           this.$page.props.settings.schoolName,
                image:           this.$page.props.settings.logo,
                description:    this.desc,
                order_id:       null,

                handler: response => this.emitPayment(response),
                
                prefill: {
                    name: this.$page.props.auth.user.name,
                    email: this.$page.props.auth.user.email,
                    contact: this.$page.props.auth.user.mobile,
                },
                notes: {
                    "reason": this.rsn
                },
                theme: {
                    "color": "#7e22ce"
                },
            },
        };
    },

    methods: {
        async pay(){
            let oid = await this.getOrderId();
            this.options.order_id = oid.order_id;
            var rzp1 = new Razorpay(this.options);
            rzp1.open();
        },
        
        async emitPayment(res){
            let a = await this.verify_sign(res);
            res.verified = a.res;
            this.$emit('payment', res);
        },

        async getOrderId(){

            let a = null;

            let data = {
                _token: this.tkn,
                amount: this.amount,
            };

            const options = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data)
            };

            await fetch('/razorpay/order_id', options)
            .then(res => {
                a = res.json();
            });

            return await a;
        },

        async verify_sign(obj){
            let a = null;

            let data = {
                _token: this.tkn,
                razorpay_payment_id: null,
                razorpay_order_id: null,
                razorpay_signature: null,
            };

            for(let o in obj){
                data[o] = obj[o];
            }

            const options = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data)
            };

            await fetch('/razorpay/verify_sign', options)
            .then(res => {
                a = res.json();
            });

            return await a;
        },

    },

    created: function() {

        this.desc = (this.description == undefined || this.description == null || this.description == '') ? 'Payment for School' : this.description;
        this.rsn = (this.reason == undefined || this.reason == null || this.reason == '') ? '' : this.reason;
        this.amt = (this.amount == undefined || this.amount == null || this.amount == '') ? '' : this.amount;

        this.clss = (this.cls == undefined || this.cls == null || this.cls == '') ? 'btn btn-purple' : this.cls;

    },

    mounted: function(){
        this.tkn = this.$page.props.csrf_token;
    },

    components: { Administrator, Head, Link }
}
</script>

<template>

<button :class="clss" @click="pay()"><slot></slot></button>

</template>

<!-- Example of Pay button Button -->
<!-- <Razorpay @payment="payment($event)" :amount="100" description="" reason="">Make Payment</Razorpay> -->