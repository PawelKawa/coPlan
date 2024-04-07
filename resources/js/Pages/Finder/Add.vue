<template>
    <div class=" w-full max-w-md mx-auto">
        <FinderMenu></FinderMenu>

        <div class="p-6 bg-white rounded-md shadow-md mt-8">
            <h2 class="text-xl font-semibold mb-4">Add Item</h2>
            <!-- with helper (useForm) -->
            <!-- <form @submit.prevent="form.post(route('finder.update'))"> -->
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="itemName">Item Name<span class="text-red-500">*</span></label>
                    <input v-model="form.itemName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="itemName" type="text" placeholder="Enter item name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="itemDescription">Item Description</label>
                    <textarea v-model="form.itemDescription" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="itemDescription" placeholder="Enter item description"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="location">Location<span class="text-red-500">*</span></label>
                    <input v-model="form.location" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="location" type="text" placeholder="Enter location">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="locationDescription">Location Description</label>
                    <textarea v-model="form.locationDescription" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="locationDescription" placeholder="Enter location description"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tags">Tags<span class="text-red-500">*</span></label>
                    <input v-model="tagInput" @keydown.enter.prevent="addTag" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tags" type="text" placeholder="Add tags (press Enter)">
                </div>
                <div class="mb-4">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2" v-for="(tag, index) in form.tags" :key="index">
                        {{ tag }}
                        <button type="button" class="ml-2 text-red-500 relative bottom-1" @click="removeTag(index)"> x </button>
                    </span>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" :disabled="form.processing">Add Item</button>
            </form>
        </div>
    </div>
</template>

<script>
import { router, useForm, Link } from '@inertiajs/vue3';
import FinderMenu from "../../Components/Finder/Menu.vue"

export default {
    components: {
        Link, FinderMenu,
    },
    data() {
        return {
            form: useForm({
                itemName: '',
                itemDescription: '',
                location: '',
                locationDescription: '',
                tags: []
            }),
            tagInput: '',
        };
    },
    methods: {
        submit() {
            router.post(route('finder.create'), this.form, {
                // onSuccess: () => {
                //     this.resetForm();
                // },
            });
        },
        addTag() {
            if (this.tagInput.trim() !== '') {
                this.form.tags.push(this.tagInput.trim().toLocaleLowerCase());
                this.tagInput = '';
            }
        },
        removeTag(index) {
            this.form.tags.splice(index, 1);
        },
        resetForm() {
            this.form.itemName = '';
            this.form.itemDescription = '';
            this.form.location = '';
            this.form.locationDescription = '';
            this.form.tags = [];
        },
    }
};
</script>