<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Edit Locations</h1>
        <ul class="list-none space-y-4">
            <li v-for="location, index in locations" :key="index" class="flex items-center border border-gray-300 rounded-md p-4 shadow-sm">
                <span class="w-full mr-4">{{ location }}</span>
                <button @click="editingLocationIndex(index)" class="text-blue-500 hover:text-blue-700 focus:outline-none">
                    <i class="fas fa-edit"></i>
                </button>
                <button @click="removeLocation(location)" class="ml-4 text-red-500 hover:text-red-700 focus:outline-none">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </li>
        </ul>

        <div v-if="showEditModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 flex items-center justify-center">
            <div class="bg-white rounded-md shadow-md px-8 py-4 max-w-sm">
                <h2 class="text-xl font-bold mb-4">Edit Location</h2>
                <input v-model="editedLocation" ref="editLocationInput" type="text" class="w-full border focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-2 rounded-md" :placeholder="locations[editedIndex]">
                <p class="mt-4" v-if="locationError">This location already exist.</p>
                <div class="flex justify-between mt-4">
                    <button @click="hideEditModal" class="text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded-md shadow-sm focus:outline-none">Cancel</button>
                    <button @click="saveLocation" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Save</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3';
export default {
    name: "EditLocations",
    props: {
        locations: Array,
    },
    data() {
        return {
            showEditModal: false,
            editedIndex: null,
            editedLocation: "",
            locationError: false
        };
    },
    methods: {
        removeLocation(location) {
            console.log("Removing location", location);
        },
        editingLocationIndex(index) {
            this.showEditModal = true;
            this.editedIndex = index;
            this.editedLocation = this.locations[index];
            this.$nextTick(() => {
                this.$refs.editLocationInput.focus();
            });
        },
        hideEditModal() {
            this.showEditModal = false;
            this.editedIndex = null;
            this.editedLocation = "";
        },
        saveLocation() {
            const isDuplicate = this.locations.some(location => location.toLowerCase() === this.editedLocation.toLowerCase());
            if (isDuplicate) {
                this.locationError = true;
                return;
            }
            router.put(route('finder.update.location', {
                oldLocation: this.locations[this.editedIndex],
                newLocation: this.editedLocation
            }));
            this.hideEditModal();
        },
        saveLocationsToBackend(locations) {
            // Replace this with your actual backend communication logic (e.g., using Axios or Fetch API)
            // This is just a placeholder for demonstration
            console.log("Saving locations to backend:", locations);
        },
    },
};
</script>