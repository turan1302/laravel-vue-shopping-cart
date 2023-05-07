<template>
    <div>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <router-link class="navbar-brand" :to="{name : 'front_home'}">{{ app_name }}</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4"></ul>
                    <form class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light bg-dark btn btn-outline-dark" id="navbarDropdown" href="javascript:void(0)" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">Sepetteki Ürünler ({{ sepet.length }})</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="text-center" v-for="spt in sepet">
                                      <div class="row">
                                          <div class="col-md-1 align-items-center">
                                              <img src="/storage/a.png" width="100" height="100" :alt="spt.urn_ad">
                                          </div>
                                            <div class="col-md-11">
                                                <a class="dropdown-item" href="javascript:void(0)">{{ spt.urn_ad+" x "+spt.spt_urun_adet }}</a>
                                            </div>
                                      </div>
                                        <hr>
                                    </li>
                                    <li class="text-center">
                                        <hr class="dropdown-divider"/>
                                        <router-link :to="{name : 'front_sepet'}" class="text-center">Sepete Git</router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: "NavbarComponent",
    created() {
        this.getSepet();
    },
    data(){
        return {
            sepet : []
        }
    },
    mounted() {
        // SEPETE EKLEME OLAYINDA OLACAK OLAN OLAY
        this.emitter.on("sepetGuncelle", item => {
            this.getSepet();
        });
    },
    methods : {
        async getSepet(){
            var sonuc = await this.callApi("get","/api/sepet/navbar-sepet",{},{});
            if (sonuc.status==200){
                this.sepet = sonuc.data.data;
            }
        }
    }
}
</script>

<style scoped>

</style>
