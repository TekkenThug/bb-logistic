<template>
    <div class="popup">
        <div class="popup__inner">
            <span @click="destroy" class="popup__close"><i class="fas fa-times"></i></span>
            <p class="popup__text">
                {{ text }}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalWindow",
    props: {
        text: {
            type: String
        }
    },
    methods: {
        destroy() {
            this.$destroy();
            this.$el.parentNode.removeChild(this.$el);
        }
    }
}
</script>

<style scoped>
    .popup {
        display: block;
    }
</style>
