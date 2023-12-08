<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
defineProps(['productData']);

const isEditing = ref(false);
const editingProductId = ref(null);
const form = useForm({
    name: '',
    description: '',
    price: 0,
    inventory: 0,
    image: null,
});
const setFormFields = (product) => {
    form.name = product.name;
    form.description = product.description;
    form.price = product.price;
    form.inventory = product.inventory;
};
const handleEdit = (product) => {
    isEditing.value = true;
    editingProductId.value = product.id;
    setFormFields(product);
};
const handleCancel = () => {
    isEditing.value = false;
    form.reset();
    form.clearErrors();
};
</script>

<template>
    <Head title="Product List" />
    <AuthenticatedLayout>
        <table class="mx-auto mt-6 w-4/5 text-center bg-white shadow-sm rounded-lg divide-y">
            <thead>
                <tr>
                    <th class="p-3">商品名稱</th>
                    <th class="p-3">商品描述</th>
                    <th class="p-3">價格</th>
                    <th class="p-3">庫存</th>
                    <th class="p-3">圖片</th>
                    <th class="p-3">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in productData" :key="product.id" :product="product">
                    <td class="p-3">{{ product.name }}</td>
                    <td class="p-3">{{ product.description }}</td>
                    <td class="p-3">{{ product.price }}</td>
                    <td class="p-3">{{ product.inventory }}</td>
                    <td class="p-3">
                        <img :src="product.image" alt="Product Image" class="w-16 h-16 object-cover rounded-full">
                    </td>
                    <td class="p-3">
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
                                    @click="handleEdit(product)">
                                    Edit
                                </button>
                                <DropdownLink as="button" :href="route('product.destroy', product.id)" method="delete">
                                    Delete
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="w-4/5 mx-auto">
            <form v-if="isEditing"
                @submit.prevent="form.put(route('product.update', editingProductId), { onSuccess: () => isEditing = false })">
                <div class="mt-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">商品名稱</label>
                    <input v-model="form.name" type="text" id="name"
                        class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">商品描述</label>
                    <textarea v-model="form.description" id="description" rows="4"
                        class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                    <InputError :message="form.errors.description" class="mt-2" />
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

                <div class="mt-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">商品圖片</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        @change="form.image = $event.target.files[0]"
                        class="mt-1 p-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <InputError :message="form.errors.image" class="mt-2" />
                </div>
                <div class="mt-4" v-if="form.image">
                    <label class="block text-sm font-medium text-gray-700">預覽</label>
                    <img :src="URL.createObjectURL(form.image)" alt="Preview"
                        class="mt-1 w-16 h-16 object-cover rounded-full">
                </div>

                <div class="space-x-2 mt-4">
                    <PrimaryButton>Save</PrimaryButton>
                    <button @click="handleCancel()">Cancel</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
  

