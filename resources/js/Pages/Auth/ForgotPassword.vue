<script setup>
import DemoLayout from '@/Layouts/DemoLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};

</script>

<template>
    <demo-layout>
        <Head title="Sandeep Page" />

        <h1 class="uppercase font-bold mb-8 text-lg">Forgot Password</h1>
        <p class="text-sm mb-4">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col">

            <input type="email" id="email" v-model="form.email" autofocus autocomplete="username" placeholder="Email Address" class="w-full rounded-md  border-1 focus:border-2 border-purple-500 focus:border-purple-500 focus:ring-0">
            <span class="block px-3 mt-1 mb-4 text-left text-xs text-red-600">{{ form.errors.email }}</span>
            
            <input type="submit" value="Send Email to Reset Password" :disabled="form.processing" class="bg-gradient-to-l from-purple-600 to-purple-500 hover:bg-gradient-to-r shadow-lg hover:shadow-md text-white cursor-pointer py-2 rounded-md">

        </form>

        <a class="block my-5" :href="route('login')">Already Registered?</a>


    </demo-layout>
</template>
