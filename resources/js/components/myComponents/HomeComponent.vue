<template>
    <div>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5" v-for="urun in urunler">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/storage/a.png" :alt="urun.urn_ad"/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ urun.urn_ad }}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    {{ this.currencyFormat(urun.urn_fiyat) }} ₺
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <input type="number" ref="urunAdet" step="1" class="form-control mb-2"
                                       @keyup="adetGir(urun.urn_id,$event)">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                                            @click="sepeteEkle(urun.urn_id)">Sepete
                                    Ekle</a></div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 alert alert-danger text-center" v-if="urunler.length==0">
                        Herhangi bir ürün bulunamadı

                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>

export default {
    name: "HomeComponent",
    created() {
        this.getUrunler();
    },
    data() {
        return {
            urn_adet: {},
            urunler: []
        }
    },
    methods: {
        async getUrunler() {
            var urunler = await this.callApi("get", "/api/urunler", {}, {});
            if (urunler.status == 200) {
                this.urunler = urunler.data.data;
            } else {
                this.urunler = [];
            }
        },

        async sepeteEkle(urun_id) {
            var adet = await this.urn_adet[urun_id];


            if (adet == undefined || adet === 0) {
                ToastNotification.adetYok();
            } else {
                var sonuc = await this.callApi("post", "/api/sepet/ekle", {}, {
                    urun_id: urun_id,
                    adet: adet
                });

                if (sonuc.status == 200) {
                    ToastNotification.success();
                    this.adetSifirla();

                    this.emitter.emit("sepetGuncelle", this);
                } else {
                    if (sonuc.status == 500) {
                        ToastNotification.error();
                        this.adetSifirla();
                    }
                }
            }
        },

        async adetGir(urn_id, event) {
            this.urn_adet[urn_id] = await event.target.value;
        },

        adetSifirla() {
            let secilenAdet;
            for (secilenAdet in this.$refs.urunAdet) {
                this.$refs.urunAdet[secilenAdet].value = null;
            }
        }
    }
}
</script>

<style scoped>

</style>
