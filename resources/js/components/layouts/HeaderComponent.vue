<template>
    <div>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">{{ app_name }}</h1>
                    <p class="lead fw-normal text-white-50 mb-0">{{ app_slogan }}</p>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
export default {
    name: "HeaderComponent"
}
</script>

<style scoped>

</style>
