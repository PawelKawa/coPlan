<template>

    <FinderMenu></FinderMenu>

    <form @submit.prevent="submit" class="flex justify-center items-center mt-4 gap-4">
        <label for="search">Search for item:</label>
        <input type="text" id="search" class="p-1" v-model="search" placeholder="Search with 3+ chars">
        <button type="submit">Search</button>
    </form>

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
                    <div v-for="(tag, index) in item.tags" :key="index" class="px-2 py-1 text-xs rounded-full bg-gray-500 text-white cursor-pointer truncate" @click="showItemsWithTag(tag.name)">
                        {{ tag.name }}
                    </div>
                </div>
                <div class="flex items-center gap-1 ml-auto">
                    <Link class="text-blue-500 hover:text-blue-700" :href="route('finder.show.edit', { id: item.id })" method="GET" as="Button">
                    <i class="fas fa-edit"></i>
                    </Link>
                    <span class="text-red-500 hover:text-red-700 cursor-pointer" @click="deleteItem(item.id, item.item)">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </div>
            </li>
        </ul>
    </div>

</template>



<script>
import FinderMenu from "../../Components/Finder/Menu.vue"
import { Link, router } from '@inertiajs/vue3';

export default {
    components: {
        Link, FinderMenu,
    },
    props: {
        items: Array,
        errors: Object, // im not using this, but getting warnings from vue
        flash: Object, // im not using this, but getting warnings from vue
        user: String, // im not using this, but getting warnings from vue
    },
    data() {
        return {
            search: '',
        };
    },
    methods: {
        submit() {
            if (this.search.length >= 3) {
                router.get(route('finder.search', { search: this.search }))
            } else {
                this.$page.props.flash.info = 'Type 3 characters at leaset to search'
            }
        },
        showItemsWithTag(tag) {
            // name is passed to url /finder/tags/{name} -> web.php and id to backend
            // i could use only name to search by name instead of id... as it is causing issues when refreshing page due to browser default method is GET
            // now it is not throwing error but not fetching data propely
            router.get(route('finder.tags', { tag: tag }));
        },
        showItemsInLocation(location) {
            router.get(route('finder.location', { location: location }));
        },
        deleteItem(id, name) {
            if (window.confirm("Are you sure you want to delete" + " " + name + "?")) {
                router.delete(route('finder.delete', { id: id }));
            }
        },
    }
};
</script>