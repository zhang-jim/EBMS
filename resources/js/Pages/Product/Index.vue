<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';

const form = useForm({
    // image: null, // Assuming you're dealing with file uploads
    name: '',
    price: 0,
    inventory: 0,
});
</script>

<template>
    <Head title="Add Product" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('product.store'), { onSuccess: () => form.reset() })">
                <!-- <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                    <input v-on:change="form.image" type="file" id="image" accept="image/*" class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <InputError :message="form.errors.image" class="mt-2" />
                </div> -->

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input v-model="form.name" type="text" id="name" class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input v-model="form.price" type="number" id="price" class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <InputError :message="form.errors.price" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="inventory" class="block text-sm font-medium text-gray-700">Inventory</label>
                    <input v-model="form.inventory" type="number" id="inventory" class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <InputError :message="form.errors.inventory" class="mt-2" />
                </div>

                <PrimaryButton class="mt-4">Add Product</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
