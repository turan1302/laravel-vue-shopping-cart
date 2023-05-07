class ToastNotification {
    success() {
        Toast.fire({
            icon: 'success',
            title: 'İşlem Başarılı!'
        });
    }

    alert(){
        Toast.fire({
            icon: 'error',
            title: 'Bu İşlemi Gerçekleştiremezsiniz!'
        });
    }

    warning(){
        Toast.fire({
            icon: 'warning',
            title: 'Lütfen Dikkat!'
        });
    }

    image_warning(){
        Toast.fire({
            icon: 'error',
            title: 'Resim Boyutu 1 MB Yukarısı Olamaz!'
        });
    }

    error(){
        Toast.fire({
            icon: 'error',
            title: 'Bir Hata Oluştu!'
        });
    }

    adetYok(){
        Toast.fire({
            icon: 'error',
            title: 'Lütfen Adet Seçiniz'
        });
    }
}

export default ToastNotification = new ToastNotification();
