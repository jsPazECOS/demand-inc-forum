<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import axios from 'axios';

import {onMounted, ref} from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import PostResponseList from "@/Pages/Post/PostResponse/PostResponseList.vue";


dayjs.extend(relativeTime);

const props = defineProps({
    post: Object
});

</script>

<template>
    <Head title="Post Detail"/>


    <AuthenticatedLayout>

        <div class="max-w-full mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between">
                    <Link :href="route('home.index')"
                          class="text-sm text-gray-700 dark:text-gray-500 underline text-right"
                    >Home
                    </Link>
                </div>
                <!--<img :src="post.image" class="w-full h-64 object-cover rounded-lg" />-->
                <div class="flex justify-between">
                    <div>
                        <h3 class="text-lg font-medium mt-6 font-extrabold">{{ post.title }}</h3>
                        <h3 class="text-lg font-medium mt-6">{{ post.problem }}</h3>
                        <p class="text-gray-600 mt-2">{{ dayjs(post.created_at).fromNow() }}</p>
                        <p class="text-gray-600 mt-2">By {{ post.user.username }}</p>
                    </div>
                    <div class="w-1/3">
                        <img :src="post.image" class="">
                    </div>
                </div>
                <PostResponseList :post-id="post.id"></PostResponseList>

            </div>
        </div>
    </AuthenticatedLayout>

</template>
