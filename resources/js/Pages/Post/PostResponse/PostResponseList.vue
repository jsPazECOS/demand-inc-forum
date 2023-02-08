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

            <div class="flex justify-center m-x-8 bg-white p-6 rounded-lg shadow-lg max-h-96 w-full gap-2 ">
                <div v-for="response in postResponses.data" :key="response.id" class="p-x-4 border-2 border-gray-300  min-w-[30%]">
                    <div class="flex justify-center m-x-8">
                        <div class="w-2/3">
                            <p class="text-gray-600 m-4 ">{{ response.response }}</p>
                            <p class="text-gray-600 mt-2">By <a class="font-bold">{{ response.user.username }}</a> - {{
                                    dayjs(response.created_at).fromNow()
                                }}</p>
                        </div>
                        <div class="w-1/4">
                            <img :src="response.image" class="">
                        </div>
                    </div>
                </div>
            </div>
        <Pagination v-if="postResponses" :pagination="postResponses" :currentPage="currentPage"
                    @pageChanged="pageChanged">
        </Pagination>
    </div>

</template>
