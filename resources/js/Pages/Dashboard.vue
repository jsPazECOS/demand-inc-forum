<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PostList from "@/Pages/Post/PostList.vue";
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <PostList
                :posts="posts"
            />
        </div>
    </AuthenticatedLayout>
</template>
