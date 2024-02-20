<template>
    <div>
        <!-- <Calendar /> -->
        <DatePicker v-model="date" mode="date" is-required :attributes="attributes" />
    </div>
</template>
    
<script>
import { Calendar, DatePicker } from 'v-calendar';
import 'v-calendar/style.css';
import { debounce } from 'lodash';

export default {
    components: {
        Calendar,
        DatePicker,
    },
    mounted() {
        // Debounce the handleDateChange method with a delay of 500ms
        this.debouncedHandleDateChange = debounce(this.handleDateChange, 500);
    },
    data() {
        return {
            date: new Date(),
            attributes: [
                {
                    dot: true,
                    dates: [
                        // 0 is January, 1 is February
                        new Date(2024, 0, 1),
                        new Date(2024, 0, 10),
                        new Date(2024, 0, 22),
                    ],
                },
                {
                    dot: 'red',
                    dates: [
                        new Date(2024, 0, 4),
                        new Date(2024, 0, 10),
                        new Date(2024, 0, 15),
                    ],
                },
            ]
        };
    },
    methods: {
        handleDateChange(date) {
            console.log('Selected date:', date);
            // Call your backend API here
        }
    },
    watch: {
        date(newDate) {
            // Call the debounced handleDateChange method when the date changes
            this.debouncedHandleDateChange(newDate);
        }
    }
}
</script>
  