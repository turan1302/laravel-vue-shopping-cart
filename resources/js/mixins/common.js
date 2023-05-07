export default {
    data() {
        return {
            title: '',
            app_name: "mShop",
            app_slogan : "Sana Özel",

            ayarlar : {}, // SITE AYARLARINI CEKTIRCEZ
            seo_ayarlar : {}, // SEO AYARLARINI CEKTIRECEZ

            kategori_filtre : [],
            marka_filtre : [],
            fiyat_filtre : []
        }
    },
    methods: {
        // API KULLANIMI
        async callApi(method = "", url = "", headers = {}, data = {}) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    headers: headers,
                    data: data
                })
            } catch (e) {
                return e.response;
            }
        },

        /*** CURRENCY KISMI **/
        currencyFormat(price){
            return (price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
        },
    }
}
