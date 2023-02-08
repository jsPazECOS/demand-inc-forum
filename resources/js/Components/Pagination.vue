<script setup>

const props = defineProps({
    pagination: Object,
    currentPage: Number
});

const emit = defineEmits(['pageChanged']);


const nextPage = (currentPage) => {
    currentPage = currentPage + 1;
    emit('pageChanged', currentPage++);
};

const previousPage = (currentPage) => {
    currentPage = currentPage - 1;
    emit('pageChanged', currentPage);
    console.log("previousPages", currentPage);
};

</script>

<template>
    <div class="my-8 flex ">
        <button
            class="px-4 py-2 bg-gray-800 text-white rounded-lg" @click="previousPage(currentPage)"
            :disabled="currentPage === 1">
            Previous
        </button>
        <button class="px-4 py-2 bg-gray-800 text-white rounded-lg ml-2" @click="nextPage(currentPage)"
                :disabled="currentPage === pagination.last_page">
            Next
        </button>
        <p class="text-orange-400 align-bottom p-3">{{currentPage}} of {{pagination.last_page}}</p>
    </div>
</template>
