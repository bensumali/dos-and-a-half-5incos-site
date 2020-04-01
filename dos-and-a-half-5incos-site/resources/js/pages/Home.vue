<template>
    <div>
        <site-header></site-header>
        <div>
            <carousel></carousel>
            <episode-list></episode-list>
        </div>
    </div>
</template>

<script>
    import SiteHeader from "../components/SiteHeader";
    import Carousel from "../components/Carousel";
    import EpisodeList from "../components/EpisodeList";
    export default {
        components: {
            Carousel,
            EpisodeList,
            SiteHeader
        },
        name: "Home"
    }
</script>

<style scoped>

</style>
