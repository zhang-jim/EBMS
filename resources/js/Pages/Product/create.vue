<script setup>
import { ref, watch, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    price: 0,
    inventory: 0,
    description: '',
    image: null,
});

//圖片預覽功能
const previewImageUrl = ref(null);
onMounted(() => {
    watch(() => form.image, (newImage) => {
        if (newImage) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImageUrl.value = e.target.result;
            };
            reader.readAsDataURL(newImage);
        } else {
            previewImageUrl.value = null;
        }
    });
});
</script>

<template>
    <Head title="Add Product" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('product.store'), { onSuccess: () => form.reset() })"
                class="flex flex-col items-center">
                <div class="flex mb-4 w-full">
                    <!-- 商品名稱 -->
                    <div class="w-full">
                        <label for="name" class="block text-sm font-medium text-gray-700">商品名稱</label>
                        <input v-model="form.name" type="text" id="name"
                            class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                </div>

                <div class="flex mb-4 w-full">
                    <!-- 商品描述 -->
                    <div class="w-full">
                        <label for="description" class="block text-sm font-medium text-gray-700">商品描述</label>
                        <textarea v-model="form.description" id="description" rows="4"
                            class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                        <InputError :message="form.errors.description" class="mt-2" />
                    </div>
                </div>

                <div class="flex mb-4 w-full">
                    <!-- 圖片上傳 -->
                    <div class="mb-4 w-1/2">
                        <label for="image" class="block text-sm font-medium text-gray-700">商品圖片</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            @change="form.image = $event.target.files[0]"
                            class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <InputError :message="form.errors.image" class="mt-2" />
                    </div>

                    <!-- 圖片預覽 -->
                    <div v-if="previewImageUrl" class="w-1/2 ml-4">
                        <label class="block text-sm font-medium text-gray-700">預覽</label>
                        <img :src="previewImageUrl" alt="Preview" class="mt-1 w-full rounded-md shadow-sm">
                    </div>
                </div>
                <div class="flex mb-4 w-full">
                    <!-- 價錢 -->
                    <div class="w-1/2 ml-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">價錢</label>
                        <input v-model="form.price" type="number" id="price"
                            class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <InputError :message="form.errors.price" class="mt-2" />
                    </div>
                    <!-- 庫存 -->
                    <div class="w-1/2 ml-4">
                        <label for="inventory" class="block text-sm font-medium text-gray-700">庫存</label>
                        <input v-model="form.inventory" type="number" id="inventory"
                            class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <InputError :message="form.errors.inventory" class="mt-2" />
                    </div>
                </div>
                <!-- 新增按鈕 -->
                <PrimaryButton class="w-full mt-4 flex justify-center">新增</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
