<script setup>
import DemoLayout from '@/Layouts/DemoLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';


const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

</script>

<template>
    <demo-layout>

        <Head title="Sandeep Page" />

        <h1 class="uppercase font-bold mb-8 text-lg">Sign Up</h1>

        <form @submit.prevent="submit" class="flex flex-col">

            <input type="email" id="email" v-model="form.email" autofocus autocomplete="username" placeholder="Email Address" class="w-full rounded-md border-1 focus:border-2 border-purple-500 focus:border-purple-500 focus:ring-0">
            <span class="block px-3 mt-1 mb-4 text-left text-xs text-red-600">{{ form.errors.email }}</span>
            
            <input type="password" id="password" v-model="form.password" autofocus autocomplete="new-password" placeholder="New Password" class="w-full rounded-md border-1 focus:border-2 border-purple-500 focus:border-purple-500 focus:ring-0">
            <span class="block px-3 mt-1 mb-4 text-left text-xs text-red-600">{{ form.errors.password }}</span>

            <input type="password" id="password_confirmation" v-model="form.password_confirmation" autofocus autocomplete="new-password" placeholder="Confirm New Password" class="w-full rounded-md border-1 focus:border-2 border-purple-500 focus:border-purple-500 focus:ring-0">
            <span class="block px-3 mt-1 mb-4 text-left text-xs text-red-600">{{ form.errors.password }}</span>
            
            <input type="submit" value="Update New Password" class="bg-gradient-to-l from-purple-600 to-purple-500 hover:bg-gradient-to-r shadow-lg hover:shadow-md text-white cursor-pointer py-2 rounded-md">

        </form>

        <a class="block my-5" :href="route('login')">Already Registered?</a>

    </demo-layout>
</template>
