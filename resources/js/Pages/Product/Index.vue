<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ProductList from '@/Components/ProductList.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['productData']);

const form = useForm({
    name: '',
    price: 0,
    inventory: 0,
});
</script>

<template>
    <Head title="Add Product" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('product.store'), { onSuccess: () => form.reset() })"
                class="flex flex-col">
                <div class="flex mb-4">
                    <!-- 商品名稱 -->
                    <div class="w-1/3">
                        <label for="name" class="block text-sm font-medium text-gray-700">商品名稱</label>
                        <input v-model="form.name" type="text" id="name"
                            class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                    
                    <!-- 價錢 -->
                    <div class="w-1/3 ml-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">價錢</label>
                        <input v-model="form.price" type="number" id="price"
                            class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <InputError :message="form.errors.price" class="mt-2" />
                    </div>

                    <!-- 庫存 -->
                    <div class="w-1/3 ml-4">
                        <label for="inventory" class="block text-sm font-medium text-gray-700">庫存</label>
                        <input v-model="form.inventory" type="number" id="inventory"
                            class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <InputError :message="form.errors.inventory" class="mt-2" />
                    </div>

                    <!-- 圖片上傳 -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">商品圖片</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    </div>
                </div>

                <PrimaryButton class="mt-4">新增</PrimaryButton>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <ProductList v-for="product in productData" :key="product.id" :product="product" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
