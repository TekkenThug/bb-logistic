<template>
    <div class="admin-client__filter">
        <select :value="value" @input="$emit('input', $event.target.value)" class="form-select">
            <option class="btn-filter" value="" selected disabled>
                <slot>
                    Выберите...
                </slot>
            </option>
            <option v-for="(data, index) in dataArray" :key="index" class="btn-filter" :value="data[dataProperty]">{{ data[dataView] }}</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "SelectField",
    props: {
        value: null,
        dataArray: null,
        dataProperty: null,
        dataView: null
    }
}
</script>