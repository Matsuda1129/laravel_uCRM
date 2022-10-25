<script setup>
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "@vue/reactivity";

const form = reactive({
    title: null,
    content: null,
});

const submitFunction = () => {
    Inertia.post("/inertia", form);
};
</script>

<template>
    <form @submit.prevent="submitFunction">
        <input type="text" name="title" v-model="form.title" id="" />
        <input type="text" name="content" v-model="form.content" id="" />
        <button>送信</button>
    </form>
</template>
