<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import PrimaryButton from '@/Components/PrimaryButton.vue';

dayjs.extend(relativeTime);
defineProps(['post']);

</script>

<template>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <img :src="post.image" class="w-full h-64 object-cover rounded-lg" />
        <h3 class="text-lg font-medium mt-6">{{ post.title }}</h3>
        <p class="text-gray-600 mt-2">{{ dayjs(post.created_at).fromNow() }}</p>
        <p class="text-gray-600 mt-2">By {{ post.username }}</p>
        <div class="mt-6">
            <h4 class="text-lg font-medium mb-2">Responses:</h4>
            <ul>
                <li v-for="response in post.responses" :key="response.id">
                    {{ response.text }}
                </li>
            </ul>
        </div>
    </div>
</template>
