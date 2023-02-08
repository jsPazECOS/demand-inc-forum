<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

import Modal from '@/Components/Modal.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";

import {Head, useForm} from '@inertiajs/vue3';
import {ref} from "vue";

dayjs.extend(relativeTime);
defineProps({postId: Number});

const form = useForm({
    response: '',
    image: 'https://via.placeholder.com/300x300.png/003322?text=response'
});
const emit = defineEmits(['responseCreated']);

const showCreateResponseModal = ref(false);

const submit = (postId) => {
    form.post(route('responses.store', postId), {
        onSuccess: () => closeModal()
    });
};

const closeModal = () => {
    emit('responseCreated', true);
    showCreateResponseModal.value = false;
    form.reset();
};

</script>

<template>
    <PrimaryButton @click="showCreateResponseModal = true" class="mt-4">Create Response</PrimaryButton>

    <modal :show="showCreateResponseModal" @close="closeModal">
        <Head title="Create Post"/>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form class="relative px-6 lg:px-8"
                  @submit.prevent="submit(postId)">
                <InputLabel class="font-bold text-base">Response</InputLabel>
                <div class="mb-4 flex">

                    <textarea placeholder="Response"
                              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-10/12"
                              v-model="form.response"
                    ></textarea>
                    <InputError class="mt-2" :message="form.errors.response"/>
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
                        Create Response
                    </PrimaryButton>
                </div>
            </form>
        </div>

    </modal>

</template>
