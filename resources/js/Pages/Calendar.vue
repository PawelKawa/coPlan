<template>
    <div class="p-4">
        <!-- <Calendar /> -->
        <div class="flex justify-center">
            <DatePicker v-model="date" mode="date" is-required :attributes="attributes" class="mx-auto" />
        </div>

        <div class="bg-white mt-8 p-4">
            <p class="text-center text-3xl">{{ formattedDate }}</p>
            <p>Things to do:</p>
            <div>
                <ul>
                    <li v-for="(todo, index) in todos" :key="index">
                        {{ index + 1 }}. {{ todo }}
                    </li>
                </ul>
            </div>
            <div class="flex justify-center gap-5">
                <input class="border w-full px-2 py-1" type="text" v-model="singleTask" @keydown.enter="addTask(singleTask)">
                <button @click="addTask(singleTask)" 
                    class=" w-40 bg-green-200 py-2 text-center rounded">
                    Add task <i class="fa-solid fa-plus ml-4"></i>
                </button>
            </div>
            <div class="mt-8 flex justify-center">
                <button @click="saveTasks" 
                    class="bg-green-700 py-1 px-4 text-white rounded">
                    Save tasks
                </button>
            </div>
        </div>
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
    data() {
        return {
            date: new Date(),
            singleTask: "",
            todos: [],
            attributes: [
                {
                    dot: true,
                    dates: [
                        // 0 is January, 1 is February
                        new Date(2024, 1, 1),
                        new Date(2024, 1, 10),
                        new Date(2024, 1, 22),
                    ],
                },
                {
                    dot: 'red',
                    dates: [
                        new Date(2024, 1, 4),
                        new Date(2024, 1, 10),
                        new Date(2024, 1, 15),
                    ],
                },
            ]
        };
    },
    mounted() {
        // Debounce the handleDateChange method with a delay of 500ms
        this.debouncedHandleDateChange = debounce(this.handleDateChange, 500);
    },
    computed: {
        formattedDate() {
            return this.date.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            });
        }
    },
    methods: {
        addTask(task){
            this.todos.push(task);
            this.singleTask = "";
        },
        saveTasks() {
            console.log(this.todos);
        },
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
  