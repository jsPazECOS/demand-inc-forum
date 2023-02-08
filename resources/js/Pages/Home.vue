<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import PostList from "@/Pages/Post/Post/PostList.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    posts: Object
});
</script>

<template>
    <Head title="Demand Inc Forum"/>


    <div v-if="$page.props.auth.user==null"
         class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in
            </Link>
        </div>
    </div>

    <AuthenticatedLayout>
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <PostList
                :posts="posts"
            />
        </div>
    </AuthenticatedLayout>

</template>
