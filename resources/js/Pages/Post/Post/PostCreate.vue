<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

import {Head, useForm} from '@inertiajs/vue3';
import {ref} from "vue";

dayjs.extend(relativeTime);
defineProps({post: Object});

const form = useForm({
    title: '',
    problem: '',
    image: 'https://via.placeholder.com/300x300.png/003322?text=Post'
});

const emit = defineEmits(['postCreated']);

const showCreatePostModal = ref(false);

const submit = () => {
    form.post(route('posts.store'), {
        onSuccess: () => closeModal()

    });
};
const closeModal = () => {
    emit('postCreated', true);
    showCreatePostModal.value = false;
    form.reset();
};

</script>

<template>
    <PrimaryButton @click="showCreatePostModal = true" class="mt-4">Create Post</PrimaryButton>

    <modal :show="showCreatePostModal" @close="closeModal">
        <Head title="Create Post"/>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form class="relative px-6 lg:px-8"
                  @submit.prevent="submit">
                <InputLabel class="font-bold text-base">Title</InputLabel>
                <div class="flex">
                    <TextInput
                        id="title"
                        type="text"
                        class="mt-1 block w-10/12"
                        v-model="form.title"
                        placeholder="Title"
                        required
                        autofocus/>
                    <InputError class="mt-2" :message="form.errors.title"/>
                </div>
                <InputLabel class="font-bold text-base">Problem</InputLabel>
                <div class="mb-4 flex">
                    <textarea placeholder="Problem"
                              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-10/12"
                              v-model="form.problem"
                    ></textarea>
                    <InputError class="mt-2" :message="form.errors.problem"/>
                </div>
                <InputLabel class="font-bold text-base">Image</InputLabel>
                <div class="mb-4 flex border-red-500">
                    <input type="url" name="image" id="image"
                           class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-10/12"
                           placeholder="https://via.placeholder.com/300x300.png/003322?text=image"
                           pattern="https://.*" size="30"
                           v-model="form.image"
                           required>
                    <InputError class="mt-2" :message="form.errors.image"/>
                </div>
                <div class="mb-4 flex border-red-500">
                    <div class="w-2/3">
                        <img :src="form.image" class="">
                    </div>
                </div>
                <div class="mb-4">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit"
                                   class="ml-1 mt-1 inline-flex items-center font-medium" variation="primary">
                        Create Post
                    </PrimaryButton>
                </div>
            </form>
        </div>

    </modal>

</template>
