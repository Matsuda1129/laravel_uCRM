<script setup>
import { onMounted, reactive, ref, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { getToday } from "@/common"; // 別ファイルをインポート

const props = defineProps({ customers: Array, items: Array });
const itemList = ref([]);
const form = reactive({ date: null, customer_id: null, status: true, items: [] });
const quantity = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
const storePurchase = () => {
    itemList.value.forEach((item) => {
        if (item.quantity > 0)
            // 0より大きいものだけ追加
            form.items.push({ id: item.id, quantity: item.quantity });
    });
    Inertia.post(route("purchases.store"), form);
};
onMounted(() => {
    // ページ読み込み後 即座に実行
    form.date = getToday();
    props.items.forEach((item) => {
        // 配列を1つずつ処理
        itemList.value.push({
            // 配列に1つずつ追加
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: 0,
        });
    });
});

const totalPrice = computed(() => {
    let total = 0;
    itemList.value.forEach((item) => {
        total += item.price * item.quantity;
    });
    return total;
});
</script>

<template>
    <form @submit.prevent="storePurchase">
        日付<br />
        <input type="date" name="date" v-model="form.date" /><br />

        会員名<br />
        <select name="customer" v-model="form.customer_id">
            <option v-for="customer in customers" :value="customer.id" :key="customer.id">{{ customer.id }} : {{ customer.name }}</option></select
        ><br />

        商品・サービス<br />
        <table>
            略
            <tbody>
                <tr v-for="item in itemList">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.price }}</td>
                    <td>
                        <select name="quantity" v-model="item.quantity">
                            <option v-for="q in quantity" :value="q">{{ q }}</option>
                        </select>
                    </td>
                    <td>
                        {{ item.price * item.quantity }}
                    </td>
                </tr>
            </tbody>
            合計
            {{
                totalPrice
            }}
            円
        </table>
        <button>登録する</button>
    </form>
</template>
