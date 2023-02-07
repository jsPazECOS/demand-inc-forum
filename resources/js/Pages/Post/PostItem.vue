<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import PrimaryButton from '@/Components/PrimaryButton.vue';

dayjs.extend(relativeTime);
defineProps(['post']);
</script>

<template>

    <div class="mx-auto mb-6">
        <div class="bg-white p-6 rounded-lg shadow-lg max-h-96">
            <div class="flex justify-between">
                <!--<img :src="post.image" class="w-full h-64 object-cover rounded-lg" />-->
                <p class="text-gray-600 mt-2 align-top text-right">{{ post.user.username }}</p>
                <p class="text-gray-600 mt-2 inline-block align-bottom text-xs">{{ dayjs(post.created_at).fromNow()}}</p>
            </div>
            <div class="flex justify-between">

                <h3 class="text-lg font-medium mt-6">{{ post.title }}</h3>

            </div>
            <p class="text-gray-600 mt-2 text-xs">Responses: {{ post.responses_count }}</p>
            <PrimaryButton class="mt-4">Post</PrimaryButton>
        </div>
    </div>
</template>
