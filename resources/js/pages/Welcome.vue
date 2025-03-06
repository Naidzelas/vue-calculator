<template>
    <Head title="Welcome"> </Head>
    <div class="mt-[20%] text-center">
        <div class="text-8xl">WELCOME</div>
        <Link
            :href="route('login')"
            as="button"
            class="inline-block bg-slate-900 hover:bg-blue-700 mt-5 p-2 w-40 font-bold text-slate-50 hover:scale-110 transition cursor-pointer"
        >
            Log in
        </Link>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
