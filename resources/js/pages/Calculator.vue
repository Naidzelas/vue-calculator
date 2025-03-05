<template>
    <div class="relative flex">
        <div class="top-[25em] left-[45%] absolute">
            <form @submit.prevent="submit">
                <div class="shadow-md p-3 border border-black w-72 h-fit">
                    <div class="font-bold text-right">Result: {{ result }}</div>
                    <div class="mb-3 border border-red-300 w-full h-12">
                        {{ operationRender.join(' ') }}
                    </div>
                    <div class="flex gap-3">
                        <div class="gap-3 grid grid-cols-3">
                            <button
                                @click="addOperation($event, number)"
                                v-for="number in 9"
                                class="hover:bg-slate-100 border border-black w-16 h-fit text-center"
                            >
                                {{ number }}
                            </button>
                        </div>

                        <div class="flex flex-col gap-y-3">
                            <button
                                @click="addOperation($event, 'subtraction', ' - ')"
                                class="hover:bg-slate-100 border border-black w-16 h-fit text-center"
                            >
                                -
                            </button>
                            <button
                                @click="addOperation($event, 'addition', ' + ')"
                                class="hover:bg-slate-100 border border-black w-16 h-fit text-center"
                            >
                                +
                            </button>
                            <button
                                @click="addOperation($event, 'division', ' / ')"
                                class="hover:bg-slate-100 border border-black w-16 h-fit text-center"
                            >
                                /
                            </button>
                        </div>
                    </div>
                    <div class="flex gap-x-0.5 mt-2">
                        <button @click="clear" class="flex-1 hover:bg-slate-100 border border-black w-16 h-fit text-center">clear</button>
                        <button @click="addOperation($event, 0)" class="flex-1 hover:bg-slate-100 border border-black w-16 h-fit text-center">
                            0
                        </button>
                        <button class="flex-1 hover:bg-slate-100 border border-black w-16 h-fit text-center" type="submit">=</button>
                        <button
                            @click="addOperation($event, 'multiplication', ' x ')"
                            class="flex-1 hover:bg-slate-100 border border-black w-16 h-fit text-center"
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
import { router } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';

defineProps({
    result: Number,
    calculatorHistory: Object,
});

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
    router.reload({ only: ['result'] });
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
