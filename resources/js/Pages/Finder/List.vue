<template>

    <FinderMenu></FinderMenu>

    <div class="w-full overflow-x-auto px-2">
        <ul class="mt-4 w-full border border-gray-400 text-white shadow-md rounded-lg">
            <li class="flex items-center px-4 py-2 border-b border-white gap-1">
                <div class="w-10">No</div>
                <div class="w-32">Item name</div>
                <div class="w-48">Item description</div>
                <div class="w-24">Location</div>
                <div class="w-48">Location description</div>
                <div class="">Tags</div>
            </li>
            <li v-for="(item, index) in items" :key="index" class="text-sm text-gray-200 px-4 py-2 border-b border-gray-500 flex items-center gap-1">
                <div class="w-10">{{ index + 1 }}</div>
                <div class="w-32 truncate">{{ item.item }}</div>
                <div class="w-48 truncate">{{ item.item_description }}</div>
                <div class="w-24">
                    <span class="px-2 py-1 text-xs rounded-full bg-gray-500 text-white truncate cursor-pointer" @click="showItemsInLocation(item.location)">{{ item.location }}</span>
                </div>
                <div class="w-48 truncate">{{ item.location_description }}</div>
                <div class="flex flex-wrap gap-1">
                    <div v-for="(tag, index) in item.tags" :key="index" class="px-2 py-1 text-xs rounded-full bg-gray-500 text-white cursor-pointer truncate" @click="showItemsWithTag(tag.id)">
                        {{ tag.name }}
                    </div>
                </div>
                <div class="flex items-center gap-1 ml-auto">
                    <Link class="text-blue-500 hover:text-blue-700" :href="route('finder.show.edit', { id: item.id })" method="GET" as="Button">
                    <i class="fas fa-edit"></i>
                    </Link>
                    <span class="text-red-500 hover:text-red-700 cursor-pointer" @click="deleteItem(item.id)">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </div>
            </li>
        </ul>
    </div>




</template>



<script>
import FinderMenu from "../../Components/Finder/Menu.vue"
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link, FinderMenu,
    },
    props: {
        items: Array,
    },
    data() {
        return {

        };
    },
    methods: {
        showItemsWithTag(id) {
            console.log(id);
        },
        showItemsInLocation(location) {
            console.log(location);
        },
        editItem(id) {
            console.log(id);
        },
        deleteItem(id) {
            console.log(id);
        },
    }
};
</script>