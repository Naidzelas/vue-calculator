<template>
    <Head title="Calculator"></Head>
    <Link
        :href="route('logout')"
        method="post"
        as="button"
        class="inline-block bg-slate-900 hover:bg-blue-700 mt-10 ml-10 p-2 text-slate-50 hover:scale-110 transition cursor-pointer"
    >
        Log out
    </Link>

    <div class="relative flex">
        <div class="top-[20em] left-[45%] absolute">
            <form @submit.prevent="submit">
                <div class="bg-slate-50 shadow-md p-3 border border-black w-72 h-fit">
                    <div class="font-bold text-right">Result: {{ result }}</div>
                    <div class="bg-white mb-3 p-3 border w-full h-fit">
                        <div v-if="!operationRender.length" class="text-gray-400 cursor-default">enter values</div>
                        {{ operationRender.join(' ') }}
                    </div>
                    <div v-if="er.operation" class="font-thin text-red-500 text-sm animate-pulse">{{ er.operation }}</div>
                    <div class="flex gap-3">
                        <div class="gap-3 grid grid-cols-3">
                            <button
                                @click="addOperation($event, number)"
                                v-for="number in 9"
                                class="hover:bg-slate-200 border border-black w-16 h-fit text-center"
                            >
                                {{ number }}
                            </button>
                        </div>

                        <div class="flex flex-col gap-y-3">
                            <button
                                @click="addOperation($event, 'subtraction', ' - ')"
                                class="bg-orange-200 hover:bg-orange-100 border border-black w-16 h-fit text-center"
                            >
                                -
                            </button>
                            <button
                                @click="addOperation($event, 'addition', ' + ')"
                                class="bg-orange-200 hover:bg-orange-100 border border-black w-16 h-fit text-center"
                            >
                                +
                            </button>
                            <button
                                @click="addOperation($event, 'division', ' / ')"
                                class="bg-orange-200 hover:bg-orange-100 border border-black w-16 h-fit text-center"
                            >
                                /
                            </button>
                        </div>
                    </div>
                    <div class="flex gap-x-0.5 mt-2">
                        <button @click="clear" class="flex-1 bg-red-200 hover:bg-red-100 border border-black w-16 h-fit text-center">clear</button>
                        <button @click="addOperation($event, 0)" class="flex-1 hover:bg-slate-200 border border-black w-16 h-fit text-center">
                            0
                        </button>
                        <button class="flex-1 bg-green-200 hover:bg-green-100 border border-black w-16 h-fit text-center" type="submit">=</button>
                        <button
                            @click="addOperation($event, 'multiplication', ' x ')"
                            class="flex-1 bg-orange-200 hover:bg-orange-100 border border-black w-16 h-fit text-center"
                        >
                            x
                        </button>
                    </div>
                </div>
            </form>
            <History class="shadow-md mt-2 -ml-14" :calculatorHistory="calculatorHistory"></History>
        </div>
    </div>
</template>

<script setup>
import History from '@/components/History.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { computed, onMounted, reactive, ref } from 'vue';

defineProps({
    result: Number,
    calculatorHistory: Object,
    errors: Object,
});

const page = usePage();
const er = computed(() => page.props.errors);

const form = reactive({
    operation: null,
    operationDB: null,
});

onMounted(() => {
    form.operation = [];
});

function submit() {
    form.operation = parse(operationCalculate);
    form.operationDB = parse(operationRender);
    router.post(route('calculation.create'), form);
}

const operationCalculate = ref([]);
const operationRender = ref([]);

const addOperation = (event, symbol, render = null) => {
    if (
        (typeof operationCalculate.value[operationCalculate.value.length - 1] === 'string' && typeof symbol === 'string') ||
        (typeof symbol === 'string' && !operationCalculate.value.length)
    ) {
        event.preventDefault();
        return;
    }

    operationCalculate.value.push(symbol);
    operationRender.value.push(render ?? symbol);
    event.preventDefault();
};

function clear(event) {
    operationCalculate.value = [];
    operationRender.value = [];
    form.operation = [];
    event.preventDefault();
}

function parse(forParsing) {
    let sortedArray = [];
    let tempStr = '';

    for (let i = 0; i < forParsing.value.length; i++) {
        if (typeof forParsing.value[i] === 'number') {
            tempStr += forParsing.value[i].toString();
        } else {
            if (tempStr !== '') {
                sortedArray.push(parseInt(tempStr, 10));
                tempStr = '';
            }
            sortedArray.push(forParsing.value[i]);
        }
    }

    if (tempStr !== '') {
        sortedArray.push(parseInt(tempStr, 10));
    }

    if (typeof sortedArray[sortedArray.length - 1] === 'string') {
        sortedArray.pop();
    }

    return sortedArray;
}
</script>
