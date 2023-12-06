<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps(['product']);
const form = useForm({
    name: props.product.name,
    price: props.product.price,
    inventory: props.product.inventory,
});
const editing = ref(false);
</script>

<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <ul>
                    <li class="text-gray-800">商品名稱：{{ product.name }}</li>
                    <li class="text-gray-800">價格：{{ product.price }}</li>
                    <li class="text-gray-800">庫存：{{ product.inventory }}</li>
                </ul>
                <Dropdown>
                    <template #trigger>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <button
                            class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out"
                            @click="editing = true">
                            Edit
                        </button>
                        <DropdownLink as="button" :href="route('product.destroy', product.id)" method="delete">
                            Delete
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
            <form v-if="editing"
                @submit.prevent="form.put(route('product.update', product.id), { onSuccess: () => editing = false })">
                <div class="mt-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">商品名稱</label>
                    <input v-model="form.name" type="text" id="name"
                        class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">價格</label>
                    <input v-model="form.price" type="number" id="price"
                        class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <InputError :message="form.errors.price" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="inventory" class="block text-sm font-medium text-gray-700">庫存</label>
                    <input v-model="form.inventory" type="number" id="inventory"
                        class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <InputError :message="form.errors.inventory" class="mt-2" />
                </div>

                <div class="space-x-2 mt-4">
                    <PrimaryButton>Save</PrimaryButton>
                    <button @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</template>

