<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import {Head } from '@inertiajs/vue3';

defineProps(['productData']);
</script>

<template>
    <Head title="Add Product" />
    <AuthenticatedLayout>
        <div v-for="product in productData" :key="product.id" :productData="product"
            class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6 flex space-x-2">
                <div class="flex-1">
                    <div class="flex items-center">
                        <ul>
                            <li class="text-gray-800">商品名稱：{{ product.name }}</li>
                            <li class="text-gray-800">價格：{{ product.price }}</li>
                            <li class="text-gray-800">庫存：{{ product.inventory }}</li>
                        </ul>
                        <Dropdown>
                            <template #trigger>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
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
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


