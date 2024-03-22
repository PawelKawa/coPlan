<template>
    <div class="flex justify-center">
        <div class="w-full max-w-md p-6 bg-white rounded-md shadow-md">
            <h2 class="text-xl font-semibold mb-4">Add Item</h2>
            <form @submit.prevent="addItem">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="itemName">Item Name</label>
                    <input v-model="itemName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="itemName" type="text" placeholder="Enter item name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="itemDescription">Item Description</label>
                    <textarea v-model="itemDescription" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="itemDescription" placeholder="Enter item description"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="location">Location</label>
                    <input v-model="location" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="location" type="text" placeholder="Enter location">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="locationDescription">Location Description</label>
                    <textarea v-model="locationDescription" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="locationDescription" placeholder="Enter location description"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tags">Tags</label>
                    <input v-model="tagInput" @keydown.enter.prevent="addTag" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tags" type="text" placeholder="Add tags (press Enter)">
                </div>
                <div class="mb-4">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2" v-for="(tag, index) in tags" :key="index">
                        {{ tag }}
                        <button type="button" class="ml-2 text-red-500 relative bottom-1" @click="removeTag(index)"> x </button>
                    </span>
                </div>

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Add Item</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            itemName: '',
            itemDescription: '',
            location: '',
            locationDescription: '',
            tagInput: '',
            tags: []
        };
    },
    methods: {
        addItem() {
            // Here you can send a request to your backend to add the item with the provided data
            console.log('Item Name:', this.itemName);
            console.log('Item Description:', this.itemDescription);
            console.log('Location:', this.location);
            console.log('Location Description:', this.locationDescription);
            console.log('Tags:', this.tags);

            // Reset form fields after submitting
            this.itemName = '';
            this.itemDescription = '';
            this.location = '';
            this.locationDescription = '';
            this.tagInput = '';
            this.tags = [];
        },
        addTag() {
            if (this.tagInput.trim() !== '') {
                this.tags.push(this.tagInput.trim());
                this.tagInput = '';
            }
        },
        removeTag(index) {
            this.tags.splice(index, 1);
        }
    }
};
</script>