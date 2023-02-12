<script setup>
import VForm from "@/Components/VForm.vue";
import { computed, onBeforeMount, onMounted, ref } from "@vue/runtime-core";
import draggable from "vuedraggable";
// VForm

const prop = defineProps({
    form: Object,
    toJson: Object
})

const fields = ref([])
const title = ref('New Form')
const showPreview = ref(false)

const templates = ref([
    {
        name: "heading",
        type: "heading",
        label: "Heading",
        class: "small-12",
        placeholder: null,
    },
    {
        name: "text",
        type: "text",
        label: "Text",
        class: "small-6",
        placeholder: "Text",
    },
    {
        name: "number",
        type: "number",
        label: "Number",
        class: "small-6",
        placeholder: "Number",
    },
    {
        name: "checkbox",
        type: "checkbox",
        label: "Checkbox",
        class: "small-6",
        placeholder: null,
    },
    {
        name: "select",
        type: "select",
        label: "Select",
        class: "small-6",
        placeholder: "Select an Option",
        options: [],
    },
])

// const

// const proxyChecked = computed({
//     get() {
//         return props.checked;
//     },

//     set(val) {
//         emit("update:checked", val);
//     },
// });

const valueJson = computed(() => {
    return JSON.stringify({
        title: title.value,
        fields: fields.value.map((field) => {
            return {
                id: field.id,
                name: field.name,
                type: field.type,
                label: field.label,
                placeholder: field.placeholder,
                class: field.class,
                options: field.options,
            };
        }),
    });
});

// methods

const handleShowPreview = () => {
    showPreview.value = !showPreview.value;
    this.allowOverFlow();
}
const allowOverFlow = () => {
    if (showPreview.value) {
        return document.body.classList.remove('hide-overflow');
    }
    document.body.classList.add('hide-overflow');
}

const getFieldTypeTitle = (field) => {
    switch (field.type) {
        case "textarea":
            return "Text large";
        case "radio-group":
            return "Radio Button Group";
        case "check-group":
            return "Checkbox Group";
        default:
            return (
                field.type.charAt(0).toUpperCase() + field.type.slice(1)
            );
    }
}

const uniqueId = () => {
    return Math.floor(Math.random() * Date.now());
}

const onAddOption = (field) => {
    if (field.newOption) {
        field.options.push(field.newOption);
        field.newOption = null;
    }
}

const removeField = (index) => {
    this.$delete(this.fields, index);
}
const removeFieldOption = (field, index) => {
    this.$delete(field.options, index);
}
const fieldTitle = (field) => {
    return field.type.charAt(0).toUpperCase() + field.type.slice(1)
}
const cloneTemplate = (template) => {
    let id = uniqueId();
    console.log(id);
    return {
        id: id,
        name: `${template.type}_${id}`,
        type: template.type,
        label: template.label,
        placeholder: template.placeholder,
        class: template.class,
        options: template.options,
    };
}
const addFieldToBottom = (fieldTemplate) => {
    let field = this.cloneTemplate(fieldTemplate);
    this.fields.push(field);
}

onBeforeMount(() => {
    if (prop.form) {
        title.value = prop.form.title
        fields.value = prop.form.fields
    }
})

onMounted(() => {
    prop
    // dt
    valueJson
    console.log(prop);
})

</script>
<template>
    <div>
        <div class="grid grid-cols-2">
            <button class=" bg-green-600 text-gray-700">{{ prop.form ? 'Update' : 'Create' }}</button>
        </div>
        <div>
            <input type="text" v-model="title" />
        </div>
        <div v-if="showPreview" class="form-builder-preview-container">
            <div class="form-builder-preview">
                <v-form action="#" method="get" :fields="fields"></v-form>
            </div>
        </div>
        <div v-else class="form-builder-container">
            <div class="form-builder">
                <div class="menu form-builder-templates">
                    <draggable v-model="templates" :clone="cloneTemplate" item-key="name"
                        :group="{ name: 'fields', pull: 'clone', put: false }">
                        <template #item="{ element }">
                            <li class="button" @click="addFieldToBottom(element)">
                                {{ element.label }}
                            </li>
                        </template>
                    </draggable>
                </div>
                <div class="form-builder-fields">
                    <draggable v-model="fields" ghost-class="fields" item-key="id"
                        :group="{ name: 'fields', pull: false, put: true }" handle=".handle">
                        <template #item="{ element, index }">
                            <div class="p-r-2 relative -field" :class="['-type-' + element.type]">
                                <div class="-field-title handle">
                                    <h2 @click="element.isShowing = !element.isShowing">
                                        <span class="fal fa-list"></span>
                                        <span class="-title">
                                            <span class="-type-title">{{ getFieldTypeTitle(element) }}:</span>
                                            <span class="-name">{{ element.label }}</span>
                                        </span>
                                    </h2>
                                    <span @click="removeField(index)">
                                        <i class="icon fal fa-lg fa-times"></i>
                                    </span>
                                </div>
                                <div class="-field-properties">
                                    <div class="-prop -label-text">
                                        <span>Label</span>
                                        <input type="text" v-model="element.label" />
                                    </div>
                                    <div class="-prop -placeholder" v-if="element.placeholder !== null">
                                        <span>Placeholder</span>
                                        <input type="text" v-model="element.placeholder" />
                                    </div>
                                    <div class="-prop -width" v-if="elementelement.class">
                                        <span class="-label">Width</span>
                                        <select v-model="element.class">
                                            <option value="small-12">Full</option>
                                            <option value="small-6">Half</option>
                                        </select>
                                    </div>
                                    <!-- <div class="-prop -options" v-if="element.options">
                                        <span class="-label">Options</span>
                                        <draggable :list="element.options" class="-added"
                                            :group="{ name: element.id, pull: false, put: false }" handle=".option-handle">
                                            <div v-for="(option, index) in field.options" class="-option">
                                                <div class="option-handle">
                                                    <i class="fal fa-lg fa-list"></i>
                                                </div>
                                                <input v-model="field.options[index]" type="text" />
                                                <button type="button" class="-remove"
                                                    @click="removeFieldOption(field, index)">
                                                    <i class="icon fal fa-times"></i>
                                                </button>
                                            </div>
                                        </draggable>
                                        <div class="-new">
                                            <input type="text" v-model="field.newOption"
                                                @keydown.enter.prevent="onAddOption(field)" placeholder="Add option" />
                                            <button type="button" class="button tiny" @click.prevent="onAddOption(field)">
                                                <i class="icon fal fa-plus-circle"></i>
                                            </button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </template>
                    </draggable>
                </div>
            </div>
        </div>

    </div>

</template>
