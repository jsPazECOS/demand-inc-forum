<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

import Modal from '@/Components/Modal.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

import {Head, useForm} from '@inertiajs/vue3';
import {ref} from "vue";

dayjs.extend(relativeTime);
defineProps({postId: Number});

const form = useForm({
    response: '',
    image: null
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
                <div class="mb-4 flex">
                    <textarea placeholder="Problem"
                              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-10/12"
                              v-model="form.response"
                    ></textarea>
                    <InputError class="mt-2" :message="form.errors.response"/>
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
