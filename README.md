# Weton_Dating_Calculator
Weton_Dating_Calculator adalah sebuah web apps yang dapat membantu Anda menemukan pasangan hidup berdasarkan perhitungan Weton Jodoh Jawa. Weton Jodoh Jawa adalah sebuah sistem astrologi tradisional yang menghitung keserasian antara dua orang berdasarkan tanggal, bulan, dan tahun kelahiran mereka. Web apps ini memiliki fitur CRUD (Create, Read, Update, Delete) yang memungkinkan Anda menyimpan data orang yang akan di kalkulasi weton jodohnya dalam database mysql. Anda dapat menambahkan, melihat, mengubah, atau menghapus data orang yang Anda inginkan. Web apps ini juga menampilkan hasil kalkulasi weton jodoh dalam bentuk tabel dan grafik yang mudah dipahami. Web apps ini dibuat dengan menggunakan bahasa pemrograman PHP, HTML, dan Bootstrap 5.3.

## Cara Running

-   Install XAMPP dan Jalankan Apache dan MySQL.
-   Atur konfigurasi basis data Anda di file db_config.php sesuai kebutuhan.
-   Buat database baru bernama "weton_jodoh" di MySQL melalui PHPMyAdmin.
-   Lalu import `weton_jodoh.sql` ke database tersebut melalui PHPMyAdmin.
-   Buka Command Prompt di Folder Projek Weton_Dating_Calculator
    -   Eksekusi perintah berikut untuk menjalankan Web Server PHP:
        ```
        php -S 0.0.0.0:8000
        ```
    -   Buka Browser Internet favorit Anda dan buka url:
        ```
        http://127.0.0.1:8000
        ```
    
## Screenshots

-   **Beranda:**

    ![](https://i.postimg.cc/ryNBHb6h/Beranda.png)

-   **Dashboard:**

    ![](https://i.postimg.cc/90bsq4t3/Dashboard.png)

-   **Tambah Orang:**

    ![](https://i.postimg.cc/76gFwt5Z/Tambah-Orang.png)

-   **Edit Orang:**

    ![](https://i.postimg.cc/G2w00nhf/Edit-Orang.png)

-   **Hitung Weton:**

    ![](https://i.postimg.cc/hvcHj8mb/Hitung-Weton.png)
