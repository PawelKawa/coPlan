<template>
    <div class="bg-white p-4 rounded-xl">
        <div class="flex gap-5">
            <button @click="showNextTimeList = true" class="w-1/2 p-2 bg-blue-300 rounded" :class="{ 'uppercase text-xl': showNextTimeList }">next time</button>
            <button @click="showNextTimeList = false" class="w-1/2 p-2 bg-blue-300 rounded" :class="{ 'uppercase text-xl': !showNextTimeList }">some time</button>
        </div>

        <div v-if="showNextTimeList">
            <div class="mt-8 flex gap-5">
                <input class="border w-full px-2 py-1" type="text" v-model="nextItem" @keydown.enter="addNextTimeItem(nextItem)">
                <button @click="addNextTimeItem(nextItem)" class="w-40 bg-green-200 py-2 text-center rounded">
                    Add Item
                </button>
            </div>
            <ul class="mt-8">
                <li class="my-2 flex justify-between p-2 bg-gray-400 cursor-pointer" v-for="(item, index) in nextTimeList" :key="index"
                    @click="toggleInBasket(index)">
                    <p :class="{ 'line-through': item.inBasket }">
                        {{ index + 1 }}. {{ item.text }}
                    </p>
                    <div class="w-6 h-6  flex justify-center items-center" :class="item.inBasket ? 'bg-green-600' : 'bg-white'">
                        <i v-if="item.inBasket" class="fa-solid fa-check text-white"></i>
                    </div>
                </li>
            </ul>
        </div>

        <div v-else>
            <div class="mt-8 flex gap-5">
                <input class="border w-full px-2 py-1" type="text" v-model="someItem" @keydown.enter="addSomeTimeItem(someItem)">
                <button @click="addSomeTimeItem(someItem)" class="w-40 bg-green-200 py-2 text-center rounded">
                    Add Item
                </button>
            </div>
            <ul class="mt-8">
                <li class="my-2 flex justify-between p-2 bg-gray-400 cursor-pointer" v-for="(item, index) in someTimeList" :key="index"
                    @click="toggleInBasket(index)">
                    <p :class="{ 'line-through': item.inBasket }">
                        {{ index + 1 }}. {{ item.text }}
                    </p>
                    <div class="w-6 h-6  flex justify-center items-center" :class="item.inBasket ? 'bg-green-600' : 'bg-white'">
                        <i v-if="item.inBasket" class="fa-solid fa-check text-white"></i>
                    </div>
                </li>
            </ul>
        </div>

        <div class="mt-8 flex justify-center">
            <button @click="saveShopping" class="bg-green-700 py-1 px-4 text-white rounded">
                Save Shopping list
            </button>
        </div>
    </div>

</template>

<script>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
export default {
    name: 'shopping',
    components:{
        Link,
    },
    props: {
        nextTimeList:Object,
        someTimeList:Object,
    },
    data() {
        return {
            showNextTimeList: true,
            nextItem: '',
            someItem: '',
        }
    },
    methods: {
        addNextTimeItem(item) {
            if (item.trim() !== '') {
                this.nextTimeList.push({ text: item, inBasket: false });
                this.nextItem = '';
            }
        },
        addSomeTimeItem(item) {
            if (item.trim() !== '') {
                this.someTimeList.push({ text: item, inBasket: false });
                this.someItem = '';
            }
        },
        toggleInBasket(index) {
            const list = this.showNextTimeList ? this.nextTimeList : this.someTimeList;
            const item = list.splice(index, 1)[0]; 
            item.inBasket = !item.inBasket; 
            if (item.inBasket) {
                list.push(item); 
            } else {
                list.unshift(item); 
            }
        },
        async saveShopping() {
            const nextItemsNotInBasket = this.nextTimeList.filter(item => !item.inBasket).map(item => item.text);
            const someItemsNotInBasket = this.someTimeList.filter(item => !item.inBasket).map(item => item.text);
            const shoppingList = {
                nextItems: nextItemsNotInBasket,
                someItems: someItemsNotInBasket,
            };
            //vscode doesn't understand route, but it is working
            router.post(route('shopping.update', shoppingList));
        },
    },
}
</script>