<script setup>
import PostItem from "@/Pages/Post/Post/PostItem.vue";
import PostCreate from "@/Pages/Post/Post/PostCreate.vue";
import Pagination from "@/Components/Pagination.vue";
import {onMounted, ref} from "vue";
import axios from "axios";

defineProps({posts: Object});

let posts = ref([]);
let currentPage = ref(1);
let searchText = null;

let getPostResponses = () => {
    let url = 'posts?page=' + currentPage;
    if (searchText !== null)
        url += "&filters=title|like|" + searchText;
    axios.create({
        baseURL: window.location.origin
    }).get(url)
        .then((res => {
            posts.value = res.data;
            currentPage = res.data.current_page;
            console.log(res.data);
        }))
        .catch(err => {
            console.error(err);
        });
};

onMounted(async () => {
    getPostResponses();
});

const pageChanged = (event) => {
    console.log('pageChanged', event);
    currentPage = event;
    getPostResponses();
}

const postCreated = () => {
    getPostResponses();
}

const searchByTitle = () => {
    currentPage = 1;
    getPostResponses();
}
</script>

<template>
    <div>
        <div class="mb-2 flex justify-between">
            <div class="">
                <input type="text" class="border border-gray-400 p-2 rounded-lg"
                       placeholder="Search by title" v-model="searchText"/>
                <button class="ml-2 px-4 py-2 bg-gray-800 text-white rounded-lg"
                        @click="searchByTitle">
                    Search
                </button>
            </div>
            <div class="mb-4"><p class="text-center text-white underline text-2xl">Posts List</p></div>
            <div v-if="$page.props.auth.user">
                <PostCreate @postCreated="postCreated"/>
            </div>
        </div>
    </div>
    <div>

        <div class="grid grid-cols-5 gap-4">
            <PostItem v-for="post in posts.data" :post="post"/>

        </div>
    </div>
    <Pagination v-if="posts" :pagination="posts" :currentPage="currentPage"
                @pageChanged="pageChanged">
    </Pagination>
</template>
