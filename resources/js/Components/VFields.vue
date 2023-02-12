<script setup>
import Input from "@/Components/TextInput.vue";
import { reactive } from "@vue/reactivity";
import { onBeforeMount, watch } from "@vue/runtime-core";

const props = defineProps({
    name: String,
    type: String,
    label: String,
    value: {},
    disabled: { default: false },
    placeholder: { default: null },
})

const emiting = defineEmits(['input'])

const input = ref(null)

const componentTypes = reactive({
    text: Input,
})

onBeforeMount(() => {
    input.value = props.value
})

watch(value, (valued) => {
    console.log(valued);
    input.value = props.value
})

watch(input, (valued) => {
    console.log(valued);
    emiting('input', input.value)
})

const fieldComponent = computed(() => {
    return componentTypes[this.type]
})
const fieldLabel = computed(() => {
    return this.type === "heading" ? "h4" : "span"
})
// const fieldClass = computed(() => {
//     return this.type === "heading" ? "h4" : "span"
// })


</script>
<template>
    <div class="v-field" :class="fieldClass">
        <label :for="name">
            <component v-if="label" :is="fieldLabel">{{ label }}</component>
            <span v-else>&nbsp;</span>
        </label>
        <component v-if="fieldComponent" v-model="input" :is="fieldComponent" :name="name" :type="type"
        :disabled="disabled" :placeholder="placeholder"></component>
    </div>
</template>
