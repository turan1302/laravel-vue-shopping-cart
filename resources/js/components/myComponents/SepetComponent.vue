<template>
    <div>
        <h4 class="text-center mt-4">Sepet Sayfası</h4>

        <div class="container my-5">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Resim</th>
                    <th scope="col">Ürün Adı</th>
                    <th scope="col">Adet</th>
                    <th scope="col">Fiyat</th>
                    <th scope="col">Tutar</th>
                    <th>İşlemler</th>
                    <th>Güncelle</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="sepet.length>0" v-for="item in sepet">
                    <th scope="row">
                        <img src="/storage/a.png" width="100" height="100" :alt="item.urn_ad">
                    </th>
                    <td>{{ item.urn_ad }}</td>
                    <td>{{ item.spt_urun_adet }}</td>
                    <td>{{ currencyFormat(item.spt_urun_fiyat) }} ₺</td>
                    <td>{{ currencyFormat(item.spt_urun_fiyat * item.spt_urun_adet) }} ₺</td>
                    <td>
                        <button class="btn btn-danger btn-sm" @click="urunKaldir(item.spt_id)">Ürünü Kaldır</button>
                    </td>
                    <td>
                        <input type="number" min="1" step="1" ref="urunAdet" class="form-control" @keyup="adetGir(item.spt_id,$event)">
                        <br>
                        <button class="btn btn-success" @click="adetGuncelle(item.spt_id)">Güncelle</button>
                    </td>
                </tr>

                <tr v-else>
                    <td colspan="12">
                        <div class="col-md-12 alert alert-danger text-center">
                            Herhangi bir veri bulunamadı
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

export default {
    name: "SepetComponent",
    created() {
        this.getSepet();
    },
    data() {
        return {
            sepet: [],
            urn_adet: {}
        }
    },
    methods: {
        async getSepet() {
            var sonuc = await this.callApi("get", "/api/sepet");
            if (sonuc.status == 200) {
                this.sepet = sonuc.data.data;
            }
        },

        async adetGir(spt_id, event) {
            this.urn_adet[spt_id] = await event.target.value;
        },

        async adetGuncelle(spt_id) {
            var adet = this.urn_adet[spt_id];
            var sonuc = await this.callApi("post", "/api/sepet/guncelle/"+spt_id,{},{
                adet : adet
            });

            if (sonuc.status==200) {
                ToastNotification.success();
                this.emitter.emit("sepetGuncelle", this);
                this.getSepet();
                this.adetSifirla();
            }else{
                ToastNotification.error();
                this.adetSifirla();
            }
        },

        adetSifirla() {
            let secilenAdet;
            for (secilenAdet in this.$refs.urunAdet) {
                this.$refs.urunAdet[secilenAdet].value = null;
            }
        },

        async urunKaldir(spt_id = "") {
            Swal.fire({
                title: 'Dikkat',
                text: "Kayıt Silinecektir. Onaylıyor Musunuz ? (Bu işlem geri alınamaz)",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, Kaydı Sil',
                cancelButtonText: 'Vazgeç'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    var sonuc = await this.callApi("delete", "/api/sepet/kaldir/" + spt_id);
                    if (sonuc.status == 200) {
                        ToastNotification.success();
                        this.sepet = this.sepet.filter(item => {
                            return item.spt_id !== spt_id;
                        })
                    } else {
                        ToastNotification.error();
                    }
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
