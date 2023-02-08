<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import axios from 'axios';

import {onMounted, ref} from 'vue';
import Pagination from "@/Components/Pagination.vue";
import PostResponseCreate from "@/Pages/Post/PostResponse/PostResponseCreate.vue";


const props = defineProps({postId: Number});

let postResponses = ref([]);
let currentPage = ref(1);

let getPostResponses = () => {

    let url = 'posts/' + props.postId + '/responses?page=' + currentPage;

    axios.create({
        baseURL: window.location.origin
    }).get(url)
        .then((res => {
            postResponses.value = res.data;
            currentPage = res.data.current_page;
            console.log(res);
        }))
        .catch(err => {
            console.error(err);
        });
};

onMounted(async () => {
    getPostResponses();
});

const pageChanged = (event) => {
    currentPage = event;
    getPostResponses();
}

const responseCreated = () => {
    getPostResponses();
}

</script>

<template>
    <div class="mt-6 p-xl-4">
        <div class="mb-2 flex justify-between">
            <div class="mb-4"><p class="text-center text-lg font-medium mb-2 font-extrabold">Responses:</p></div>
            <div v-if="$page.props.auth.user">
                <PostResponseCreate :post-id="postId" @responseCreated="responseCreated"/>
            </div>


        </div>
        <ul class="list-disc">
            <li v-for="response in postResponses.data" :key="response.id">
                <p class="text-gray-600 mt-2 ">{{ response.response }}</p>
                <p class="text-gray-600 mt-2">By <a class="font-bold">{{ response.user.username }}</a> - {{
                        dayjs(response.created_at).fromNow()
                    }}</p>
            </li>
        </ul>
        <Pagination v-if="postResponses" :pagination="postResponses" :currentPage="currentPage"
                    @pageChanged="pageChanged">
        </Pagination>
    </div>

</template>
