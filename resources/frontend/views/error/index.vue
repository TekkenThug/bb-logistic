<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h1>{{ title }}: {{ text }}</h1>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Error",
    props: {
        title: "",
        text: ""
    }
}
</script>

<style scoped>
.container {
    height: 100vh;
}
.row {
    align-items: center;
    height: 100%;
}
</style>
