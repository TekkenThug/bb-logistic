<template>
    <div>
        <input required
               class="form-control"
               type="text"
               name="delivery-phone"
               placeholder="+7 (999) 999-99-99"
               :value="value"
               @input="$emit('input', $event.target.value)">
    </div>
</template>

<script>
export default {
    name: "PhoneInput",
    props: {
        value: ""
    }
}
</script>

<style scoped>

</style>
