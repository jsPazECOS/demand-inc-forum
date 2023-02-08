<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import {Head, Link} from '@inertiajs/vue3';

dayjs.extend(relativeTime);
const props = defineProps({
    post: Object
});

</script>

<template>

    <div class="mx-auto mb-6">
        <div class="bg-white p-6 rounded-lg shadow-lg max-h-96 w-full">
            <div class="flex justify-between">
                <!--<img :src="post.image" class="w-full h-64 object-cover rounded-lg" />-->
                <p class="text-gray-600 mt-2 align-top">{{ post.user.username }}</p>
                <p class="text-gray-600 mt-2 inline-block align-bottom text-xs">
                    {{ dayjs(post.created_at).fromNow() }}</p>
            </div>
            <div class="flex justify-between">
                <h3 class="text-lg font-medium mt-6">{{ post.title }}</h3>
            </div>
            <div class="flex justify-between">
                <p class="text-gray-600 mt-2 text-xs align-top">Responses: {{ post.responses_count }}</p>
                <Link :href="route('posts.show', post.id)"
                      class="text-sm text-gray-700 dark:text-gray-500 underline text-right"
                >View Post
                </Link>
            </div>
        </div>
    </div>
</template>
