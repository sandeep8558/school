<script setup>
import DemoLayout from '@/Layouts/DemoLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    name: String,
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

</script>

<template>
    <demo-layout>
        <Head title="Sandeep Page" />


        <h1 class="uppercase font-bold mb-8 text-lg">User Login</h1>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col">
            <input type="email" id="email" v-model="form.email" autofocus autocomplete="username" placeholder="Email Address" class="w-full rounded-md border-1 focus:border-2 border-purple-500 focus:border-purple-500 focus:ring-0">
            <span class="block px-3 mt-1 mb-4 text-left text-xs text-red-600">{{ form.errors.email }}</span>
            <input type="password" id="password" v-model="form.password" autofocus autocomplete="current-password" placeholder="Password" class="w-full rounded-md  border-1 focus:border-2 border-purple-500 focus:border-purple-500 focus:ring-0">
            <span class="block px-3 mt-1 mb-4 text-left text-xs text-red-600">{{ form.errors.password }}</span>

            <div class="mb-4 text-left">

                <input type="checkbox" id="remember" name="remember" v-model="form.remember" class="text-purple-600 focus:ring-0">
                <label class="ml-2 text-sm text-gray-600 dark:text-gray-400 cursor-pointer select-none" for="remember">Remember me</label>

            </div>
            



            <input type="submit" value="Login" class="bg-gradient-to-l from-purple-600 to-purple-500 hover:bg-gradient-to-r shadow-lg hover:shadow-md text-white cursor-pointer py-2 rounded-md">
        </form>

        <a class="block my-5" :href="route('password.request')">Forgot Password?</a>

        <!-- <hr class="border-1 border-gray-400"> -->

        <a class="block my-5 bg-gradient-to-l from-teal-600 to-teal-500 hover:bg-gradient-to-r shadow-lg hover:shadow-md py-2 rounded-md text-white" :href="route('register')">Sign Up</a>



    </demo-layout>
</template>
