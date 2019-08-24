# Codeigniter Rest API with JWT
Silahkan gunakan jika anda membutuhkan, untuk mengaksesnya dengan http://localhost/ci-rest/
* Get token terlebih dahulu dengan url http://localhost/ci-rest/user/login dengan method POST, secara default `username` dan `password` yang diterima adalah admin
* Simpan token tersebut dan gunakan sebagai value Authorization pada header anda.
* Coba akses data user dengan url http://localhost/ci-rest/user dengan method GET