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
defineProps(['post']);

const form = useForm({
    title: '',
    problem: '',
    image: null
});
const showCreatePostModal = ref(false);

const submit = () => {
    form.post(route('posts.store'), {
        onFinish: () => {
            form.reset();
            this.showCreatePostModal = false
        }

    });
};

</script>

<template>
    <PrimaryButton @click="showCreatePostModal = true" class="mt-4">Create Post</PrimaryButton>

    <modal :show="showCreatePostModal" @close="() => { showCreatePostModal = false}">
        <Head title="Create Post"/>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form class="relative px-6 lg:px-8"
                  @submit.prevent="submit">
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
                <div class="mb-4 flex">
                    <textarea placeholder="Problem"
                              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-10/12"
                              v-model="form.problem"
                    ></textarea>
                    <InputError class="mt-2" :message="form.errors.problem"/>
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
