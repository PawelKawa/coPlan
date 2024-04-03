<template>
    <div>
        <div class="flex justify-between w-full max-w-md mx-auto">
            <Link :href="route('finder.show.add')">Add item</Link>
            <Link :href="route('finder.show.search')">Search item</Link>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "Add",
    components: {
        Link,
    },
    data() {
        return {
            showAddItem: true,
            showSearchItem: false,
            showDisplayItem: false,
        };
    },
    methods: {

    }
};
</script>