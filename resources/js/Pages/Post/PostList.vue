<script setup>
import PostItem from "@/Pages/Post/PostItem.vue";
import PostCreate from "@/Pages/Post/PostCreate.vue";

defineProps({posts: Object});

</script>

<template>
    <div>
        <div class="mb-2">
            <div class="">
                <input type="text" class="border border-gray-400 p-2 rounded-lg"
                       placeholder="Search by title"/>
                <button class="ml-2 px-4 py-2 bg-gray-800 text-white rounded-lg">
                    Search
                </button>
            </div>
            <div class="mb-4"><p class="text-center text-white underline text-2xl">Posts List</p></div>
            <div>
                <PostCreate/>
            </div>
        </div>

    </div>
    <div>

        <div class="grid grid-cols-5 gap-4">
            <PostItem
                v-for="post in posts.data"
                :key="post.id"
                :post="post"
            />
        </div>
    </div>
    <div class="my-8">
        <button
            class="px-4 py-2 bg-gray-800 text-white rounded-lg"
            :disabled="posts.current_page === 1"
        >
            Previous
        </button>
        <button
            class="px-4 py-2 bg-gray-800 text-white rounded-lg ml-2"
            :disabled="posts.current_page === posts.last_page"
        >
            Next
        </button>
    </div>
</template>
