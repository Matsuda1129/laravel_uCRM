<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const newTitle = ref("");
const newContent = ref("");
</script>

<template>
    <div>
        Inertiaテストです。<br />
        <a href="/">aタグ経由です</a><br />
        <Link href="/">Link経由です</Link><br />
        <Link :href="route('inertia.index')">名前付きルート</Link><br />
        <Link :href="route('inertia.show', { id: 1 })">ルートパラメータ</Link>

        <div class="mb-8"></div>
        <input type="text" name="newTitle" v-model="newTitle" id="" /><br />
        <input type="text" name="newContent" v-model="newContent" id="" /><br />
        <LinK
            method="post"
            as="button"
            :href="route('inertia.store')"
            :data="{
                title: newTitle,
                content: newContent,
            }"
            >DB保存テスト</LinK
        >
    </div>
</template>
