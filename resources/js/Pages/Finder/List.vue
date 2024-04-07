<template>

    <FinderMenu></FinderMenu>

    <table class="mt-4 w-full border border-gray-400 text-white shadow-md rounded-lg">
        <thead>
            <tr>
                <th class="text-sm font-medium text-left px-4 py-2 border-b border-gray-500 bg-gray-700">
                    No
                </th>
                <th class="text-sm font-medium text-left px-4 py-2 border-b border-gray-500 bg-gray-700">
                    Item name
                </th>
                <th class="text-sm font-medium text-left px-4 py-2 border-b border-gray-500 bg-gray-700">
                    Item description
                </th>
                <th class="text-sm font-medium text-left px-4 py-2 border-b border-gray-500 bg-gray-700">
                    Location
                </th>
                <th class="text-sm font-medium text-left px-4 py-2 border-b border-gray-500 bg-gray-700">
                    Location description
                </th>
                <th class="text-sm font-medium text-left px-4 py-2 border-b border-gray-500 bg-gray-700">
                    Tags
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in items" :key="index">
                <td class="text-sm text-gray-200 px-4 py-2 border-b border-gray-500">
                    {{ index + 1 }}
                </td>
                <td class="text-sm text-gray-200 px-4 py-2 border-b border-gray-500">
                    {{ item.item }}
                </td>
                <td class="text-sm text-gray-200 px-4 py-2 border-b border-gray-500">
                    {{ item.item_description }}
                </td>
                <td class="text-sm text-gray-200 px-4 py-2 border-b border-gray-500" @click="showItemsInLocation(item.location)">
                    <div class="inline mx-1 px-2 py-1 text-xs rounded-full bg-gray-500 text-white cursor-pointer">{{ item.location }}</div>
                </td>
                <td class="text-sm text-gray-200 px-4 py-2 border-b border-gray-500">
                    {{ item.location_description }}
                </td>
                <td class="text-sm text-gray-200 px-4 py-2 border-b border-gray-500">
                    <div v-for="(tag, index) in item.tags" class="inline mx-1 px-2 py-1 text-xs rounded-full bg-gray-500 text-white cursor-pointer" @click="showItemsWithTag(tag.id)">
                        {{ tag.name }}
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

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
    }
};
</script>