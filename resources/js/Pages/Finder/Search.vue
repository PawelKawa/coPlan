<template>
    <div>
        <div class="flex justify-between w-full max-w-md mx-auto">
            <Link :href="route('finder.show.add')">Add item</Link>
            <Link :href="route('finder.show.search')">Search item</Link>
        </div>
    </div>
</template>



<script>
import { Link } from '@inertiajs/vue3';

export default {
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