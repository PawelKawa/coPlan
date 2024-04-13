<template>
    <div class="w-full max-w-md mx-auto">
        <FinderMenu></FinderMenu>

        <h1 class="text-2xl font-bold mb-4 mt-8">Edit Tags</h1>
        <ul class="list-none space-y-4">
            <li v-for="tag, index in tags" :key="index" class="flex items-center border border-gray-300 rounded-md p-4 shadow-sm">
                <span class="w-full mr-4 text-white">{{ tag }}</span>
                <div class="flex gap-4">
                    <button @click="editTag(index)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                    <button @click="deleteTag(index)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </div>
            </li>
        </ul>

        <div v-if="showEditModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 flex items-center justify-center">
            <div class="bg-white rounded-md shadow-md px-8 py-4 max-w-sm">
                <h2 class="text-xl font-bold mb-4">Edit Location</h2>
                <input v-model="editedTag" ref="editTagInput" type="text" class="w-full border focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-2 rounded-md" :placeholder="tags[editedIndex]">
                <p class="mt-4" v-if="tagError">This tag already exist.</p>
                <div class="flex justify-between mt-4">
                    <button @click="hideEditModal" class="text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded-md shadow-sm focus:outline-none">Cancel</button>
                    <button @click="updateTag" class="bg-green-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Save</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { router } from '@inertiajs/vue3';
import FinderMenu from "@/Components/Finder/Menu.vue"

export default {
    name: "EditTags",
    props: {
        tags: Array,
    },
    components: {
        FinderMenu,
    },
    data() {
        return {
            showEditModal: false,
            editedIndex: null,
            editedTag: "",
            tagError: false
        };
    },
    methods: {
        removeLocation(location) {
            console.log("Removing location", location);
        },
        editTag(index) {
            this.showEditModal = true;
            this.editedIndex = index;
            this.editedTag = this.tags[index];
            this.$nextTick(() => {
                this.$refs.editTagInput.focus();
            });
        },
        hideEditModal() {
            this.showEditModal = false;
            this.editedIndex = null;
            this.editedTag = "";
            this.tagError = false;
        },
        updateTag() {
            const isDuplicate = this.tags.some(tag => tag.toLowerCase() === this.editedTag.toLowerCase());
            if (isDuplicate) {
                this.tagError = true;
                return;
            }
            router.put(route('finder.update.tag', {
                oldTag: this.tags[this.editedIndex],
                newTag: this.editedTag
            }));
            this.hideEditModal();
        },
    },
};
</script>