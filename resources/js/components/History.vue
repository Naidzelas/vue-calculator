<template>
    <div class="bg-slate-50 p-3 border border-black">
        <div class="text-2xl text-center">History</div>
        <table class="w-96 table-fixed">
            <caption class="caption-bottom">
                Last 10 calculations
            </caption>
            <th class="text-center">Operation</th>
            <th>Result</th>
            <tr v-for="record in calculatorHistory" class="odd:bg-slate-200">
                <td class="text-center">{{ record.operation }}</td>
                <td class="text-center">{{ record.result }}</td>
            </tr>
        </table>
    </div>
</template>

<script setup>
defineProps({
    calculatorHistory: Object,
});
</script>
