<template>
        <div class="flex justify-around w-full max-w-md mx-auto">
            <Link :href="route('finder')">List of items</Link>
            <Link :href="route('finder.show.add')">Add item</Link>
        </div>
</template>



<script>
import { Link } from '@inertiajs/vue3';

export default {
    name: 'FinderMenu',
    components:{
        Link,
    },
    data() {
        return {

        };
    },
    methods: {

    }
};
</script>