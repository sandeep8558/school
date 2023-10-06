<script setup>
</script>


<template>
    <main>
        <div class="w-auto min-h-screen bg-gradient-to-r py-5 from-purple-600 to-teal-500 flex justify-center items-center">

            <div class="lg:flex bg-gradient-to-r from-purple-700 to-teal-600 rounded-md items-center drop-shadow-lg">

                <div class="bg-transparent text-white w-96 py-10 px-2 text-center rounded-t-md lg:rounded-l-md">
                    <img :src="$page.props.settings.logo" class="mx-auto w-40">
                    <h1 class="font-bold text-2xl">{{$page.props.settings.schoolName}}</h1>
                    <p>{{$page.props.settings.tagLine}}</p>
                </div>

                <div class="bg-white w-96 rounded-b-md lg:rounded-bl-none lg:rounded-r-md px-5 py-10 text-center">

                    <slot></slot>

                </div>

            </div>
        </div>
    </main>
</template>